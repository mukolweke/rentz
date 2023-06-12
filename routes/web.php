<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'authenticate']);


Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/', function () {
        return redirect('/dashboard');
    });

    // Admin/Staff Dashboard Routes
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        /** Houses */
        Route::resource('houses', HouseController::class);

        /** Units */
        Route::resource('units', UnitController::class);

        /** Categories */
        Route::get('category', [CategoryController::class, 'index'])->name('category.index');
        Route::post('category', [CategoryController::class, 'store'])->name('category.store');
        Route::post('category/{category}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

        /** Users */
        Route::post('users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::post('users/{user}/update-avatar', [UserController::class, 'updateAvatar'])->name('users.update.avatar');
        Route::get('users/{user}/remove-avatar', [UserController::class, 'removeAvatar'])->name('users.remove.avatar');
        Route::resource('users', UserController::class);
        // Route::post('users/{user}/next-of-kins', [UserController::class, 'nextOfKin'])->name('nextOfKin.store');
        Route::post('users/{user}/next-of-kins', [UserController::class, 'nextOfKin'])->name('nextOfKin.store');

        // remove tenant from unit
        Route::get('/units/{unit}/tenant/{tenant}/remove', [TenantController::class, 'removeTenant'])->name('remove.tenant');

        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings/user/avatar', [SettingController::class, 'userAvatar'])->name('settings.user.avatar');
    });

    // Tenant Dashboard Routes
    Route::get('/tenant/dashboard', [TenantController::class, 'dashboard'])->name('tenant.dashboard');

    Route::get('/billing', function () {
    })->name('billing');

    Route::get('/tenant-unit', function () {
    })->name('tenant-unit');
});
