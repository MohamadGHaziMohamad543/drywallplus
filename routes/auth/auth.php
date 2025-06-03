<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;

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
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.page');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', function () {
    Auth::logout();
    return redirect('en/login');
})->name('logout');
});