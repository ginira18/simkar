<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'kehadiran.menu_kehadiran',
            [
                'attendances' => Attendance::all(),
                'employees' => Employee::all()
            ]
        );

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $today = Carbon::now()->toDateString();
        return view('kehadiran.halaman_kehadiran', [
            'attendances' => Attendance::whereDate('date', $today)->get(),
            'employees' => Employee::all(),
            'today' => $today
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip_or_rf_id' => 'required',
        ]);

        $employee = Employee::where('rfid_number', $request->nip_or_rf_id)->orWhere('NIP', $request->nip_or_rf_id)->first();
        if (!$employee) {
            return redirect(route("dashboard-kehadiran.create"))->with('status_error', "Data karyawan tidak ditemukan!");
        }
        $attendance = Attendance::where('employee_id', $employee->id)->whereDate('date', now())->first();
        // if ($attendance && $attendance->check_out != null) {
        //     return redirect(route("dashboard-kehadiran.create"))->with('status_error', "Karyawan sudah melakukan absen hari ini!");
        // }

        if ($attendance) {
            if (now()->diffInSeconds($attendance->check_in) < 1) {
                return redirect(route("dashboard-kehadiran.create"))->with('status_error', "Karyawan sudah melakukan absen hari ini!");
            }   
            $attendance->update([
                'check_out' => now(),
            ]);
        } else {
            Attendance::insert([
                'employee_id' => $employee->id,
                'date' => now(),
                'check_in' => now(),
                'status' => 'hadir',
            ]);
        }

        return redirect(route("dashboard-kehadiran.create"))->with('status_success', "Absen berhasil!");

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
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
