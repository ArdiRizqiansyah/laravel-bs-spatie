<?php

use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('home');

Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.post');
Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// admin
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['role:admin'],
], function(){
    // users
    Route::resource('user', AdminUserController::class);
});