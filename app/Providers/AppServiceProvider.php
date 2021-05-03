<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
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
        view()->composer('admin.layouts.layout', function ($view) {
            if (Cache::has('message')) {
                $message = Cache::get('message');
            } else {
                $message = DB::table('message')->count();
                Cache::put('message', $message, 30);
            }
            $view->with('message', $message);
        });


        // if (Auth::check()) {
        //     session(['message' => 3]);
        // } else {
        //     session(['message' => 2]);
        // }
        
        // session()->forget('message');

        //     session(['message' => 3]);
        // DB::listen(function ($query) {
        // // dump($query->sql, $query->bindings);
        //     dump($query->sql);
        // });
        // dd(Auth::user());
    }
}
