<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

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
        Department::insert($validated);

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
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Temukan departemen berdasarkan ID
        $department = Department::findOrFail($id);
        
        $employees = Employee::where('department_id', $id)->exists();

        if ($employees) {
            return redirect('pengaturan-karyawan')->with('status_error', 'Tidak dapat menghapus bagian, karena masih ada karyawan terkait.');
        }

        $department->delete();

        return redirect('pengaturan-karyawan')->with('status_success', 'Bagian berhasil dihapus.');
    }
}
