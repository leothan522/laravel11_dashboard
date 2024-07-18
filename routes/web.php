<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('web.index');

Route::middleware('auth')
    ->get('/perfil', function (){
    return view('profile.show_default');
})->name('web.perfil');
