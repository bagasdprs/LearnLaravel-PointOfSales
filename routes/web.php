<?php

use App\Http\Controllers\BelajarController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserControlller;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



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
Route::resource('role', RoleController::class);

// Transactions
Route::resource('kasir', TransactionController::class);

//Get Product
Route::get('get-product/{id}', [TransactionController::class, 'getProduct']);

//Print Struk
Route::get('print/{id}', [TransactionController::class, 'printStruk'])->name('print');
