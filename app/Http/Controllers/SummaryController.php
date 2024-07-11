<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\SalaryHistory;
use Carbon\Carbon;




class SummaryController extends Controller
{
    public function index()
    {
        $salaryHistories = SalaryHistory::with(['employee'])
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total_salary) as total')
            ->groupBy('month')
            ->get();

        return view('admin.rekap.daftar_rekap')->with('salaryHistories', $salaryHistories);
    }

    public function show($month)
    {
        $salaryHistories = SalaryHistory::with(['employee.department'])
            ->where('created_at', 'LIKE', $month . '%')
            ->get();

        return view('admin.rekap.detail_rekap', compact('salaryHistories', 'month'));
    }

    public function exportCsv($month)
    {
        $salaryHistories = SalaryHistory::with(['employee.department'])
            ->where('created_at', 'LIKE', $month . '%')
            ->get();

        $filename = "rekap_gaji_{$month}.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['No', 'Nama', 'NIP', 'Bagian', 'Jabatan', 'Total Gaji Diterima']);

        foreach ($salaryHistories as $index => $salaryHistory) {
            fputcsv($handle, [
                $index + 1,
                $salaryHistory->employee->name,
                $salaryHistory->employee->NIP,
                $salaryHistory->employee->department->name,
                $salaryHistory->employee->position,
                number_format($salaryHistory->total_salary, 0, ',', '.')
            ]);
        }

        fclose($handle);

        return response()->download($filename)->deleteFileAfterSend(true);
    }
}
