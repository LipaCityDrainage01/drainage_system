<?php

use App\Http\Controllers\BarangayListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::apiResource('/barangay', BarangayListController::class);
Route::apiResource('/maintenance', \App\Http\Controllers\MaintenanceReportController::class);
Route::get('getDrainageReport/{location_id}', [\App\Http\Controllers\MaintenanceReportController::class, 'getDrainageReport']);
Route::group(['prefix' => '/', 'middleware' => 'auth:api'], function () {

});



