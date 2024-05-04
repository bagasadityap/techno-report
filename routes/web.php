<?php

use App\Http\Controllers\RecapReportController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResponseController;
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

// Route::get('/nyoba', function () {
//     return view('group.add');
// });

Route::controller(AuthController::class)->group(function() {
    Route::get('/', 'index')->name('index');
    Route::post('/login', 'login')->name('login');
});

Route::middleware([Authenticate::class])->group(function () {
    Route::group(['middleware' => ['can:dashboard']], function () { 
        Route::controller(MainController::class)->group(function() {
            Route::get('/dashboard', 'index')->name('dashboard');
        });
     });
    
    Route::controller(AuthController::class)->group(function() {
        Route::get('/logout', 'logout')->name('logout');
    });
    
    Route::group(['middleware' => ['can:user']], function () { 
        Route::controller(AdminController::class)->prefix('/administrator')->group(function () {
            Route::get('/','index')->name('admin');
            Route::get('/add','add')->name('admin.add');
            Route::post('/store','store')->name('admin.store');
            Route::get('/detail/{id}','detail')->name('admin.detail');
            Route::get('/update/{id}','update')->name('admin.update');
            Route::post('/update-store/{id}','update_store')->name('admin.update');
            Route::get('/delete/{id}','delete')->name('admin.delete');
        });
    });
    
    Route::group(['middleware' => ['can:pelaporan']], function () { 
        Route::controller(ReportController::class)->prefix('/report')->group(function () {
            Route::get('/','index')->name('report');
            Route::get('/add','add')->name('report.add');
            Route::post('/store','store')->name('report.store');
            Route::get('/detail/{id}','detail')->name('report.detail');
            Route::get('/update/{id}','update')->name('report.update');
            Route::post('/update-store/{id}','update_store')->name('report.update');
            Route::get('/delete/{id}','delete')->name('report.delete');
            Route::controller(ResponseController::class)->prefix('/response/{id}')->group(function () {
                Route::get('/','index')->name('response');
                Route::post('/store','store')->name('response.store');
                Route::post('/update/{id2}','update')->name('response.update');
                Route::get('/delete/{id2}','delete')->name('response.delete');
            });
        });
    });
    
    Route::group(['middleware' => ['can:rekap laporan']], function () { 
        Route::controller(RecapReportController::class)->prefix('/rekap-laporan')->group(function () {
            Route::get('/','index')->name('recap_report');
            Route::get('/download','download')->name('recap_report.download');
        });
    });
    
    Route::group(['middleware' => ['can:group user']], function () { 
        Route::controller(GroupUserController::class)->prefix('/group-user')->group(function () {
            Route::get('/','index')->name('group-user');
            Route::get('/add','add')->name('group-user.add');
            Route::post('/store','store')->name('group-user.store');
            Route::get('/detail/{id}','detail')->name('group-user.detail');
            Route::get('/update/{id}','update')->name('group-user.update');
            Route::post('/update-store/{id}','update_store')->name('group-user.update');
            Route::get('/delete/{id}','delete')->name('group-user.delete');
            Route::post('/edit/{id}','edit')->name('group-user.edit');
        });
    });
    
    Route::group(['middleware' => ['can:data master']], function () { 
        Route::controller(DataMasterController::class)->group(function () {
        Route::group(['middleware' => ['can:kategori']], function () {
            Route::get('/category','category')->name('category');
            Route::post('/category/add','add_category')->name('category.add');
            Route::post('/category/update/{id}','update_category')->name('category.update');
            Route::get('/category/delete/{id}','delete_category')->name('category.delete');
        });

        Route::group(['middleware' => ['can:status']], function () {
            Route::get('/status','status')->name('status');
            Route::post('/status/add','add_status')->name('status.add');
            Route::post('/status/update/{id}','update_status')->name('status.update');
            Route::get('/status/delete/{id}','delete_status')->name('status.delete');
        });

        Route::group(['middleware' => ['can:kewenangan']], function () {
            Route::get('/authority','authority')->name('authority');
            Route::post('/authority/add','add_authority')->name('authority.add');
            Route::post('/authority/update/{id}','update_authority')->name('authority.update');
            Route::get('/authority/delete/{id}','delete_authority')->name('authority.delete');
        });

        Route::group(['middleware' => ['can:region']], function () {
            Route::get('/region','region')->name('region');
            Route::post('/region/add','add_region')->name('region.add');
            Route::post('/region/update/{id}','update_region')->name('region.update');
            Route::get('/region/delete/{id}','delete_region')->name('region.delete');
        });
        });
    });
});



// Auth::routes();

