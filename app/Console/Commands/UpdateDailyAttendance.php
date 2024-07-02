<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Permission;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateDailyAttendance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Perbarui kehadiran harian dan tandai karyawan sebagai alfa jika mereka tidak hadir atau tidak memiliki izin yang disetujui selambat-lambatnya pukul 23.00';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('Attendance update command started.');
        $now = Carbon::now();
        $today = $now->toDateString();
        $cutOffTime = Carbon::parse('14:09:00'); // Waktu batas adalah jam 11 malam

        // Jika sudah melewati waktu batas, periksa karyawan yang belum absen atau izin yang sudah di-approve
        if ($now->greaterThanOrEqualTo($cutOffTime)) {
            // Ambil semua karyawan
            $employees = Employee::all();

            foreach ($employees as $employee) {
                // Cek apakah sudah ada data absensi untuk karyawan pada tanggal hari ini
                $attendance = Attendance::where('employee_id', $employee->id)
                    ->whereDate('date', $today)
                    ->first();

                // Cek apakah sudah ada izin yang di-approve untuk karyawan pada hari ini
                $approvedPermission = Permission::where('employee_id', $employee->id)
                    ->whereDate('start_date', $today)
                    ->where('status', 'Approved')
                    ->exists();

                // Jika belum ada data absensi dan tidak ada izin yang di-approve, buat data absensi dengan status 'alpha'
                if (!$attendance && !$approvedPermission) {
                    Attendance::create([
                        'employee_id' => $employee->id,
                        'date' => $today,
                        'status' => 'alpha',
                    ]);
                }
            }

            $this->info('Daily attendance updated with alpha status for missing records.');
        }
    }
}
