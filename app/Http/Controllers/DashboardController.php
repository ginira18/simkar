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

        $monthlyEmployees = Employee::where('employee_type', 'monthly')
            ->where('is_active', true)
            ->count();

        $dailyEmployees = Employee::where('employee_type', 'daily')
            ->where('is_active', true)
            ->count();
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
        $user = auth()->user();

        $today = now()->toDateString();

        // Data Kehadiran hari ini
        $kehadiranHariIni = Attendance::where('employee_id', $user->id)
            ->whereDate('date', $today)
            ->first();


        $latestSalary = SalaryHistory::where('employee_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();

        $totalGaji = $latestSalary ? $latestSalary->total_salary : 0;
        $lastSalaryMonth = $latestSalary ? Carbon::parse($latestSalary->created_at)->translatedFormat('F Y') : '';

        // Jumlah izin pending bulan ini
        $izinPending = Permission::where('employee_id', $user->id)
            ->where('status', 'pending')
            ->count();

        // Data untuk chart kehadiran
        $latestSalaryHistory = SalaryHistory::where('employee_id', $user->id)
            ->latest('created_at')
            ->first();

        if (!$latestSalaryHistory) {
            $hadir = $izin = $alpha = 0;
        } else {
            $hadir = $latestSalaryHistory->hadir;
            $izin = $latestSalaryHistory->izin;
            $alpha = $latestSalaryHistory->alpha;
        }

        // Data untuk chart total gaji per bulan (6 bulan terakhir)
        $labels = collect();
        $totalSalaries = collect();

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $labels->push($date->translatedFormat('F Y'));
            $totalSalaries->push(
                SalaryHistory::where('employee_id', $user->id)
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->sum('total_salary')
            );
        }

        return view('pegawai.dashboard', compact('kehadiranHariIni', 'lastSalaryMonth', 'totalGaji', 'izinPending', 'hadir', 'alpha', 'izin', 'labels', 'totalSalaries'));
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
