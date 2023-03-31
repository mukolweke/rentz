<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UnitsController;
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

Route::resource('units', UnitsController::class);

Route::post('category', [CategoryController::class, 'store'])->name('category.store');
Route::post('category/{category}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

Route::get('/settings', function () {
    return Inertia::render('Settings/Index', []);
})->name('settings');
