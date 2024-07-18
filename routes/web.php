<?php

use App\Http\Controllers\Chat\ChatController;
use App\Http\Middleware\UserAndroid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('web.index');

Route::middleware('auth')
    ->get('/perfil', function (){
    return view('profile.show_default');
})->name('web.perfil');

Route::middleware([UserAndroid::class])->group(function (){
    //rutas Web para android
    Route::get('chat-directo/{id?}', [ChatController::class, 'index'])->name('chat.directo');
});
