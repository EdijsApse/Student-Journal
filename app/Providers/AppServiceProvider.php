<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Students;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view){//Sharing students across views 
            $students = Students::orderBy('name','asc')->get();
            $view->with('all_students', $students);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
