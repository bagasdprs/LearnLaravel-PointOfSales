<?php


use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;


// Login
Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('action-login', [LoginController::class, 'actionLogin']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');


// Dashboard
// get, post, put, delete

Route::group(['middleware' => ['auth']], function () {
    Route::resource('dashboard', DashboardController::class);

    // Route::group(['middleware' => 'role:1'], function () {
    Route::resource('categories', CategoriesController::class);
    Route::resource('user', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('role', RoleController::class);
    Route::get('report', action: [TransactionController::class, 'report']);
    // });

    // Route::group(['middleware' => 'role:2'], function () {
    Route::get('get-product/{id}', action: [TransactionController::class, 'getProduct']);
    Route::get('print/{id}', action: [TransactionController::class, 'printStruk'])->name('print');
    // Route::get('products', ProductController::class);
    // Route::get('/report', [TransactionController::class, 'report'])->name('pimpinan.report');
    // });

    // Route::group(['middleware' => 'role:3'], function () {
    Route::get('kasir', action: [ProductController::class, 'searchProduct'])->name('kasir');    // });
    Route::post('kasir', action: [TransactionController::class, 'store'])->name('kasir.store');
});
