<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Salary;
use Illuminate\Http\Request;
use App\Models\User;


class EmployeeController extends Controller
{
    
    public function index(Request $request)
    {
        $search = $request->input('search');

        $activeEmployees = Employee::where('is_active', true)
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('NIP', 'like', "%{$search}%")
                    ->orWhereHas('department', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    });
            })
            ->orderBy('name')
            ->paginate(15);

        return view('admin.karyawan.daftar_karyawan', [
            'activeEmployees' => $activeEmployees,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $activeDepartments = Department::where('is_active', true)->get();
        return view('admin.karyawan.tambah_karyawan', [
            'departments' => $activeDepartments,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return request()->all();

        $validated = $request->validate([
            'nip' => 'required|unique:employees,NIP|numeric',
            'name' => 'required',
            'email' => 'required|email|unique:employees',
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
            'rfid_number' => 'unique:employees |numeric',
            'department_id' => 'required|exists:departments,id',
        ]);

        // Menghapus titik dari nominal gaji
        $base_salary = str_replace(".", "", $request->base_salary);
        $fix_allowance = str_replace(".", "", $request->fix_allowance);

        // create ke tabel employees
        $employee = Employee::create([
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

        // create ke tabel salaries
        Salary::create([
            "id" => $employee->id,
            "base_salary" => $base_salary,
            "fix_allowance" => $fix_allowance,
        ]);

        return redirect('karyawan')->with('success', 'Data Karyawan Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        // dd($employee);

        return view('admin.karyawan.detail_karyawan', [
            "employee" => $employee
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);

        $activeDepartments = Department::where('is_active', true)->get();

        return view('admin.karyawan.edit_karyawan', [
            'employee' => $employee,
            'departments' => $activeDepartments,
        ]);
    }
    // {
    //     return($employee);
    //     return view('karyawan.edit_karyawan', [
    //         'employee' => $employee,
    //         'departments' => Department::all(),
    //     ]);
    // }

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

        return redirect()->route('karyawan.show', ['karyawan' => $id])->with('success', 'Data Karyawan Berhasil Diperbarui');
    }

    public function deactivate($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->update(['is_active' => false]);

        return redirect('karyawan')->with('success', 'Karyawan berhasil dinonaktifkan.');
    }
    public function activate($id)
    {
        $employee = Employee::findOrFail($id);
        if ($employee->department->is_active) {
            $employee->update(['is_active' => true]);
            return redirect('karyawan')->with('success', 'Karyawan berhasil diaktifkan.');
        } else {
            return redirect()->back()->with('error', 'Tidak dapat mengaktifkan karyawan karena bagian karyawan terkait tidak aktif.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Employee::destroy($employee->id);
        // return redirect('/karyawan')->with('success', 'Data Karyawan Berhasil Dihapus');
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect('karyawan')->with('success', 'Data Karyawan Berhasil Dihapus');
    }
 
    public function reset($id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            $user = $employee->user;
            if ($user) {
                $user->delete();
                return redirect()->route('karyawan.show', $id)->with('success', 'Akun karyawan berhasil direset.');
            }

            return redirect()->route('karyawan.show', $id)->with('error', 'Akun karyawan tidak ditemukan.');
        }
    }
}
