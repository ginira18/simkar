<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\SalaryHistory;
use Illuminate\Support\Facades\Http;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with(['department', 'salary'])->get();

        return view('admin.gaji.daftar_gaji')->with('employees', $employees);
    }
    // public function salaryHistory()
    // {
    //     $employees = Employee::with(['department', 'salaryHistories'])->get();

    //     return view('admin.gaji.riwayat_gaji')->with('employees', $employees);
    // }
    public function salaryHistory()
    {
        $salaryHistories = SalaryHistory::with(['employee'])
            ->get();

        return view('admin.gaji.riwayat_gaji')->with('salaryHistories', $salaryHistories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

        // dd($endDate);
        // Hitung jumlah kehadiran dan izin
        $hadir = Attendance::where('employee_id', $id)
            ->whereBetween('date', [$startDate, $endDate])
            ->where('status', 'hadir')
            ->count();
        $izin = Attendance::where('employee_id', $id)
            ->whereBetween('date', [$startDate, $endDate])
            ->where('status', 'izin')
            ->count();

        // Hitung jumlah alpha
        $alpha = $jumlahHariKerja - $hadir - $izin;


        // Hitung jumlah terlambat
        $terlambat = Attendance::where('employee_id', $id)
            ->whereBetween('date', [$startDate, $endDate])
            ->where('keterangan', 'terlambat')
            ->count();


        // Hitung potongan Kehadiran
        $potonganKehadiran = $terlambat * 10000;
        $potonganKehadiran += $alpha * 50000;

        // Hitung potongan asuransi
        $potonganAsuransi = $employee->bpjs == 'bpjs' ? ($employee->salary->base_salary + $employee->salary->fix_allowance) * 0.01 : 0;

        // Hitung total gaji untuk karyawan bulanan
        $totalGaji = 0;
        if ($employee->employee_type == 'monthly') {
            $totalGaji = $employee->salary->base_salary + $employee->salary->fix_allowance - $potonganKehadiran - $potonganAsuransi;
        } elseif ($employee->employee_type == 'daily') {
            $totalGaji = $employee->salary->base_salary * $hadir - $potonganKehadiran - $potonganAsuransi;
        }

        return view('admin.gaji.gaji_detail', compact('employee', 'izin', 'terlambat', 'alpha', 'potonganKehadiran', 'potonganAsuransi', 'totalGaji', 'jumlahHariKerja'));
    }


    public function giveSalary(Request $request, $id)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'cut_insurance' => 'required|numeric',
            'cut_attendance' => 'required|numeric',
            'bonus' => 'nullable|numeric',
            'cut_other' => 'nullable|numeric',
            'total_salary' => 'required|numeric',
        ]);

        $employee = Employee::with('salary')->findOrFail($id);

        $salaryHistory = new SalaryHistory();
        $salaryHistory->employee_id = $id;
        $salaryHistory->base_salary = $employee->salary->base_salary;
        $salaryHistory->fix_allowance = $employee->salary->fix_allowance;
        $salaryHistory->cut_insurance = $validatedData['cut_insurance'];
        $salaryHistory->cut_attendance = $validatedData['cut_attendance'];
        $salaryHistory->bonus = $validatedData['bonus'] ?? 0;
        $salaryHistory->cut_other = $validatedData['cut_other'] ?? 0;
        $salaryHistory->total_salary = $validatedData['total_salary'];
        $salaryHistory->save();

        // $employee->salary->status = 'diberikan';
        $employee->salary->save();

        return redirect()->route('dashboard-gaji.index', $id)->with('success', 'Gaji berhasil diberikan dan disimpan ke dalam riwayat.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salary $salary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Salary $salary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salary $salary)
    {
        //
    }

    // Karyawan
    public function index_karyawan()
    {
        $employee = auth()->user();
        $salaryHistories = SalaryHistory::where('employee_id', $employee->id)->with('employee.department')->get();

        return view('pegawai.gaji')->with('salaryHistories', $salaryHistories);
    }

    public function show_karyawan($id)
    {
        $salaryHistory = SalaryHistory::with('employee.department')->findOrFail($id);

        // Hitung jumlah kehadiran dengan status masing-masing
        $employeeId = $salaryHistory->employee_id;
        $izin = Attendance::where('employee_id', $employeeId)->where('status', 'izin')->count();
        $alpha = Attendance::where('employee_id', $employeeId)->where('status', 'alpha')->count();
        $terlambat = Attendance::where('employee_id', $employeeId)->where('keterangan', 'terlambat')->count();

        return view('pegawai.detail_gaji', compact('salaryHistory', 'izin', 'alpha', 'terlambat'));
    }

    public function slip($id)
    {
        $salaryHistory = SalaryHistory::findOrFail($id);

        return view('slip_gaji', compact('salaryHistory'));
    }
}
