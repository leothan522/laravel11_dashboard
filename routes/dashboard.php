<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\FcmController;
use App\Http\Controllers\Dashboard\ParametrosController;
use App\Http\Controllers\Dashboard\UsuariosController;
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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware([UserPermisos::class])->group(function (){

    Route::get('fcm', [FcmController::class, 'index'])->name('fcm');
    Route::get('perfil', [UsuariosController::class, 'perfil'])->name('perfil');
    Route::get('parametros', [ParametrosController::class, 'index'])->name('parametros');
    Route::get('usuarios', [UsuariosController::class, 'index'])->name('usuarios');
    Route::get('usuarios/export/{buscar?}', [UsuariosController::class, 'export'])->name('usuarios.excel');

    Route::get('pdf/prueba', [DashboardController::class, 'pruebaGenerarPDF'])->name('pdf');

});

Route::middleware([UserAndroid::class])->group(function (){
    //rutas Dashboard para android
});
