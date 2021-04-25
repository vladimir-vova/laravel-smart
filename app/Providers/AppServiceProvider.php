<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

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
        // DB::listen(function ($query) {
        // dump($query->sql, $query->bindings);
        //     dump($query->sql);
        // });
        // if (Auth::check()) {
        //     echo 'Yes';
        // }else{
        //     echo 'No';
        // }
        // dd(Auth::user());
    }
}
