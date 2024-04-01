<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\Authenticate;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(AuthController::class)->group(function() {
    Route::get('/', 'index')->name('index');
    Route::post('/login', 'login')->name('login');
});

Route::middleware([Authenticate::class])->group(function () {
    Route::controller(MainController::class)->group(function() {
        Route::get('/dashboard', 'index')->name('dashboard');
    })->middleware(Authenticate::class);
});

Route::controller(RoleController::class)->group(function () {
    Route::get('/roles','index');
});

Route::controller(AdminController::class)->prefix('/administrator')->group(function () {
    Route::get('/','index')->name('admin');
    Route::get('/add','add')->name('admin.add');
    Route::post('/store','store')->name('admin.store');
    Route::get('/detail/{id}','detail')->name('admin.detail');
    Route::get('/update/{id}','update')->name('admin.update');
    Route::get('/delete/{id}','delete')->name('admin.delete');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
