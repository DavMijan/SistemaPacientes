<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

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
        Schema::defaultStringLength(191);
        //
        Gate::define('supers', function () {
            if(Auth::user()->hasRole('superadmin')){
               return true;
           }
           return false;
       });
        Gate::define('admins', function () {
            if(Auth::user()->hasRole('admin')){
               return true;
           }
           return false;
       });
       Gate::define('standard', function () {
          if(Auth::user()->hasRole('digitador')){
               return true;
           }
           return false;
       });
    }
}
