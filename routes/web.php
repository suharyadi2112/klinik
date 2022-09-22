<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StarterKitController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Auth\UserController;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ManageRoles\ManageRoles;
use App\Http\Controllers\Auth\ManageRoles\ManagePermissions;
use App\Http\Controllers\ManageCategory\ManageCategory;
use App\Http\Controllers\Transaction\ManageTransaction;
use App\Http\Controllers\Transaction\ProcessTransaction;
use App\Http\Controllers\ManagePasienBilling\ManagePasienBilling;
use App\Http\Controllers\ManagePartnerCategory\ManagePartnerCategory;
use App\Http\Controllers\ManagePartner\ManagePartner;
use App\Http\Controllers\ManagePasien\ManagePasien;

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
Route::group(['middleware' => ['web']], function () {//akses untuk super-admin dan admin
	//role
	Route::get('/users/roles', [ManageRoles::class, 'ShowRolesUsers'])->name('ShowRolesUsers');
	Route::post('/users/store/roles', [ManageRoles::class, 'StoreRoles'])->name('StoreRoles')->middleware(['can:create roles']);
	Route::delete('/users/del/roles/{id}', [ManageRoles::class, 'DelRoles'])->name('DelRoles')->middleware(['can:delete roles']);
	// Route::post('/users/put/roles/{id}', [ManageRoles::class, 'PutRoles'])->name('PutRoles')->middleware(['can:delete roles']);

	//permission
	Route::post('/permission/roles/', [ManagePermissions::class, 'ShowModalPermission'])->name('ShowModalPermission')->middleware(['can:view permission']);
	Route::post('/permission/update/', [ManagePermissions::class, 'UpdatePermission'])->name('UpdatePermission')->middleware(['can:update permission']);

	//users
	Route::get('/users', [RegisterController::class, 'ShowUsers'])->name('ShowDashboardUsers');
	Route::get('/getlist/users', [RegisterController::class, 'ShowUsers'])->name('GetListUsers')->middleware(['can:view users']);
	Route::post('/post/users', [RegisterController::class, 'PostUsers'])->name('PostUsers')->middleware(['can:create users']);
	Route::post('/del/users', [RegisterController::class, 'DeleteUser'])->name('DeleteUser')->middleware(['can:delete users']);
	Route::post('/modaledit/users', [RegisterController::class, 'ModalEdit'])->name('ModalEdit')->middleware(['can:edit users']);
	Route::post('/update/users', [RegisterController::class, 'UpdateUsers'])->name('UpdateUsers')->middleware(['can:edit users']);
	Route::post('/statuschange/users', [RegisterController::class, 'StatusChange'])->name('StatusChange')->middleware(['can:change_status users']);
	Route::post('/reset/pass/users', [RegisterController::class, 'ResetPass'])->name('ResetPass')->middleware(['can:reset users']);
	Route::post('/changepass/users', [RegisterController::class, 'ChangePass'])->name('ChangePass')->middleware(['can:change_pass users']);
	Route::get('/users/log', [RegisterController::class, 'Log'])->name('Log');
	

	//category
	Route::get('/category', [ManageCategory::class, 'ShowCategory'])->name('ShowCategory');
	Route::post('/category/store', [ManageCategory::class, 'StoreCategory'])->name('StoreCategory')->middleware(['can:create cat']);
	Route::delete('/category/delelete/{id}', [ManageCategory::class, 'DelCategory'])->name('DelCategory')->middleware(['can:delete cat']);
	Route::post('/category/put/{id}', [ManageCategory::class, 'PutCategory'])->name('PutCategory')->middleware(['can:edit cat']);

    //category_action
	Route::get('/category_action', [ManageCategory::class, 'ShowCategoryAction'])->name('ShowCategoryAction');
	Route::post('/category_action/post', [ManageCategory::class, 'PostCa'])->name('PostCa')->middleware(['can:create cataction']);
	Route::delete('/category_action/delete/{id}', [ManageCategory::class, 'DelCa'])->name('DelCa')->middleware(['can:delete cataction']);
	Route::post('/category_action/modaledit', [ManageCategory::class, 'ModalEditCa'])->name('ModalEditCa')->middleware(['can:edit cataction']);
	Route::post('/category_action/update', [ManageCategory::class, 'UpdateCa'])->name('UpdateCa')->middleware(['can:edit cataction']);

	//action
	Route::get('/action', [ManageCategory::class, 'ShowAction'])->name('ShowAction');
	Route::post('/action/post', [ManageCategory::class, 'PostC'])->name('PostC');
	Route::delete('/action/delete/{id}', [ManageCategory::class, 'DelC'])->name('DelC');
	Route::post('/action/modaledit', [ManageCategory::class, 'ModalEditC'])->name('ModalEditC');
	Route::post('/action/update', [ManageCategory::class, 'UpdateC'])->name('UpdateC');

	//permission
	Route::get('/users/permission', [ManagePermissions::class, 'GetPermission'])->name('GetPermission');

	//transaction
	Route::get('/transaction/registration', [ManageTransaction::class, 'index'])->name('IndexRegistration');
	Route::get('/add/registration', [ManageTransaction::class, 'AddRegistration'])->name('AddRegistration');
	Route::get('/add/registrationwithaction', [ManageTransaction::class, 'AddRegistrationWithAction'])->name('AddRegistrationWithAction');
	Route::get('/get/basic/{idpen}', [ManageTransaction::class, 'GetBasicRegistration'])->name('GetBasicRegistration');
	Route::post('/modal/patient', [ManageTransaction::class, 'ShowModalPatient'])->name('ShowModalPatient');
	Route::get('/modal/getlistpatient', [ManageTransaction::class, 'GetListPatient'])->name('GetListPatient');
	Route::post('/modal/partner', [ManageTransaction::class, 'ShowModalPartner'])->name('ShowModalPartner');
	Route::get('/modal/getlistpartner', [ManageTransaction::class, 'GetListPartner'])->name('GetListPartner');
	Route::get('/list/typeofbilling', [ManageTransaction::class, 'ListTypeOfBilling'])->name('ListTypeOfBilling');
	Route::post('/insert/registration', [ProcessTransaction::class, 'InsertRegistration'])->name('InsertRegistration');
	Route::post('/insert/registration/lead', [ProcessTransaction::class, 'InsertRegistrationLead'])->name('InsertRegistrationLead');
	Route::get('/action/registration/{id_registration}', [ManageTransaction::class, 'RegistrationAction'])->name('RegistrationAction');
	Route::post('/insert/action/registration', [ProcessTransaction::class, 'InsertRegistrationAction'])->name('InsertRegistrationAction');
	Route::post('/insert/action/registration/lead', [ProcessTransaction::class, 'InsertRegistrationActionLeads'])->name('InsertRegistrationActionLeads');
	Route::post('/modal/action/code', [ManageTransaction::class, 'ShowModalActionCode'])->name('ShowModalActionCode');
	Route::get('/list/action/code', [ManageTransaction::class, 'GetListActionCode'])->name('GetListActionCode');
	Route::get('/list/action/code/{id}', [ManageTransaction::class, 'GetListActionCodeV2'])->name('GetListActionCodeV2');
	Route::get('/get/tindakan/keluar/{id_registration}', [ManageTransaction::class, 'TableTindakanKeluar'])->name('TableTindakanKeluar');
	Route::get('/get/tindakan/keluar/v2/{id_registration}', [ManageTransaction::class, 'TableTindakanKeluarV2'])->name('TableTindakanKeluarV2');
	Route::post('/delete/tindakan/action', [ProcessTransaction::class, 'DelTindakanKeluar'])->name('DelTindakanKeluar');

	Route::post('/insert/finish/regisaction', [ProcessTransaction::class, 'InsertRegisActionFinish'])->name('InsertRegisActionFinish');
	

	//billng type
	Route::get('/pasien/billing', [ManagePasienBilling::class, 'ShowBillingType'])->name('ShowBillingType');
	Route::post('/pasien/billing/store', [ManagePasienBilling::class, 'StoreBilling'])->name('StoreBilling');
	Route::delete('/pasien/billing/delete/{id}', [ManagePasienBilling::class, 'DelBilling'])->name('DelBilling');
	Route::post('/pasien/billing/update/{id}', [ManagePasienBilling::class, 'UpdateBilling'])->name('UpdateBilling');

	//partner Categoy
	Route::get('/partner/category', [ManagePartnerCategory::class, 'ShowPartnerCategory'])->name('ShowPartnerCategory');
	Route::post('/partner/category/store', [ManagePartnerCategory::class, 'StorePC'])->name('StorePC');
	Route::post('/partner/category/update/{id}', [ManagePartnerCategory::class, 'UpdatePC'])->name('UpdatePC');
	Route::delete('/partner/category/delete/{id}', [ManagePartnerCategory::class, 'DelPC'])->name('DelPC');

	//partner
	Route::get('/partner', [ManagePartner::class, 'ShowPartner'])->name('ShowPartner');
	Route::get('/partner/add', [ManagePartner::class, 'AddPartner'])->name('AddPartner');
	Route::post('/partner/registrasi', [ManagePartner::class, 'InsertPartner'])->name('InsertPartner');
	Route::delete('/partner/delete/{id}', [ManagePartner::class, 'delPA'])->name('delPA');
	Route::get('/partner/update/{id}', [ManagePartner::class, 'PatnerEdit'])->name('PatnerEdit');
	Route::post('/partner/put', [ManagePartner::class, 'UpdatePartner'])->name('UpdatePartner');


	//pasien
	Route::get('/patient', [ManagePasien::class, 'ShowPatient'])->name('ShowPatient');
	Route::delete('/patient/delete/{id}', [ManagePasien::class, 'delPatient'])->name('delPatient');
	Route::get('/patient/registration', [ManagePasien::class, 'AddPatient'])->name('AddPatient');
	Route::post('/patient/create', [ManagePasien::class, 'InsertPatient'])->name('InsertPatient');
	Route::get('/patient/update/{id}', [ManagePasien::class, 'PatientEdit'])->name('PatientEdit');
	Route::post('/patient/put', [ManagePasien::class, 'UpdatePatient'])->name('UpdatePatient');

});

// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap'])->name('language');

//route global bawaan laravel
Auth::routes(['verify' => true,'register' => false]);