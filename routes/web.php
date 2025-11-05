<?php

use Illuminate\Support\Facades\Route;

//use App\Http\Controllers\CategoryController;


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

//Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'login_form'])->name('login');
Route::middleware(['web'])->group(function () {
    Route::prefix('user')->group(function () {
        Auth::routes();
    });
});


Route::middleware(['auth'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    });
});

Route::resource('categories', App\Http\Controllers\CategoryController::class);//->name('index','categories');
