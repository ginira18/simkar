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

        $totalGajiKeseluruhan = $salaryHistories->sum('total_salary');

        return view('admin.rekap.detail_rekap', compact('salaryHistories', 'month', 'totalGajiKeseluruhan'));
    }

    public function exportCsv($month)
    {
        $salaryHistories = SalaryHistory::with(['employee.department'])
            ->where('created_at', 'LIKE', $month . '%')
            ->get();

        $filename = "rekap_gaji_{$month}.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['No', 'Nama', 'NIP', 'Bagian', 'Jabatan','Asuransi','Hadir', 'Alpha', 'Izin', 'Total Gaji Diterima']);

        $totalGajiKeseluruhan = 0;

        foreach ($salaryHistories as $index => $salaryHistory) {
            $totalGajiKeseluruhan += $salaryHistory->total_salary;

            fputcsv($handle, [
                $index + 1,
                $salaryHistory->employee->name,
                $salaryHistory->employee->NIP,
                $salaryHistory->employee->department->name,
                $salaryHistory->employee->position,
                $salaryHistory->employee->bpjs,
                $salaryHistory->hadir,
                $salaryHistory->alpha,
                $salaryHistory->izin,
                number_format($salaryHistory->total_salary, 0, ',', '.'),
            ]);
        }

        fputcsv($handle, ['Total Gaji Keseluruhan', '', '', '', '','', '', '', '', number_format($totalGajiKeseluruhan, 0, ',', '.'), '', '', '', '']);

        fclose($handle);

        // dd($totalGajiKeseluruhan);
        return response()->download($filename)->deleteFileAfterSend(true);
    }
}
