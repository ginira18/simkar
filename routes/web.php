    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\EmployeeController;
    use App\Http\Controllers\RegisterController;
    use App\Http\Controllers\AttendanceController;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\EmployeeSettingController;
    use App\Http\Controllers\LoginController;
use App\Http\Controllers\SalaryController;

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
    Route::get('/', [LoginController::class, 'showLoginForm']);

    Route::middleware('admin')->group(function () {
        // Dashboard
        // Route::get('/', [DashboardController::class, 'index']);
        Route::resource('dashboard', DashboardController::class);
        // Karyawan
        Route::resource('karyawan', EmployeeController::class);
        Route::post('karyawan/{id}/deactivate', [EmployeeController::class, 'deactivate'])->name('karyawan.deactivate');
        Route::post('karyawan/{id}/activate', [EmployeeController::class, 'activate'])->name('karyawan.activate');

        // Pengaturan Karyawan
        Route::resource('pengaturan-karyawan', EmployeeSettingController::class);
        Route::post('/pengaturan-karyawan/{id}/deactivate', [EmployeeSettingController::class, 'deactivate'])->name('pengaturan-karyawan.deactivate');
        Route::post('/pengaturan-karyawan/{id}/activate', [EmployeeSettingController::class, 'activate'])->name('pengaturan-karyawan.activate');
        
        // Kehadiran
        Route::resource('dashboard-kehadiran', AttendanceController::class);
        Route::get('/dashboard-kehadiran/current-time', [AttendanceController::class, 'getCurrentTime'])->name('dashboard-kehadiran.current-time');
        Route::get('/dashboard-izin', [AttendanceController::class, 'izin_admin'])->name('dashboard-izin');
        Route::get('/admin/izin/{id}', [AttendanceController::class, 'detail_izin_admin'])->name('detail-izin-admin');
        Route::post('/admin/izin/{id}/approve', [AttendanceController::class, 'izin_approve'])->name('approve-izin');

        // Gaji
        Route::resource('dashboard-gaji', SalaryController::class);

    });

    // presensi
    Route::get('/presensi', [AttendanceController::class, 'presensi_guest_create'])->name('presensi');
    Route::post('/presensi', [AttendanceController::class, 'presensi_guest_store'])->name('presensi');



    // Register
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
    Route::post('/register', [RegisterController::class, 'register']);

    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Gaji
    Route::get('/gaji', function () {
        return view('admin/gaji/daftar_gaji');
    });

    //Laporan
    Route::get('/laporan_gaji', function () {
        return view('laporan/laporan_gaji');
    });
    Route::get('/laporan_karyawan', function () {
        return view('laporan/laporan_karyawan');
    });


    Route::middleware('employee')->group(function () {

        Route::get('dashboard-karyawan', [DashboardController::class, 'index_karyawan'])->name('dashboard-karyawan');;
        Route::get('kehadiran-karyawan', [AttendanceController::class, 'index_karyawan'])->name('kehadiran-karyawan');;
        Route::get('izin-karyawan', [AttendanceController::class, 'izin_karyawan'])->name('izin-karyawan');;
        Route::get('izin-karyawan/create', [AttendanceController::class, 'izin_create'])->name('izin-karyawan-create');;
        Route::post('izin-karyawan/store', [AttendanceController::class, 'izin_store'])->name('izin-karyawan-store');
        Route::get('/izin/{id}/detail', [AttendanceController::class, 'izin_detail'])->name('izin.detail');
        Route::get('/izin/edit/{id}', [AttendanceController::class, 'izin_edit'])->name('izin.edit');
        Route::get('/izin/edit/{id}', [AttendanceController::class, 'izin_edit'])->name('izin.edit');



        // Route::get('/kehadiran', function () {
        //     return view('pengguna/kehadiran');
        // });
        // Route::get('dashboard', [DashboardController::class, 'index_karyawan']);
        Route::get('/pengguna/home', function () {
            return view('pengguna/home');
        });
        Route::get('/pengguna/kehadiran', function () {
            return view('pengguna/kehadiran');
        });
    });
