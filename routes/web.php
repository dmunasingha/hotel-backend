<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

// Main Page Route
Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'admin'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('userlogout');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
});


Route::group(['middleware' => 'guest', 'prefix' => 'admin'], function () {
    // authentication
    Auth::routes();
});
