<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/login',[HomeController::class,'Login'])->name('login');
// Route::post('/loginstore',[HomeController::class,'LoginStore'])->name('loginstore');
Route::get('/logout',[HomeController::class,'Logout'])->name('logout');

Route::get('/dashborad', [DashboardController::class, 'dashborad'])->name('dashborad');


Route::get('/admin/product', [ProductController::class, 'products'])->name('products');
Route::get('/admin/product/create',[ProductController::class,'productCreate'])->name('create.product');
Route::post('/admin/product/insert',[ProductController::class,'productInsert'])->name('insert.product');
Route::get('/admin/product/edit/{id}', [ProductController::class, 'productEdit'])->name('edit.product');
Route::post('/admin/product/update/{id}', [ProductController::class, 'productUpdate'])->name('update.product');
Route::get('/admin/product/destroy/{id}',[ProductController::class,'productDestroy'])->name('destroy.product');

Route::get('/setting', [SettingController::class, 'setting'])->name('setting');
