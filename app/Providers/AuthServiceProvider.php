<?php

namespace App\Providers;

use App\Models\Note;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        view()->composer('admin.layouts.layout', function ($view) {
            if (Cache::has('message')) {
                $message = Cache::get('message');
            } else {
                $message = DB::table('message')->count();
                Cache::put('message', $message, 30);
            }
            $view->with('message', $message);

            $count_note = Note::where('open','=','1')->where('user_id','=',Auth::user()->id)->count();
            $view->with('count_note', $count_note);
        });


        // if (Auth::check()) {
        //     view()->composer('admin.layouts.layout', function ($view) {
        //         if (Cache::has('message')) {
        //             $message = Cache::get('message');
        //         } else {
        //             $message = DB::table('message')->count();
        //             Cache::put('message', $message, 30);
        //         }
        //         $view->with('message', $message);
        //     });
        // }
    }
}
