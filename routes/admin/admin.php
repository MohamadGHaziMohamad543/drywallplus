<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubSubCategoryController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\SliderController;
Route::group([
        'prefix' => '{lang}/admin',
    'where' => ['lang' => 'en|ar'],
    'middleware' => ['setLocale'],
], function () {
Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard.admin');
Route::resource('/categories', CategoryController::class);
Route::resource('/subcategories', SubCategoryController::class);
    Route::resource('subsubcategories', SubSubCategoryController::class);
        Route::resource('products', ProductController::class);
Route::resource('contact-us', ContactUsController::class);
Route::resource('abouts', AboutController::class);

    Route::resource('sliders', SliderController::class);
});