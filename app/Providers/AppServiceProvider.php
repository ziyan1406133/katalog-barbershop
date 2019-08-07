<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Barbershop;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $nav_pending = Barbershop::where('status', 'Belum Terverifikasi')->orderBy('updated_at', 'desc')->limit(10)->get();
        
        View::share('nav_pending', $nav_pending);
    }
}
