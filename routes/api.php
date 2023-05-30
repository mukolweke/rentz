<?php

use App\Http\Controllers\GetApiData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/unit-options', [GetApiData::class, 'unitOptions'])->name('unit.options');
Route::get('/house-options', [GetApiData::class, 'houseOptions'])->name('house.options');

