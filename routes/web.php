<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatckController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group([
    'prefix' => '{lang}',
    'where' => ['lang' => 'en|ar'],
    'middleware' => ['setLocale'], 
], function () {
Route::get('/', [StatckController::class,'index'])->name('home.page');
Route::get('/category+', function () {
    return view('website.shop.index');
})->name('category.page');

Route::get('/product', function () {
    return view('website.shop.show');
})->name('product.page');

Route::get('/faq', function () {
    return view('website.faq.index');
})->name('faq.page');
Route::get('/catalog', function () {
    return view('website.catalog.index');
})->name('catalog.page');

Route::get('/contact', function () {
    return view('website.contact.index');
})->name('contact.page');

Route::get('/login', function () {
    return view('website.auth.index');
})->name('login.page');

 });
 require __DIR__.'/auth/auth.php';
 require __DIR__.'/admin/admin.php';