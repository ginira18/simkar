<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Employee;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Admin
    public function index(Request $request)
    {
        $reports = Report::with(['employee.department'])
            ->where(function ($query) use ($request) {
                $query->whereHas('employee', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                })
                    ->orWhereHas('employee.department', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->search . '%');
                    })
                    ->orWhere('date', 'like', '%' . $request->search . '%')
                    ->orWhere('title', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->paginate(5);

        foreach ($reports as $report) {
            $report->short_title = Str::limit($report->title, 20);
        }

        return view('admin.laporan.dashboard_laporan', compact('reports'));
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
        $report = Report::findOrFail($id);

        return view('admin.laporan.detail_laporan', compact('report'));
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
    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();

        return redirect()->route('dashboard-laporan.index')
            ->with('success', 'Laporan berhasil dihapus');
    }


    // Karyawan
    public function laporan_karyawan(Request $request)
    {
        $employeeId = Auth::id();

        $date = $request->input('date');
        $title = $request->input('title');

        $query = Report::where('employee_id', $employeeId);

        if ($date) {
            $query->whereDate('date', $date);
        }

        if ($title) {
            $query->where('title', 'like', "%{$title}%");
        }

        $reports = $query->paginate(30);

        return view('pegawai.laporan', [
            'reports' => $reports,
            'selectedDate' => $date,
            'selectedTitle' => $title,
        ]);
    }

    public function create_karyawan_report()
    {
        return view('pegawai.tambah_laporan');
    }
    public function store_karyawan_report(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'evidence' => 'nullable|file|max:2048',
        ]);

        if ($request->hasFile('evidence')) {
            $evidencePath = $request->file('evidence')->store('evidence', 'public');
        } else {
            $evidencePath = null;
        }

        Report::create([
            'employee_id' => Auth::id(),
            'date' => $request->date,
            'title' => $request->title,
            'description' => $request->description,
            'evidence' => $evidencePath,
        ]);

        return redirect()->route('laporan-karyawan')->with('success', 'Laporan berhasil ditambahkan');
    }

    public function show_karyawan_report($id)
    {
        $report = Report::findOrFail($id);

        return view('pegawai.detail_laporan', compact('report'));
    }

    public function edit_karyawan_report($id)
    {
        $report = Report::findOrFail($id);
        if ($report->employee_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('pegawai.edit_laporan', compact('report'));
    }

    public function update_karyawan_report(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'evidence' => 'nullable|file|max:2048',
        ]);

        $report = Report::findOrFail($id);

        if ($request->hasFile('evidence')) {
            if ($report->evidence) {
                Storage::disk('public')->delete($report->evidence);
            }
            $evidencePath = $request->file('evidence')->store('evidence', 'public');
            $report->evidence = $evidencePath;
        }

        $report->title = $request->title;
        $report->description = $request->description;
        $report->save();

        return redirect()->route('laporan-karyawan')->with('success', 'Laporan berhasil diperbarui');
    }
}
