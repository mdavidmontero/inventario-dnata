<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return  view('admin.dashboard');
})->name('dashboard');

Route::resource('categories', CategoryController::class)->except(['show']);
Route::resource('products', ProductController::class)->except(['show']);
Route::post('products/{product}/dropzone', [ProductController::class,  'dropzone'])->name('products.dropzone');
Route::resource('customers', CustomerController::class)->except(['show']);
Route::resource('suppliers', SupplierController::class)->except(['show']);
Route::delete('images/{image}', [ImageController::class, 'destroy'])->name('images.destroy');
