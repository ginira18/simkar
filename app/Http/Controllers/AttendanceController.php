<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Permission;
use Illuminate\Support\Facades\Storage;
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


    public function izin_admin(Request $request)
    {
        $search = $request->input('search');

        $query = Permission::query()
            ->when($search, function ($query, $search) {
                return $query->whereHas('employee', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                    ->orWhere('start_date', 'like', "%{$search}%")
                    ->orWhere('end_date', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%");
            });

        $permissions = $query->paginate(10);

        return view('admin.kehadiran.kehadiran_izin', [
            'permissions' => $permissions,
        ]);
    }


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
        if ($attendance && $attendance->status == 'izin') {
            return redirect(route("dashboard-kehadiran.create"))
                ->with('status_error', "Anda sedang izin hari ini!");
        }
        // if ($attendance && $attendance->check_out != null) {
        //     return redirect(route("dashboard-kehadiran.create"))->with('status_error', "Karyawan sudah melakukan absen hari ini!");
        // }

        if ($attendance) {
            if (now()->diffInSeconds($attendance->check_in) < 1) {
                return redirect(route("dashboard-kehadiran.create"))->with('status_error', "Tunggu beberapa saat lagi untuk melakukan presensi!");
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

        return redirect(route("dashboard-kehadiran.create"))->with([
            'status_success' => "Absen berhasil!",
            'employee_name' => $employee->name,
        ]);
    }

    // public function endAttendance(Request $request)
    // {

    //     $today = Carbon::now()->toDateString();

    //     $employees = Employee::all();

    //     foreach ($employees as $employee) {
    //         $attendance = Attendance::where('employee_id', $employee->id)
    //             ->whereDate('date', $today)
    //             ->first();

    //         if (!$attendance) {
    //             Attendance::create([
    //                 'employee_id' => $employee->id,
    //                 'date' => $today,
    //                 'status' => 'alpha',
    //             ]);
    //         }
    //     }

    //     return redirect()->back()->with('status_success', 'Presensi hari ini telah ditutup.');
    // }

    public function riwayat_kehadiran(Request $request)
    {
        $search = $request->input('search');

        $query = Attendance::query();

        if ($search) {
            $query->whereHas('employee', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('NIP', 'like', "%{$search}%")
                    ->orWhereHas('department', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
                ->orWhere('date', 'like', "%{$search}%")
                ->orWhere('keterangan', 'like', "%{$search}%")
                ->orWhere('status', 'like', "%{$search}%");
        }

        $attendances = $query->paginate(10);

        return view('admin.kehadiran.riwayat_kehadiran', ['attendances' => $attendances]);
    }

    // Karyawan
    public function index_karyawan(Request $request)
    {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);

        $attendances = Attendance::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->paginate(30);

        $employees = Employee::all();

        return view('pegawai.kehadiran', [
            'attendances' => $attendances,
            'employees' => $employees
        ]);
    }

    public function izin_karyawan(Request $request)
    {
        // Ambil parameter tanggal dan status dari query string
        $date = $request->input('date');
        $status = $request->input('status');

        // Query dasar
        $query = auth()->user()->employee->permissions();

        // Filter berdasarkan tanggal
        if ($date) {
            $query->where(function ($q) use ($date) {
                $q->whereDate('start_date', $date)
                    ->orWhereDate('end_date', $date);
            });
        }

        // Filter berdasarkan status
        if ($status) {
            $query->where('status', $status);
        }

        // Pagination dengan 10 item per halaman
        $permissions = $query->paginate(10);

        return view('pegawai.daftar_izin', [
            'permissions' => $permissions,
            'selectedDate' => $date,
            'selectedStatus' => $status,
        ]);
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
        $existingAttendances = Attendance::where('employee_id', $employee->id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('date', [$request->start_date, $request->end_date])
                    ->whereIn('status', ['hadir', 'izin']);
            })
            ->exists();

        if ($existingAttendances) {
            return redirect()->back()->with('status_error', 'Anda sudah memiliki presensi atau izin dalam rentang tanggal yang diajukan!');
        }

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
            $file->storeAs('evidence_izin', $filename);
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

    public function izin_update(Request $request, $id)
{
    $permission = Permission::findOrFail($id);

    // Cek status izin
    if ($permission->status !== 'Pending') {
        return redirect()->route('izin.detail', $id)
            ->with('status_error', 'Anda tidak dapat mengedit izin yang statusnya sudah ' . $permission->status);
    }

    // Validasi data
    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'reason' => 'required|string',
        'evidence' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
    ]);

    // Update izin
    $permission->update([
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'reason' => $request->reason,
    ]);

    if ($request->hasFile('evidence')) {
        if ($permission->evidence) {
            Storage::delete('public/evidence_izin/' . $permission->evidence);
        }

        $file = $request->file('evidence');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('evidence_izin', $filename, 'public');

        $permission->update(['evidence' => $filename]);
    }

    return redirect()->route('izin.detail', $id)->with('status_success', 'Izin berhasil diperbarui!');
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
            return redirect(route("presensi"))->with('status_error', "Data karyawan tidak ditemukan!");
        }
        $attendance = Attendance::where('employee_id', $employee->id)->whereDate('date', now())->first();
        // if ($attendance && $attendance->check_out != null) {
        //     return redirect(route("dashboard-kehadiran.create"))->with('status_error', "Karyawan sudah melakukan absen hari ini!");
        // }

        if ($attendance) {
            if (now()->diffInSeconds($attendance->check_in) < 1) {
                return redirect(route("presensi"))->with('status_error', "Karyawan sudah melakukan absen hari ini!");
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
        return redirect(route("presensi"))->with('status_success', "Absen berhasil!");
    }
}
