<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

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
        //Asset URL para Livewire 3
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/'.env('APP_URL_LIVEWIRE', 'laravel/public').'/livewire/update', $handle);
        });

        Livewire::setScriptRoute(function ($handle) {
            return Route::get(''.env('APP_URL_LIVEWIRE', 'laravel/public').'/livewire/livewire.js', $handle);
        });

        //Authorization Sidebar

        Gate::define('usuarios', function ($user){
            return comprobarPermisos('dashboard.usuarios');
        });

        Gate::define('parametros', function ($user){
            return $user->role == 100;
        });

        Gate::define('prueba', function () {
            return true;
        });

    }
}
