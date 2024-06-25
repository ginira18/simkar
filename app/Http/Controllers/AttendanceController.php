<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Permission;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = now()->toDateString();
        $attendances = Attendance::whereDate('date', $today)->get();
        return view(
            'admin.kehadiran.menu_kehadiran',
            [
                'attendances' => $attendances,
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
        return view('admin.kehadiran.halaman_kehadiran', [
            'attendances' => Attendance::whereDate('date', $today)->get(),
            'employees' => Employee::all(),
            'today' => $today
        ]);
    }


    public function izin_admin()
    {
        $permissions = auth()->user()->employee->permissions;
        return view('admin.kehadiran.kehadiran_izin', ['permissions' => Permission::all()]);
    }

    // public function detail_izin_admin()
    // {
    //     return view('admin.kehadiran.detail_izin');
    // }

    public function detail_izin_admin($id)
    {
        $permission = Permission::findOrFail($id);
        return view('admin.kehadiran.detail_izin', [
            'permission' => $permission,
        ]);
    }
    public function izin_approve(Request $request, $id)
    {
        $request->validate([
            'button_approve' => 'required|in:Approved,Rejected',
        ]);

        $permission = Permission::findOrFail($id);

        //cek status izin
        if ($permission->status != 'Pending') {
            $response = [
                'status' => 'error',
                'message' => 'Izin sudah di-' . $permission->status,
            ];
            return redirect()->route('detail-izin-admin', $id)->with($response);
        }

        // update status table permission
        $permission->update([
            'status' => $request->button_approve,
        ]);

        // tambah data attendance jika izin di-approve sesuai range tanggal
        if ($request->button_approve == 'Approved') {
            $tanggal_awal = Carbon::parse($permission->start_date);
            $tanggal_akhir = Carbon::parse($permission->end_date);
            $rangeInDays = $tanggal_awal->diffInDays($tanggal_akhir) + 1;
            for ($i = 0; $i < $rangeInDays; $i++) {
                $tanggal = $tanggal_awal->copy()->addDays($i);
                Attendance::create([
                    'employee_id' => $permission->employee_id,
                    'date' => $tanggal,
                    'status' => 'izin',
                ]);
            }
        }

        $response = [
            'status' => 'success',
            'message' => 'Izin berhasil di-' . $request->button_approve,
        ];
        return redirect()->route('detail-izin-admin', $id)->with($response);
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
            $checkInTime = now();
            $lateTime = now()->setTime(19, 0, 0);
    
            Attendance::create([
                'employee_id' => $employee->id,
                'date' => now(),
                'check_in' => $checkInTime,
                'status' => 'hadir',
                'keterangan' => $checkInTime->greaterThan($lateTime) ? 'terlambat' : 'tepat_waktu',
            ]);
        }

        return redirect(route("dashboard-kehadiran.create"))->with('status_success', "Absen berhasil!");
    }


    // Karyawan
    public function index_karyawan()
    {
     
        return view(
            'pegawai.kehadiran',
            [
                'attendances' => Attendance::all(),
                'employees' => Employee::all()
            ]
        );
        // return view('pegawai.kehadiran');
    }

    public function izin_karyawan()
    {
        $permissions = auth()->user()->employee->permissions;
        return view('pegawai.daftar_izin', ['permissions' => $permissions]);
    }
    public function izin_create()
    {
        return view('pegawai.ajukan_izin');
    }
    public function izin_store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'reason' => 'required|string',
            'evidence' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $employee = auth()->user()->employee;

        $permissionData = [
            'employee_id' => $employee->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'status' => 'Pending',
        ];

        if ($request->hasFile('evidence')) {
            $file = $request->file('evidence');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/evidence_izin', $filename);
            $permissionData['evidence'] = $filename;
        }

        Permission::create($permissionData);

        return redirect()->route('izin-karyawan')->with('status_success', 'Izin berhasil diajukan!');
    }

    public function izin_detail($id)
    {
        $permission = Permission::findOrFail($id);
        return view('pegawai.detail_izin', compact('permission'));
    }

    public function izin_edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('pegawai.edit_izin', compact('permission'));
    }


    // Guest
    public function presensi_guest_create()
    {
        $today = Carbon::now()->toDateString();
        return view('presensi', [
            'attendances' => Attendance::whereDate('date', $today)->get(),
            'employees' => Employee::all(),
            'today' => $today
        ]);
    }
    public function presensi_guest_store(Request $request)
    {
        $validated = $request->validate([
            'nip_or_rf_id' => 'required',
        ]);

        $employee = Employee::where('rfid_number', $request->nip_or_rf_id)->orWhere('NIP', $request->nip_or_rf_id)->first();
        if (!$employee) {
            return redirect(route("presensi.create"))->with('status_error', "Data karyawan tidak ditemukan!");
        }
        $attendance = Attendance::where('employee_id', $employee->id)->whereDate('date', now())->first();
        // if ($attendance && $attendance->check_out != null) {
        //     return redirect(route("dashboard-kehadiran.create"))->with('status_error', "Karyawan sudah melakukan absen hari ini!");
        // }

        if ($attendance) {
            if (now()->diffInSeconds($attendance->check_in) < 1) {
                return redirect(route("presensi.create"))->with('status_error', "Karyawan sudah melakukan absen hari ini!");
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
        return redirect(route("presensi.create"))->with('status_success', "Absen berhasil!");
    }
}
