<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\SalaryHistory;
use Illuminate\Support\Facades\Http;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private function hasSalaryBeenGivenThisMonth(Employee $employee)
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        return SalaryHistory::where('employee_id', $employee->id)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->exists();
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $employeeType = $request->input('employee_type');
        $salaryStatus = $request->input('salary_status');

        $query = Employee::with(['department', 'salary'])
            ->whereDoesntHave('user', function ($query) {
                $query->where('roles', 'presensi');
            });

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('NIP', 'like', "%{$search}%")
                    ->orWhereHas('department', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($employeeType) {
            $query->where('employee_type', $employeeType);
        }

        $employees = $query->get()->map(function ($employee) {
            $employee->has_salary_been_given = $this->hasSalaryBeenGivenThisMonth($employee);
            return $employee;
        });

        if ($salaryStatus === 'given') {
            $employees = $employees->filter(function ($employee) {
                return $employee->has_salary_been_given;
            });
        } elseif ($salaryStatus === 'not_given') {
            $employees = $employees->filter(function ($employee) {
                return !$employee->has_salary_been_given;
            });
        }

        return view('admin.gaji.daftar_gaji', [
            'employees' => $employees,
            'search' => $search,
            'employeeType' => $employeeType,
            'salaryStatus' => $salaryStatus,
        ]);
    }


    private function fetchHolidays($params = [])
    {
        try {
            $response = Http::get("https://dayoffapi.vercel.app/api", $params);

            $holidays = $response->json();

            return $holidays;
        } catch (\Exception $e) {
            // Log::error('Failed to fetch holidays', ['message' => $e->getMessage()]);
            throw new \Exception('Failed to fetch holidays');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $employee = Employee::with('department', 'salary')->findOrFail($id);

        // Tanggal mulai dan akhir
        $startDate = Carbon::now()->day(25)->startOfDay();
        $endDate = Carbon::now()->addMonth()->day(25)->startOfDay();

        // Atur tanggal mulai ke 25 bulan sebelumnya dan tanggal akhir ke 25 bulan ini
        if (Carbon::now()->day < 25) {
            $startDate = Carbon::now()->subMonth()->day(25)->startOfDay();
            $endDate = Carbon::now()->day(25)->startOfDay();
        }

        // Hitung jumlah hari kerja
        $jumlahHariKerja = 0;
        $currentDate = $startDate->copy();
        while ($currentDate->lte($endDate)) {
            if (!$currentDate->isSunday()) {
                $jumlahHariKerja++;
            }
            $currentDate->addDay();
        }

        // Hitung jumlah libur 
        $holidays = 0;
        $holidays_start = $this->fetchHolidays([
            'month' => $startDate->month,
        ]);
        $holidays_end = $this->fetchHolidays([
            'month' => $endDate->month,
        ]);


        foreach ($holidays_start as $holiday) {
            if (!Carbon::parse($holiday['tanggal'])->isSunday() && Carbon::parse($holiday['tanggal'])->gte($startDate) && $holiday["is_cuti"]) {
                $holidays++;
            }
        }

        foreach ($holidays_end as $holiday) {
            if (!Carbon::parse($holiday['tanggal'])->isSunday() && Carbon::parse($holiday['tanggal'])->lte($endDate) && $holiday["is_cuti"]) {
                $holidays++;
            }
        }

        $jumlahHariKerja -= $holidays;

        // dd($holidays);

        // Hitung jumlah kehadiran dan izin
        $hadir = Attendance::where('employee_id', $id)
            ->whereBetween('date', [$startDate, $endDate])
            ->where('status', 'hadir')
            ->count();
        $izin = Attendance::where('employee_id', $id)
            ->whereBetween('date', [$startDate, $endDate])
            ->where('status', 'izin')
            ->count();
        // dd($jumlahHariKerja);

        // Hitung jumlah alpha
        $alpha = $jumlahHariKerja - $hadir - $izin;


        // Hitung jumlah terlambat
        $terlambat = Attendance::where('employee_id', $id)
            ->whereBetween('date', [$startDate, $endDate])
            ->where('keterangan', 'terlambat')
            ->count();


        // Hitung potongan Kehadiran
        $potonganTerlambat = $terlambat * 10000;
        $potonganKehadiran = $alpha * 50000;

        // Hitung potongan asuransi
        $potonganAsuransi = $employee->bpjs == 'bpjs' ? ($employee->salary->base_salary + $employee->salary->fix_allowance) * 0.01 : 0;

        // Hitung total gaji untuk karyawan bulanan
        $totalGaji = 0;
        if ($employee->employee_type == 'monthly') {
            $totalGaji = $employee->salary->base_salary + $employee->salary->fix_allowance - $potonganTerlambat - $potonganKehadiran - $potonganAsuransi;
        } elseif ($employee->employee_type == 'daily') {
            $totalGaji = ($employee->salary->base_salary * $hadir) - $potonganTerlambat;
        }
        if ($totalGaji < 0) {
            $totalGaji = $employee->salary->base_salary + $employee->salary->fix_allowance;
        }
        session([
            'attendance_data' => [
                'jumlahHariKerja' => $jumlahHariKerja,
                'hadir' => $hadir,
                'izin' => $izin,
                'alpha' => $alpha,
                'terlambat' => $terlambat,
            ],
            'employee_data' => [
                'id' => $employee->id,
                'department' => $employee->department->name,
                'position' => $employee->position,
                'bpjs' => $employee->bpjs,
                'base_salary' => $employee->salary->base_salary,
                'fix_allowance' => $employee->salary->fix_allowance
            ]
        ]);
        return view('admin.gaji.gaji_detail', compact('employee', 'jumlahHariKerja', 'hadir', 'izin', 'terlambat', 'alpha', 'potonganTerlambat', 'potonganKehadiran', 'potonganAsuransi', 'totalGaji', 'jumlahHariKerja'));
    }


    public function giveSalary(Request $request, $id)
    {
        $currentDate = Carbon::now();
        if ($currentDate->day < 1 || $currentDate->day > 9) {
            return redirect()->back()->with('error', 'Penggajian hanya bisa dilakukan pada tanggal 25 sampai 28.');
        }

        $employee = Employee::with('salary')->findOrFail($id);
        if ($this->hasSalaryBeenGivenThisMonth($employee)) {
            return redirect()->back()->with('error', 'Gaji sudah diberikan untuk bulan ini.');
        }

        $validatedData = $request->validate([
            'cut_insurance' => 'required|numeric',
            'cut_attendance' => 'required|numeric',
            'bonus' => 'nullable|numeric',
            'cut_other' => 'nullable|numeric',
            'total_salary' => 'required|numeric',
        ]);

        $employeeData = session('employee_data');
        $attendanceData = session('attendance_data');

        $salaryHistory = new SalaryHistory();
        $salaryHistory->employee_id = $id;
        $salaryHistory->base_salary = $employee->salary->base_salary;
        $salaryHistory->fix_allowance = $employee->salary->fix_allowance;
        $salaryHistory->cut_insurance = $validatedData['cut_insurance'];
        $salaryHistory->cut_attendance = $validatedData['cut_attendance'];
        $salaryHistory->bonus = $validatedData['bonus'] ?? 0;
        $salaryHistory->cut_other = $validatedData['cut_other'] ?? 0;
        $salaryHistory->total_salary = $validatedData['total_salary'];
        $salaryHistory->department = $employeeData['department'];
        $salaryHistory->position = $employeeData['position'];
        $salaryHistory->bpjs = $employeeData['bpjs'];
        $salaryHistory->jumlahHariKerja = $attendanceData['jumlahHariKerja'];
        $salaryHistory->hadir = $attendanceData['hadir'];
        $salaryHistory->izin = $attendanceData['izin'];
        $salaryHistory->alpha = $attendanceData['alpha'];
        $salaryHistory->terlambat = $attendanceData['terlambat'];
        $salaryHistory->save();

        // $employee->salary->status = 'diberikan';
        // $employee->salary->save();

        return redirect()->route('dashboard-gaji.index', $id)->with('success', 'Gaji berhasil diberikan dan disimpan ke dalam riwayat.');
    }


    public function salaryHistory(Request $request)
    {
        $query = SalaryHistory::with('employee.department');

        $search = $request->input('search');
        $month = $request->input('month');
        $year = $request->input('year');

        if ($search) {
            $query->whereHas('employee', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('NIP', 'like', '%' . $search . '%');
            })
                ->orWhereHas('employee.department', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
        }

        if ($month && $year) {
            $startDate = Carbon::create($year, $month, 1)->startOfMonth();
            $endDate = $startDate->copy()->endOfMonth();

            $query->whereBetween('created_at', [$startDate, $endDate]);
        } elseif ($year) {
            $startDate = Carbon::create($year, 1, 1)->startOfYear();
            $endDate = $startDate->copy()->endOfYear();

            $query->whereBetween('created_at', [$startDate, $endDate]);
        } elseif ($month) {
            $startDate = Carbon::create(now()->year, $month, 1)->startOfMonth();
            $endDate = $startDate->copy()->endOfMonth();

            $query->whereBetween('created_at', [$startDate, $endDate]);
        }


        $salaryHistories = $query->paginate(30);

        return view('admin.gaji.riwayat_gaji', compact('salaryHistories'));
    }
    public function history_salary_detail($id)
    {

        $salaryHistory = SalaryHistory::with('employee.department')->findOrFail($id);

        return view('admin.gaji.riwayat_gaji_detail', compact('salaryHistory'));
    }

    public function hisoty_salary_slip($id)
    {
        $salaryHistory = SalaryHistory::findOrFail($id);

        return view('slip_gaji', compact('salaryHistory'));
    }


    // Karyawan
    public function index_karyawan(Request $request)
    {
        $employee = auth()->user();

        $month = $request->input('month');
        $year = $request->input('year');

        $query = SalaryHistory::where('employee_id', $employee->id)->with('employee.department');

        if ($month && $year) {
            $query->whereYear('created_at', $year)
                ->whereMonth('created_at', $month);
        } elseif ($year) {
            $query->whereYear('created_at', $year);
        } elseif ($month) {
            $query->whereMonth('created_at', $month);
        }

        $salaryHistories = $query->paginate(30);

        return view('pegawai.gaji', [
            'salaryHistories' => $salaryHistories,
            'selectedMonth' => $month,
            'selectedYear' => $year,
        ]);
    }

    public function show_karyawan($id)
    {
        $salaryHistory = SalaryHistory::with('employee.department')->findOrFail($id);


        return view('pegawai.detail_gaji', compact('salaryHistory'));
    }

    public function slip($id)
    {
        $salaryHistory = SalaryHistory::findOrFail($id);

        return view('slip_gaji', compact('salaryHistory'));
    }
}
