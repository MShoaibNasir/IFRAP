<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IPController;
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
});
