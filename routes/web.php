<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GroupUserController;
use App\Http\Controllers\DataMasterController;
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

Route::get('/nyoba', function () {
    return view('group.add');
});

Route::controller(AuthController::class)->group(function() {
    Route::get('/', 'index')->name('index');
    Route::post('/login', 'login')->name('login');
    Route::get('/logout', 'logout')->name('logout');
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
    Route::post('/update-store/{id}','update_store')->name('admin.update');
    Route::get('/delete/{id}','delete')->name('admin.delete');
});

Route::controller(GroupUserController::class)->prefix('/group-user')->group(function () {
    Route::get('/','index')->name('group-user');
    Route::get('/add','add')->name('group-user.add');
    Route::post('/store','store')->name('group-user.store');
    Route::get('/detail/{id}','detail')->name('group-user.detail');
    Route::get('/update/{id}','update')->name('group-user.update');
    Route::post('/update-store/{id}','update_store')->name('group-user.update');
    Route::get('/delete/{id}','delete')->name('group-user.delete');
});

Route::controller(DataMasterController::class)->group(function () {
    Route::get('/category','category')->name('category');
    Route::post('/category/add','add_category')->name('category.add');
    Route::get('/status','status')->name('status');
    Route::get('/authority','authority')->name('authority');
    Route::get('/region','region')->name('region');
});

Auth::routes();

