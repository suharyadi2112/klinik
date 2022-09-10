<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StarterKitController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Auth\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// dashboard Routes
Route::get('/', [StarterKitController::class, 'index'])->name('dashboard');
Route::get('/sk-layout-1-column', [StarterKitController::class, 'column_1Sk'])->name('1-column');
Route::get('/sk-layout-2-columns', [StarterKitController::class, 'columns_2Sk'])->name('2-columns');
Route::get('/fixed-navbar', [StarterKitController::class, 'fix_navbar'])->name('fixed-navbar');
Route::get('/sk-layout-fixed', [StarterKitController::class, 'fix_layout'])->name('fixed-layout');
Route::get('/sk-layout-static', [StarterKitController::class, 'static_layout'])->name('static-layout');

// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap'])->name('language');

//tes permission
Route::get('publish/{id}', [LanguageController::class, 'publish'])->name('post.publish');
Route::get('unpublish/{id}', [LanguageController::class, 'unpublish'])->name('post.unpublish');
Route::get('edit/{id}', [LanguageController::class, 'edit'])->name('post.edit');
Route::get('destroy/{id}', [LanguageController::class, 'destroy'])->name('post.destroy');

Auth::routes(['verify' => true]);