<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Salary;
use Illuminate\Http\Request;

use function Laravel\Prompts\alert;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'karyawan.daftar_karyawan',
            ['employees' => Employee::all()]
        );
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

        $validated = $request->validate(
            [
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
                'rfid_number' => 'unique:employees',
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
            "rfid_number" => $request->rfid_number,
        ]);

        return redirect('/karyawan')->with('success', 'Data Karyawan Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Employee $employee)
    // {
    //     // // dd($id);
    //     // return $employee;
    //     // // return view('karyawan.detail_karyawan', [
    //     // //     "employee" => $employee
    //     // // ]);

    // }
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        // dd($employee);

        return view('karyawan.detail_karyawan', [
            "employee" => $employee
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        // dd($employee);
        return view('karyawan.edit_karyawan', [
            'employee' => $employee,
            'departments' => Department::all(),
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
        $employee = Employee::findOrFail($id);

        $validated = $request->validate([
            'nip' => 'required|numeric|unique:employees,NIP,' . $employee->id,
            'name' => 'required',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
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
            'rfid_number' => 'nullable|unique:employees,rfid_number,' . $employee->id,
        ]);

        $validated["base_salary"] = str_replace(".", "", $validated["base_salary"]);
        $validated["fix_allowance"] = str_replace(".", "", $validated["fix_allowance"]);

        $salary = Salary::where('base_salary', $validated["base_salary"])
            ->where('fix_allowance', $validated["fix_allowance"])
            ->first();

        if (!$salary) {
            $salary_id = Salary::insertGetId([
                'base_salary' => $validated["base_salary"],
                'fix_allowance' => $validated["fix_allowance"],
            ]);
        } else {
            $salary_id = $salary->id;
        }

        $employee->update([
            "NIP" => $validated["nip"],
            "name" => $validated["name"],
            "email" => $validated["email"],
            "birth_date" => $validated["birth_date"],
            "gender" => $validated["gender"],
            "religion" => $validated["religion"],
            "phone_number" => $validated["phone_number"],
            "last_education" => $validated["last_education"],
            "address" => $validated["address"],
            "hire_date" => $validated["hire_date"],
            "hire_date_end" => $validated["hire_date_end"],
            "position" => $validated["position"],
            "employee_type" => $validated["employee_type"],
            "bpjs" => $validated["bpjs"],
            "department_id" => $request->department_id,
            "salary_id" => $salary_id,
            "rfid_number" => $validated["rfid_number"],
        ]);

        return redirect('/karyawan')->with('success', 'Data Karyawan Berhasil Diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json([
                'message' => "Data pegawai tidak ditemukan !"
            ], 404);
        }
    }
}
