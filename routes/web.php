<?php

use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\auth\LoginController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\backend\SystemAdminController;
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

Route::get('/', function () {
    return view('welcome');
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
    Route::resource('role',RoleController::class);
    Route::resource('system/admin',SystemAdminController::class);

    /*Ajax call */
    Route::get('check/is_active/{id}',[SystemAdminController::class,'changeStatus'])->name('admin.active.ajax');
});
