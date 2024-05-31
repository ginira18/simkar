<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Salary;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('karyawan.daftar_karyawan');
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('karyawan.tambah_karyawan', [
            'departments' => Department::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return request()->all();
        // return request();
        // return $request;
        $validated = $request->validate(
            [
                'nip' => 'required|unique:employees,NIP|numeric',
                'name' => 'required',
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
            ]
        );
        $request["base_salary"] = str_replace(".", "", $request->base_salary);
        $request["fix_allowance"] = str_replace(".", "", $request->fix_allowance);
        $salary = Salary::where('base_salary', $request->base_salary)->where('fix_allowance', $request->fix_allowance)->first();
        if (!$salary) {
            $salary_id = Salary::insertGetId([
                'base_salary' => $request->base_salary,
                'fix_allowance' => $request->fix_allowance,
            ]);
        } else {
            $salary_id = $salary->id;
        }

        Employee::insert([
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
            "salary_id" => $salary_id,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('karyawan/detail_karyawan', [
            "employee" => $employee,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
