<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IPController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\LotController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\TehsilController;
use App\Http\Controllers\UcController;

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



// for admin dashboard




Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth.redirect');
Route::post('/login/user', [ProfileController::class, 'customLogin'])->name('customLogin');
Route::get('/user/logout', [ProfileController::class, 'logout'])->name('user.logout');
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});



Route::get('/', function () {
    return view('dashboard.signin');
})->name('admin.sign');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/notfound', function () {
    return view('dashboard.form');
});


Route::prefix('admin/ip')->middleware('auth.redirect')->group(function () {
    Route::get('/create', [IPController::class, 'create'])->name('ip.create');
    Route::get('/list', [IPController::class, 'index'])->name('ip.list');
    Route::post('/signup', [IPController::class, 'ip_signup'])->name('ip_signup');
    Route::get('/delete/{id}', [IPController::class, 'delete'])->name('ip.delete');
    Route::get('/block/{id}', [IPController::class, 'block'])->name('ip.block');

});



// area managemnt
Route::prefix('admin/area')->middleware('auth.redirect')->group(function () {
    Route::get('/create', [AreaController::class, 'create'])->name('area.create');
    Route::post('/store', [AreaController::class, 'store'])->name('area.store');
    Route::get('/list', [AreaController::class, 'index'])->name('area.list');
    Route::get('/delete/{id}', [AreaController::class, 'delete'])->name('area.delete');
    Route::get('/edit/{id}', [AreaController::class, 'edit'])->name('area.edit');
    Route::post('/update/{id}', [AreaController::class, 'update'])->name('area.update');
});


// lot management
Route::prefix('admin/lot')->middleware('auth.redirect')->group(function () {
    Route::get('/create', [LotController::class, 'create'])->name('lot.create');
    Route::post('/store', [LotController::class, 'store'])->name('lot.store');
    Route::get('/list', [LotController::class, 'index'])->name('lot.list');
    Route::get('/delete/{id}', [LotController::class, 'delete'])->name('lot.delete');
    Route::get('/edit/{id}', [LotController::class, 'edit'])->name('lot.edit');
    Route::post('/update/{id}', [LotController::class, 'update'])->name('lot.update');
});
// district management
Route::prefix('admin/district')->middleware('auth.redirect')->group(function () {
    Route::get('/create', [DistrictController::class, 'create'])->name('district.create');
    Route::post('/store', [DistrictController::class, 'store'])->name('district.store');
    Route::get('/list', [DistrictController::class, 'index'])->name('district.list');
    Route::get('/delete/{id}', [DistrictController::class, 'delete'])->name('district.delete');
    Route::get('/edit/{id}', [DistrictController::class, 'edit'])->name('district.edit');
    Route::post('/update/{id}', [DistrictController::class, 'update'])->name('district.update');
});



// tehsil  management

Route::prefix('admin/tehsil')->middleware('auth.redirect')->group(function () {
    Route::get('/create', [TehsilController::class, 'create'])->name('tehsil.create');
    Route::post('/store', [TehsilController::class, 'store'])->name('tehsil.store');
    Route::get('/list', [TehsilController::class, 'index'])->name('tehsil.list');
    Route::get('/delete/{id}', [TehsilController::class, 'delete'])->name('tehsil.delete');
    Route::get('/edit/{id}', [TehsilController::class, 'edit'])->name('tehsil.edit');
    Route::post('/update/{id}', [TehsilController::class, 'update'])->name('tehsil.update');
});



// UC  management

Route::prefix('admin/uc')->middleware('auth.redirect')->group(function () {
    Route::get('/create', [UcController::class, 'create'])->name('uc.create');
    Route::post('/store', [UcController::class, 'store'])->name('uc.store');
    Route::get('/list', [UcController::class, 'index'])->name('uc.list');
    Route::get('/delete/{id}', [UcController::class, 'delete'])->name('uc.delete');
    Route::get('/edit/{id}', [UcController::class, 'edit'])->name('uc.edit');
    Route::post('/update/{id}', [UcController::class, 'update'])->name('uc.update');
});










Route::get('/filter/lot', [App\Http\Controllers\HomeController::class, 'filter_lot'])->name('filter_lot');
Route::get('/filter/districts', [App\Http\Controllers\HomeController::class, 'filter_districts'])->name('filter_districts');
Route::get('/filter/tehsil', [App\Http\Controllers\HomeController::class, 'filter_tehsil'])->name('filter_tehsil');
Route::get('/filter/uc', [App\Http\Controllers\HomeController::class, 'filter_uc'])->name('filter_uc');
