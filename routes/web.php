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

        // not use resource
//        Route::get('/categories/index', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
//
//        Route::get('/categories/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');
//        Route::post('/categories/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
//
//        Route::get('/categories/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
//        Route::put('/categories/update/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
//
//        Route::delete('/categories/destroy/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');
//
//
//        Route::get('/categories/show/{id}', [App\Http\Controllers\CategoryController::class, 'show'])->name('categories.show');

        //use resource
        Route::resource('categories', App\Http\Controllers\CategoryController::class)->name('index','categories.index');
    });
});




