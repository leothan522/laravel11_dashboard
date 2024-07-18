<?php

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

Route::get('/', function () {
    return view('dashboard.index');
})->name('dashboard');

Route::middleware([UserPermisos::class])->group(function (){

    Route::get('perfil', [UsuariosController::class, 'perfil'])->name('perfil');
    Route::get('parametros', [ParametrosController::class, 'index'])->name('parametros');
    Route::get('usuarios', [UsuariosController::class, 'index'])->name('usuarios');
    Route::get('usuarios/export/{buscar?}', [UsuariosController::class, 'export'])->name('usuarios.excel');

});

Route::middleware([UserAndroid::class])->group(function (){
    //rutas Dashboard para android
});
