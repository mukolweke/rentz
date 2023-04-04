<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\UnitController;
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

/** Tenants */
Route::resource('tenants', TenantController::class);
Route::get('/units/{unit}/tenant/{tenant}/remove', [TenantController::class, 'removeTenant'])->name('tenants.remove');

Route::get('/settings', function () {
    return Inertia::render('Settings/Index', []);
})->name('settings');
