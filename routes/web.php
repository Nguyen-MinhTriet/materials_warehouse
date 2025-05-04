<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;



Route::redirect("/", 'login');

Route::view('login', 'auth.login')->name('login');
Route::post('login', [AuthController::class, 'processLogin'])->name('process_login');

Route::view('register', 'auth.register')->name('register');
Route::post('register', [AuthController::class, 'processRegister'])->name('process_register');

Route::resource('users', AuthController::class)->except([
    'show',
]);


Route::get('/layout', function () {
    return view('layout_admin.master');
});

route::get('test', function () {
    return view('kho.master');
});