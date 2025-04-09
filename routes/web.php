<?php

use App\Http\Controllers\BelajarController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserControlller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('belajar', [BelajarController::class, 'index']);
// Route::get('tambah', [BelajarController::class, 'tambah']);
// Route::get('kurang', [BelajarController::class, 'kurang']);
// Route::get('bagi', [BelajarController::class, 'bagi']);
// Route::get('kali', [BelajarController::class, 'kali']);
// Route::post('action-tambah', [BelajarController::class, 'actionTambah']);

// Login
Route::get('login', [LoginController::class, 'login']);
Route::post('action-login', [LoginController::class, 'actionLogin']);

// Dashboard
// get, post, put, delete
Route::resource('dashboard', DashboardController::class);

// Categories
Route::resource('categories', CategoriesController::class);

//Users
Route::resource('user', UserControlller::class);

// Products
Route::resource('products', ProductController::class);

// Transactions
Route::resource('pos', TransactionController::class);

//Get Product
Route::get('get-product/{id}', [TransactionController::class, 'getProduct']);
