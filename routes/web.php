    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\EmployeeController;
    use App\Http\Controllers\RegisterController;
    use App\Http\Controllers\AttendanceController;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\EmployeeSettingController;
    use App\Http\Controllers\LoginController;
    use App\Http\Controllers\SalaryController;
    use App\Http\Controllers\ReportController;
    use App\Http\Controllers\SummaryController;

    use App\Models\Attendance;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider and all of them will
    | be assigned to the "web" middleware group. Make something great!
    |
    */

    // Route::get('/welcome', function () {return view('welcome');});
    // Route::get('/', function () {return view('dashboard');});
    // Route::get('/', function () {
    //     return view('login/index');
    // });

    Route::middleware('admin')->group(function () {
        // Dashboard
        // Route::get('/', [DashboardController::class, 'index']);
        Route::resource('dashboard', DashboardController::class);
        // Karyawan
        Route::resource('karyawan', EmployeeController::class);
        Route::post('karyawan/{id}/reset', [EmployeeController::class, 'reset'])->name('karyawan.reset');
        Route::post('karyawan/{id}/deactivate', [EmployeeController::class, 'deactivate'])->name('karyawan.deactivate');
        Route::post('karyawan/{id}/activate', [EmployeeController::class, 'activate'])->name('karyawan.activate');

        // Pengaturan Karyawan
        Route::resource('pengaturan-karyawan', EmployeeSettingController::class);
        Route::post('/pengaturan-karyawan/{id}/deactivate', [EmployeeSettingController::class, 'deactivate'])->name('pengaturan-karyawan.deactivate');
        Route::post('/pengaturan-karyawan/{id}/activate', [EmployeeSettingController::class, 'activate'])->name('pengaturan-karyawan.activate');
        Route::delete('pengaturan-karyawan/{id}/destroy-employee', [EmployeeSettingController::class, 'employeeDestroy'])->name('pengaturan-karyawan.employeeDestroy');
        Route::delete('pengaturan-karyawan/{id}/destroy-department', [EmployeeSettingController::class, 'destroyDepartment'])->name('pengaturan-karyawan.destroyDepartment');

        // Kehadiran
        Route::resource('dashboard-kehadiran', AttendanceController::class);
        Route::get('/dashboard-kehadiran/current-time', [AttendanceController::class, 'getCurrentTime'])->name('dashboard-kehadiran.current-time');
        Route::get('/dashboard-izin', [AttendanceController::class, 'izin_admin'])->name('dashboard-izin');
        Route::get('/admin/izin/{id}', [AttendanceController::class, 'detail_izin_admin'])->name('detail-izin-admin');
        Route::post('/admin/izin/{id}/approve', [AttendanceController::class, 'izin_approve'])->name('approve-izin');
        Route::post('/end-attendance', [AttendanceController::class, 'endAttendance'])->name('end-attendance');
        Route::get('/riwayat-kehadiran', [AttendanceController::class, 'riwayat_kehadiran'])->name('riwayat-kehadiran');

        // Gaji
        Route::resource('dashboard-gaji', SalaryController::class);
        Route::get('/salary/{id}', [SalaryController::class, 'show'])->name('salary.show');
        Route::post('gaji/{id}/give-salary', [SalaryController::class, 'giveSalary'])->name('gaji.give-salary');
        Route::get('dashboard-riwayat_gaji', [SalaryController::class, 'salaryHistory'])->name('dashboard-riwayat_gaji');
        Route::get('salary-history/{id}', [SalaryController::class, 'history_salary_detail'])->name('history_salary.show');
        Route::get('salary-history-slip/{id}', [SalaryController::class, 'hisoty_salary_slip'])->name('history_salary.slip');

        // Laporan
        Route::resource('dashboard-laporan', ReportController::class);

        // Rekap
        Route::get('dashboard-rekap', [SummaryController::class, 'index'])->name('dashboard.rekap');
        Route::get('detail_rekap/{month}', [SummaryController::class, 'show'])->name('detail-rekap');
        Route::get('detail_rekap/{month}/export-csv', [SummaryController::class, 'exportCsv'])->name('dashboard-laporan.exportCsv');
    });

    Route::middleware('employee')->group(function () {

        Route::get('dashboard-karyawan', [DashboardController::class, 'index_karyawan'])->name('dashboard-karyawan');
        // kehadiran
        Route::get('kehadiran-karyawan', [AttendanceController::class, 'index_karyawan'])->name('kehadiran-karyawan');;
        // izin
        Route::get('izin-karyawan', [AttendanceController::class, 'izin_karyawan'])->name('izin-karyawan');;
        Route::get('izin-karyawan/create', [AttendanceController::class, 'izin_create'])->name('izin-karyawan-create');;
        Route::post('izin-karyawan/store', [AttendanceController::class, 'izin_store'])->name('izin-karyawan-store');
        Route::get('/izin/{id}/detail', [AttendanceController::class, 'izin_detail'])->name('izin.detail');
        Route::get('/izin/edit/{id}', [AttendanceController::class, 'izin_edit'])->name('izin-edit-create');
        Route::put('izin/{id}/edit', [AttendanceController::class, 'izin_update'])->name('izin-edit-update');
        // laporan
        Route::get('/laporan-karyawan', [ReportController::class, 'laporan_karyawan'])->name('laporan-karyawan');
        Route::get('/karyawan/laporan/create', [ReportController::class, 'create_karyawan_report'])->name('karyawan.laporan.create');
        Route::post('/karyawan/laporan', [ReportController::class, 'store_karyawan_report'])->name('karyawan.laporan.store');
        Route::get('laporan/{id}', [ReportController::class, 'show_karyawan_report'])->name('laporan.show');
        Route::get('/karyawan/laporan/{id}/edit', [ReportController::class, 'edit_karyawan_report'])->name('karyawan.laporan.edit');
        Route::put('/laporan-karyawan/{id}/update', [ReportController::class, 'update_karyawan_report'])->name('laporan-karyawan.update');
        // Gaji
        Route::get('/gaji-karyawan', [SalaryController::class, 'index_karyawan'])->name('gaji-karyawan');
        Route::get('karyawan/gaji/{id}', [SalaryController::class, 'show_karyawan'])->name('detail-gaji-karyawan');
        // Route::get('/gaji-karyawan/{id}/slip', [SalaryController::class, 'printSlipGaji'])->name('slip-gaji-karyawan');
        Route::get('/gaji/slip/{id}', [SalaryController::class, 'slip'])->name('gaji.slip');
    });

    // presensi
    Route::get('/presensi', [AttendanceController::class, 'presensi_guest_create'])->name('presensi');
    Route::post('/presensi', [AttendanceController::class, 'presensi_guest_store'])->name('presensi');

    // Register
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
    Route::post('/register', [RegisterController::class, 'register']);

    // Login
    Route::get('/', [LoginController::class, 'showLoginForm'])->middleware('guest');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Gaji
    // Route::get('/gaji', function () {
    //     return view('admin/gaji/daftar_gaji');
    // });

    //Laporan
    // Route::get('/laporan_gaji', function () {
    //     return view('laporan/laporan_gaji');
    // });
    // Route::get('/laporan_karyawan', function () {
    //     return view('laporan/laporan_karyawan');
    // });

    // slip_gaji
    // Route::get('/slip-gaji',function(){
    //     return view('slip_gaji');
    // });

    // Route::get('/kehadiran', function () {
    //     return view('pengguna/kehadiran');
    // });
    // Route::get('dashboard', [DashboardController::class, 'index_karyawan']);
    // Route::get('/pengguna/home', function () {
    //     return view('pengguna/home');
    // });
    // Route::get('/pengguna/kehadiran', function () {
    //     return view('pengguna/kehadiran');
    // });