<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HouseController;
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

    Route::get('/dashboard', function () {
        return Inertia::render('Home/Index', [
            'label' => 'Home'
        ]);
    })->name('dashboard');

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
    Route::resource('users', UserController::class);
    // Route::post('users/{user}/next-of-kins', [UserController::class, 'nextOfKin'])->name('nextOfKin.store');
    Route::post('users/{user}/next-of-kins', [UserController::class, 'nextOfKin'])->name('nextOfKin.store');

    // remove tenant from unit
    Route::get('/units/{unit}/tenant/{tenant}/remove', [TenantController::class, 'removeTenant'])->name('remove.tenant');

    Route::get('/settings', function () {
        return Inertia::render('Settings/Index', []);
    })->name('settings');


    Route::get('/profile', function () {
    })->name('profile');
    Route::get('/payment', function () {
    })->name('payment');
    Route::get('/unit', function () {
    })->name('unit');
});
