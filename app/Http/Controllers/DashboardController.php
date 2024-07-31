<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\SalaryHistory;
use App\Models\Permission;
use App\Models\Department;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Ambil data total gaji karyawan per bulan untuk chart
        $labels = [];
        $totalSalaries = [];

        $currentYear = Carbon::now()->year;

        for ($month = 1; $month <= 12; $month++) {
            $totalSalary = SalaryHistory::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->sum('total_salary');

            $labels[] = Carbon::createFromDate($currentYear, $month, 1)->translatedFormat('F Y');
            $totalSalaries[] = $totalSalary;
        }

        $lastMonthTotalSalary = SalaryHistory::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->sum('total_salary');

        $maleEmployees = Employee::where('gender', 'male')->count();
        $femaleEmployees = Employee::where('gender', 'female')->count();

        $monthlyEmployees = Employee::where('employee_type', 'monthly')->count();
        $dailyEmployees = Employee::where('employee_type', 'daily')->count();
        $totalEmployees = Employee::where('is_active', true)->count();
        $totalPermissionRequests = Permission::where('status', 'pending')->count();
        $activeDepartments = Department::withCount('employees')->get();

        return view('admin.dashboard', [
            'labels' => $labels,
            'totalSalaries' => $totalSalaries,
            'currentMonth' => Carbon::now()->translatedFormat('F Y'),
            'totalEmployees' => $totalEmployees,
            'totalPermissionRequests' => $totalPermissionRequests,
            'lastMonthTotalSalary' => $lastMonthTotalSalary,
            'activeDepartments' => $activeDepartments,
            'maleEmployees' => $maleEmployees,
            'femaleEmployees' => $femaleEmployees,
            'monthlyEmployees' => $monthlyEmployees,
            'dailyEmployees' => $dailyEmployees,
        ]);
    }

    // public function index_karyawan()
    // {
    //     return view('pegawai.dashboard');
    // }

    public function index_karyawan()
    {
        // Mendapatkan ID karyawan yang sedang login
        $employeeId = Auth::id();

        // Mendapatkan informasi karyawan
        $employee = Employee::with('salary')->findOrFail($employeeId);

        // Set tanggal mulai dan akhir
        $startDate = Carbon::now()->day(25)->startOfDay();
        $endDate = Carbon::now()->addMonth()->day(25)->startOfDay();

        // Jika bulan ini belum tanggal 25, set tanggal mulai ke 25 bulan sebelumnya dan tanggal akhir ke 25 bulan ini
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

        // Hitung jumlah kehadiran, izin, dan alpha
        $hadir = Attendance::where('employee_id', $employeeId)
            ->whereBetween('date', [$startDate, $endDate])
            ->where('status', 'hadir')
            ->count();
        $izin = Attendance::where('employee_id', $employeeId)
            ->whereBetween('date', [$startDate, $endDate])
            ->where('status', 'izin')
            ->count();
        $alpha = $jumlahHariKerja - $hadir - $izin;

        // Hitung jumlah terlambat
        $terlambat = Attendance::where('employee_id', $employeeId)
            ->whereBetween('date', [$startDate, $endDate])
            ->where('keterangan', 'terlambat')
            ->count();

        // Hitung potongan Kehadiran
        $potonganKehadiran = $terlambat * 10000;
        $potonganKehadiran += $alpha > 0 ? 50000 : 0;

        // Hitung potongan asuransi
        $potonganAsuransi = $employee->bpjs == 'bpjs' ? ($employee->salary->base_salary + $employee->salary->fix_allowance) * 0.01 : 0;

        // Hitung total gaji untuk karyawan bulanan
        $totalGaji = 0;
        if ($employee->employee_type == 'monthly') {
            $totalGaji = $employee->salary->base_salary + $employee->salary->fix_allowance - $potonganKehadiran - $potonganAsuransi;
        } elseif ($employee->employee_type == 'daily') {
            $totalGaji = $employee->salary->base_salary * $hadir - $potonganKehadiran - $potonganAsuransi;
        }

        // Data untuk chart gaji per bulan (asumsi Anda ingin menampilkan data untuk 6 bulan terakhir)
        $labels = [];
        $totalSalaries = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $labels[] = $date->translatedFormat('F Y');
            $monthlySalary = $this->calculateMonthlySalary($employeeId, $date);
            $totalSalaries[] = $monthlySalary;
        }

        return view('pegawai.dashboard', compact(
            'employee', 'hadir', 'izin', 'alpha', 'terlambat',
            'totalGaji', 'labels', 'totalSalaries'
        ));
    }

    private function calculateMonthlySalary($employeeId, $date)
    {
        // Set tanggal mulai dan akhir untuk bulan yang diberikan
        $startDate = $date->copy()->day(25)->startOfDay();
        $endDate = $date->copy()->addMonth()->day(25)->startOfDay();

        // Jika bulan ini belum tanggal 25, set tanggal mulai ke 25 bulan sebelumnya dan tanggal akhir ke 25 bulan ini
        if ($date->day < 25) {
            $startDate = $date->copy()->subMonth()->day(25)->startOfDay();
            $endDate = $date->copy()->day(25)->startOfDay();
        }

        // Hitung jumlah kehadiran, izin, dan alpha
        $hadir = Attendance::where('employee_id', $employeeId)
            ->whereBetween('date', [$startDate, $endDate])
            ->where('status', 'hadir')
            ->count();
        $izin = Attendance::where('employee_id', $employeeId)
            ->whereBetween('date', [$startDate, $endDate])
            ->where('status', 'izin')
            ->count();
        $alpha = $this->calculateWorkDays($startDate, $endDate) - $hadir - $izin;

        // Hitung jumlah terlambat
        $terlambat = Attendance::where('employee_id', $employeeId)
            ->whereBetween('date', [$startDate, $endDate])
            ->where('keterangan', 'terlambat')
            ->count();

        // Hitung potongan Kehadiran
        $potonganKehadiran = $terlambat * 10000;
        $potonganKehadiran += $alpha > 0 ? 50000 : 0;

        $employee = Employee::with('salary')->findOrFail($employeeId);

        // Hitung potongan asuransi
        $potonganAsuransi = $employee->bpjs == 'bpjs' ? ($employee->salary->base_salary + $employee->salary->fix_allowance) * 0.01 : 0;

        // Hitung total gaji untuk karyawan bulanan
        $totalGaji = 0;
        if ($employee->employee_type == 'monthly') {
            $totalGaji = $employee->salary->base_salary + $employee->salary->fix_allowance - $potonganKehadiran - $potonganAsuransi;
        } elseif ($employee->employee_type == 'daily') {
            $totalGaji = $employee->salary->base_salary * $hadir - $potonganKehadiran - $potonganAsuransi;
        }

        return $totalGaji;
    }

    private function calculateWorkDays($startDate, $endDate)
    {
        $jumlahHariKerja = 0;
        $currentDate = $startDate->copy();
        while ($currentDate->lte($endDate)) {
            if (!$currentDate->isSunday()) {
                $jumlahHariKerja++;
            }
            $currentDate->addDay();
        }
        return $jumlahHariKerja;
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
