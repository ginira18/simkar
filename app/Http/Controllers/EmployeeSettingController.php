<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Salary;



class EmployeeSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activeDepartments = Department::where('is_active', true)->get();
        $inactiveDepartments = Department::where('is_active', false)->get();
        $inactiveEmployees = Employee::where('is_active', false)->get();

        return view('admin.karyawan.pengaturan.pengaturan_menu', [
            'activeDepartments' => $activeDepartments,
            'inactiveDepartments' => $inactiveDepartments,
            'inactiveEmployees' => $inactiveEmployees,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:departments,name',
        ]);
        Department::create($validated);

        return redirect('pengaturan-karyawan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('admin.karyawan.pengaturan.pengaturan_detail_karyawan', [
            "employee" => $employee
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::all();

        return view('admin.karyawan.pengaturan.pengaturan_edit_karyawan', [
            'employee' => $employee,
            'departments' => $departments,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $employee = Employee::findOrFail($id);
        $validated = $request->validate([
            'nip' => 'required|numeric|unique:employees,NIP,' . $id,
            'name' => 'required',
            'email' => 'required|email|unique:employees,email,' . $id,
            'birth_date' => 'required|date',
            'gender' => 'required',
            'religion' => 'required',
            'phone_number' => 'required',
            'last_education' => 'required',
            'address' => 'required',
            'hire_date' => 'required|date',
            'hire_date_end' => 'required|date',
            'position' => 'required',
            'employee_type' => 'required',
            'base_salary' => 'required',
            'fix_allowance' => 'required',
            'bpjs' => 'required',
            'rfid_number' => 'unique:employees,rfid_number,' . $id,
            'department_id' => 'required|exists:departments,id',
        ]);

        // Menghapus titik dari nominal gaji
        $base_salary = str_replace(".", "", $request->base_salary);
        $fix_allowance = str_replace(".", "", $request->fix_allowance);

        $employee = Employee::findOrFail($id);
        $employee->update([
            "NIP" => $request->nip,
            "name" => $request->name,
            "email" => $request->email,
            "birth_date" => $request->birth_date,
            "gender" => $request->gender,
            "religion" => $request->religion,
            "phone_number" => $request->phone_number,
            "last_education" => $request->last_education,
            "address" => $request->address,
            "hire_date" => $request->hire_date,
            "hire_date_end" => $request->hire_date_end,
            "position" => $request->position,
            "employee_type" => $request->employee_type,
            "bpjs" => $request->bpjs,
            "department_id" => $request->department_id,
            "rfid_number" => $request->rfid_number,
        ]);

        $salary = Salary::where('id', $id)->firstOrFail();
        $salary->update([
            "base_salary" => $base_salary,
            "fix_allowance" => $fix_allowance,
        ]);

        return redirect()->route('pengaturan-karyawan.show', $employee->id)->with('success', 'Data Karyawan Berhasil Diperbarui');
    }

    public function deactivate($id)
    {
        $department = Department::findOrFail($id);
        $department->employees()->update(['is_active' => false]);
        $department->is_active = false;
        $department->save();

        return redirect()->back();
    }
    public function activate($id)
    {
        $department = Department::findOrFail($id);
        $department->employees()->update(['is_active' => true]);
        $department->is_active = true;
        $department->save();

        return redirect()->back();
    }
    public function employeeDestroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect('pengaturan-karyawan')->with('success', 'Karyawan berhasil dihapus.');
    }
    /**
     * Remove the specified resource from storage.
     */
    // public function destroy($id)
    // {
    //     // Temukan departemen berdasarkan ID
    //     $department = Department::findOrFail($id);

    //     $employees = Employee::where('department_id', $id)->exists();

    //     if ($employees) {
    //         return redirect('pengaturan-karyawan')->with('status_error', 'Tidak dapat menghapus bagian, karena masih ada karyawan terkait.');
    //     }

    //     $department->delete();

    //     return redirect('pengaturan-karyawan')->with('status_success', 'Bagian berhasil dihapus.');
    // }


    public function destroyDepartment($id)
    {
        $department = Department::findOrFail($id);

        $employees = Employee::where('department_id', $id)->exists();

        if ($employees) {
            return redirect('pengaturan-karyawan')->with('status_error', 'Tidak dapat menghapus bagian, karena masih ada karyawan terkait.');
        }

        $department->delete();

        return redirect('pengaturan-karyawan')->with('status_success', 'Bagian berhasil dihapus.');
    }

}
