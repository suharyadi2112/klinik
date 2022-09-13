<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StarterKitController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Auth\UserController;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ManageRoles\ManageRoles;
use App\Http\Controllers\Auth\ManageRoles\ManagePermissions;
use App\Http\Controllers\ManageCategory\ManageCategory;

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

/*
|--------------------------------------------------------------------------
| route template bawaan
|--------------------------------------------------------------------------
*/
Route::get('/sk-layout-1-column', [StarterKitController::class, 'column_1Sk'])->name('1-column');
Route::get('/sk-layout-2-columns', [StarterKitController::class, 'columns_2Sk'])->name('2-columns');
Route::get('/fixed-navbar', [StarterKitController::class, 'fix_navbar'])->name('fixed-navbar');
Route::get('/sk-layout-fixed', [StarterKitController::class, 'fix_layout'])->name('fixed-layout');
Route::get('/sk-layout-static', [StarterKitController::class, 'static_layout'])->name('static-layout');
/*
|--------------------------------------------------------------------------
*/


// dashboard Routes

Route::get('/', [StarterKitController::class, 'index'])->name('dashboard')->middleware('auth');

// users Routes dengan spatie role and permission
Route::group(['middleware' => ['role:super-admin|admin']], function () {//akses untuk super-admin dan admin
	//role
	Route::get('/users/roles', [ManageRoles::class, 'ShowRolesUsers'])->name('ShowRolesUsers');
	Route::post('/users/store/roles', [ManageRoles::class, 'StoreRoles'])->name('StoreRoles');
	Route::delete('/users/del/roles/{id}', [ManageRoles::class, 'DelRoles'])->name('DelRoles');
	Route::post('/users/put/roles/{id}', [ManageRoles::class, 'PutRoles'])->name('PutRoles');

	//category
	Route::get('/category', [ManageCategory::class, 'ShowCategory'])->name('ShowCategory');
	Route::post('/category/store', [ManageCategory::class, 'StoreCategory'])->name('StoreCategory');
	Route::delete('/category/delelete/{id}', [ManageRoles::class, 'DelCategory'])->name('DelCategory');
	Route::post('/category/put/{id}', [ManageRoles::class, 'PutCategory'])->name('PutCategory');

	//permission
	Route::get('/users/permission', [ManagePermissions::class, 'GetPermission'])->name('GetPermission');
});

// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap'])->name('language');

//route global bawaan laravel
Auth::routes(['verify' => true]);