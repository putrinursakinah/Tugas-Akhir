<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\TahunAjaran;

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
        View::composer('*', function ($view) {
            $tahunAjaranList = TahunAjaran::orderBy('tahun', 'desc')->get();
            $view->with('tahunAjaranList', $tahunAjaranList);
        });
    }
}
