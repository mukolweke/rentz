<?php

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

Route::get('/dashboard', function () {
    return Inertia::render('Home/Index', [
        'label' => 'Home'
    ]);
})->name('dashboard');

Route::get('/units', function () {
    return Inertia::render('Units/Index', [
        'label' => 'Units'
    ]);
})->name('units');

Route::get('/settings', function () {
    return Inertia::render('Settings/Index', [
        'label' => 'Settings'
    ]);
})->name('settings');
