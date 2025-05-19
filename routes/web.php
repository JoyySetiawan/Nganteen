<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\DashboardUserController;

Route::get('/dashboardUser', [DashboardUserController::class, 'index'])->name('dashboardUser');


Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');

Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register/action', [RegisterController::class, 'actionregister'])->name('actionregister');

Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('listProduk', [produkController::class, 'index'])->name('produk');
Route::get('createProduk', [produkController::class, 'create'])->name('createProduk');
Route::post('storeProduk', [produkController::class, 'store'])->name('storeProduk');

