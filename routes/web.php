<?php

use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\auth\LoginController;
use App\Http\Controllers\backend\BackupDatabaseController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\ContactController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\FlightController;
use App\Http\Controllers\backend\HoteLController;
use App\Http\Controllers\backend\HotelController as BackendHotelController;
use App\Http\Controllers\backend\PackageController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\backend\SystemAdminController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\frontend\auth\LoginController as AuthLoginController;
use App\Http\Controllers\frontend\auth\RegistrationController;
use App\Http\Controllers\frontend\FlightController as FrontendFlightController;
use App\Http\Controllers\frontend\ForgetPasswordController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\HotelController as FrontendHotelController;
use App\Http\Controllers\frontend\PackageController as FrontendPackageController;
use App\Http\Controllers\frontend\UserController as FrontendUserController;
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

Route::prefix('')->group(function () {
    Route::get('/', [HomeController::class, 'homepage'])->name('homepage');
    /*contact routs*/
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    Route::post('/contact', [HomeController::class, 'contact_post'])->name('contact_post');
    /*package routs*/
    Route::get('/package', [FrontendPackageController::class, 'package'])->name('package');
    Route::get('/detail/{id}', [FrontendPackageController::class, 'detail'])->name('detail');
    /*flight routs*/
    Route::get('/flight', [FrontendFlightController::class, 'flightPage'])->name('flight');
    Route::post('/flight', [FrontendFlightController::class, 'flightsearch'])->name('flightSearch');
    /*hotel routs*/
    Route::get('hotel', [FrontendHotelController::class, 'hotelPage'])->name('hotel');
    Route::post('/hotel', [FrontendHotelController::class, 'hotelsearch'])->name('hotelSearch');
    Route::get('/hotel/{id}', [FrontendHotelController::class, 'detail'])->name('hotelDetail');

    /*registration route*/
    Route::post('registration', [RegistrationController::class, 'registration'])->name('registration');

    /*login route*/
    Route::post('login', [AuthLoginController::class, 'login'])->name('login');
    Route::get('logout', [AuthLoginController::class, 'logout'])->name('logout');

    /* Socialite Login Routes */
    Route::group(['as' => 'login', 'prefix' => 'login'], function () {
        Route::get('/{provider}', [RegistrationController::class, 'redirectToProvider'])->name('provider');
        Route::get('/{provider}/callback', [RegistrationController::class, 'handleProviderCallback'])->name('provider.callback');
    });

    /*user route*/
    Route::get('profile', [FrontendUserController::class, 'profilepage'])->name('profilepage');
    Route::put('profile', [FrontendUserController::class, 'changeImage'])->name('changeImage');
    Route::put('edit-profile', [FrontendUserController::class, 'editProfile'])->name('editProfile');
    Route::get('change-password', [FrontendUserController::class, 'changePasswordPage'])->name('changePasswordPage');
    Route::put('change-password', [FrontendUserController::class, 'changePassword'])->name('changePassword');

    /*Ajax route */
    Route::get('/get-to-data', [FrontendFlightController::class, 'getToData']);

    /*forget password route*/
    Route::get('forget-password',[ForgetPasswordController::class,'forgetPasswordPage'])->name('forgetPasswordPage');
    Route::post('forget-password',[ForgetPasswordController::class,'forgetPassword'])->name('forgetPassword');

    /*reset password*/
    Route::get('reset-password/{token}',[ForgetPasswordController::class,'resetPasswordPage'])->name('resetPasswordPage');
    Route::post('reset-password/{token}',[ForgetPasswordController::class,'resetPassword'])->name('resetPassword');
});


/*backend routes */
Route::prefix('admin')->group(function () {

    /*login route */
    Route::get('login', [LoginController::class, 'loginPage'])->name('admin.loginPage');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login');
    Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');

    /*change password route */
    Route::get('change-password', [AdminController::class, 'changePasswordPage'])->name('admin.changePasswordPage');
    Route::post('change-password', [AdminController::class, 'changePassword'])->name('admin.changePassword');

    /*admin profile route*/
    Route::get('my-profile', [AdminController::class, 'profilePage'])->name('admin.profilePage');
    Route::put('change-image', [AdminController::class, 'changeImage'])->name('admin.changeImage');
    Route::get('edit-profile', [AdminController::class, 'editProfilePage'])->name('admin.editProfilePage');
    Route::put('edit-profile', [AdminController::class, 'editProfile'])->name('admin.editProfile');

    /*dashboard route */
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    /*resource controller */
    Route::resource('role', RoleController::class);
    Route::resource('system/admin', SystemAdminController::class);
    Route::resource('backup', BackupDatabaseController::class);
    Route::resource('slider', SliderController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('package', PackageController::class);
    Route::resource('contact', ContactController::class)->only(['index', 'destroy']);
    Route::resource('flight', FlightController::class);
    Route::resource('hotel', HoteLController::class);
    Route::resource('user', UserController::class)->only(['index']);

    /*Ajax call */
    Route::get('check/is_active/{id}', [SystemAdminController::class, 'changeStatus'])->name('admin.active.ajax');
    Route::get('slider/is_active/{id}', [SliderController::class, 'changeStatus'])->name('admin.active.ajax');
    Route::get('category/is_active/{id}', [CategoryController::class, 'changeStatus'])->name('admin.active.ajax');
    Route::get('package/is_active/{id}', [PackageController::class, 'changeStatus'])->name('admin.active.ajax');
    Route::get('flight/is_active/{id}', [FlightController::class, 'changeStatus'])->name('admin.active.ajax');
    Route::get('hotel/is_active/{id}', [BackendHotelController::class, 'changeStatus'])->name('admin.active.ajax');

    /*System backup route*/
    Route::get('/backup/download/{file_name}', [BackupDatabaseController::class, 'download'])->name('admin.backupDownload');
});
