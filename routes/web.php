<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('categories.index');
});

Route::resource('/categories', CategoryController::class)->only(['index']);

Route::resource('auth', AuthController::class)->only(['create', 'store']);
Route::get('/login', fn() => to_route('auth.create'))->name('login');

Route::delete('logout', fn() => to_route('auth.create'))->name('logout');
Route::delete('auth', [AuthController::class, 'destroy'])->name('auth.destroy');


Route::get('categories/{slug}', [CategoryController::class, 'show'])->name('category-show');

// admin 
Route::middleware('auth')->group(function(){
    Route::resource('/admin',AdminController::class)->only(['index']);
    Route::resource('/admin/kategoriler',AdminCategoryController::class);
    Route::put('admin/kategoriler/{kategoriler}/change-image',[AdminCategoryController::class,'changeImage'])->name('change.category.image');
    Route::resource('/admin/urunler',AdminProductController::class);
    Route::put('admin/urunler/{kategoriler}/change-image',[AdminProductController::class,'changeImage'])->name('change.product.image');

    Route::put('/admin/urunler/toggle/{id}', [AdminProductController::class, 'toggle'])->name('admin.urunler.toggle');
    
});
