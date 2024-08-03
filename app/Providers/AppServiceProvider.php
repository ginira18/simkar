<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\User;
// use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        Gate::define('admin', function (User $user) {
            return $user->roles === 'admin';
        });

        Gate::define('employee', function (User $user) {
            return $user->roles === 'pegawai';
        });

        Gate::define('attendance', function (User $user) {
            return $user->roles === 'presensi';
        });

    }
}
