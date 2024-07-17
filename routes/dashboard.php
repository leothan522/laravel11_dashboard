<?php

use App\Http\Controllers\Dashboard\ParametrosController;
use App\Http\Middleware\UserAndroid;
use App\Http\Middleware\UserPermisos;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware([UserPermisos::class])->group(function (){

    Route::get('perfil', function () {
        return view('dashboard');
    })->name('prueba');

    Route::get('parametros', [ParametrosController::class, 'index'])->name('parametros');

});

Route::middleware([UserAndroid::class])->group(function (){
    //rutas Dashboard para android
});
