<?php

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
    return view('welcome');
});

Route::controller(\App\Http\Controllers\Auth\AuthController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
//    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'],function() {
    Route::get('/', [\App\Http\Controllers\Auth\AuthController::class, 'dashboard'])->name('dashboard');
    Route::resource('categories', \App\Http\Controllers\CategoryController::class)->except('show');
    Route::resource('positions', \App\Http\Controllers\PositionController::class)->except('show');
    Route::resource('employees', \App\Http\Controllers\EmployeeController::class)->except('show');
    Route::resource('drivers', \App\Http\Controllers\DriverController::class)->except('show');
    Route::resource('cars', \App\Http\Controllers\CarController::class)->except('show');
    Route::resource('trips', \App\Http\Controllers\TripController::class)->except('show');
    Route::get('trips/available-cars', [\App\Http\Controllers\TripController::class, 'availableCars'])->name('trips.available-cars');
});
