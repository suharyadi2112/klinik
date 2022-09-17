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

	//permission
	Route::post('/permission/roles/', [ManagePermissions::class, 'ShowModalPermission'])->name('ShowModalPermission');
	Route::post('/permission/update/', [ManagePermissions::class, 'UpdatePermission'])->name('UpdatePermission');

	//users
	Route::get('/users', [RegisterController::class, 'ShowUsers'])->name('ShowDashboardUsers');
	Route::get('/getlist/users', [RegisterController::class, 'ShowUsers'])->name('GetListUsers');
	Route::post('/post/users', [RegisterController::class, 'PostUsers'])->name('PostUsers');
	Route::post('/del/users', [RegisterController::class, 'DeleteUser'])->name('DeleteUser');
	Route::post('/modaledit/users', [RegisterController::class, 'ModalEdit'])->name('ModalEdit');
	Route::post('/update/users', [RegisterController::class, 'UpdateUsers'])->name('UpdateUsers');
	Route::post('/statuschange/users', [RegisterController::class, 'StatusChange'])->name('StatusChange');
	Route::post('/reset/pass/users', [RegisterController::class, 'ResetPass'])->name('ResetPass');
	

	//category
	Route::get('/category', [ManageCategory::class, 'ShowCategory'])->name('ShowCategory');
	Route::post('/category/store', [ManageCategory::class, 'StoreCategory'])->name('StoreCategory');
	Route::delete('/category/delelete/{id}', [ManageCategory::class, 'DelCategory'])->name('DelCategory');
	Route::post('/category/put/{id}', [ManageCategory::class, 'PutCategory'])->name('PutCategory');

    //category_action
	Route::get('/category_action', [ManageCategory::class, 'ShowCategoryAction'])->name('ShowCategoryAction');
	Route::post('/category_action/post', [ManageCategory::class, 'PostCa'])->name('PostCa');
	Route::delete('/category_action/delete/{id}', [ManageCategory::class, 'DelCa'])->name('DelCa');
	Route::post('/category_action/modaledit', [ManageCategory::class, 'ModalEditCa'])->name('ModalEditCa');
	Route::post('/category_action/update', [ManageCategory::class, 'UpdateCa'])->name('UpdateCa');

	//action
	Route::get('/action', [ManageCategory::class, 'ShowAction'])->name('ShowAction');

	//permission
	Route::get('/users/permission', [ManagePermissions::class, 'GetPermission'])->name('GetPermission');
});

// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap'])->name('language');

//route global bawaan laravel
Auth::routes(['verify' => true,'register' => false]);