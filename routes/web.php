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

Route::get('/dashboard', [DashboardController::class, 'dashborad'])->name('dashborad');


Route::get('/admin/product', [ProductController::class, 'products'])->name('products');
Route::get('/admin/product/create',[ProductController::class,'productCreate'])->name('create.product');
Route::post('/admin/product/insert',[ProductController::class,'productInsert'])->name('insert.product');
Route::get('/admin/product/edit/{id}', [ProductController::class, 'productEdit'])->name('edit.product');
Route::post('/admin/product/update/{id}', [ProductController::class, 'productUpdate'])->name('update.product');
Route::get('/admin/product/destroy/{id}',[ProductController::class,'productDestroy'])->name('destroy.product');
//Csv Import 
Route::post('/import', [ProductController::class,'import'])->name('import');


Route::get('/setting', [SettingController::class, 'setting'])->name('setting');
Route::get('/admin/setting', [SettingController::class, 'setting'])->name('settings');
Route::get('/admin/setting/create',[SettingController::class,'settingCreate'])->name('create.setting');
Route::post('/admin/setting/insert',[SettingController::class,'settingInsert'])->name('insert.setting');
Route::get('/admin/setting/edit/{id}', [SettingController::class, 'settingEdit'])->name('edit.setting');
Route::post('/admin/setting/update/{id}', [SettingController::class, 'settingUpdate'])->name('update.setting');
Route::get('/admin/setting/destroy/{id}',[SettingController::class,'settingDestroy'])->name('destroy.setting');
