<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\SalaryHistory;

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
    public function salaryHistory()
    {
        $employees = Employee::with(['department', 'salaryHistories'])->get();

        return view('admin.gaji.daftar_gaji')->with('employees', $employees);
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
    public function show($id)
    {
        $employee = Employee::with('department', 'salary')->findOrFail($id);

        // Hitung jumlah kehadiran dengan status masing-masing
        $izin = Attendance::where('employee_id', $id)->where('status', 'izin')->count();
        $alpha = Attendance::where('employee_id', $id)->where('status', 'alpha')->count();
        $terlambat = Attendance::where('employee_id', $id)->where('keterangan', 'terlambat')->count();

        // Hitung potongan Kehadiran
        $potonganKehadiran = $terlambat * 10000;
        $potonganKehadiran += $alpha > 0 ? 50000 : 0;

        // Hitung potongan asuransi 
        $potonganAsuransi = $employee->bpjs == 'bpjs' ? ($employee->salary->base_salary + $employee->salary->fix_allowance) * 0.01 : 0;

        // Hitung total gaji setelah potongan
        $totalGaji = $employee->salary->base_salary + $employee->salary->fix_allowance - $potonganKehadiran - $potonganKehadiran - $potonganAsuransi;

        return view('admin.gaji.gaji_detail', compact('employee', 'izin', 'terlambat', 'alpha', 'potonganKehadiran', 'potonganAsuransi', 'totalGaji'));
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

        $employee->salary->status = 'diberikan';
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
}
