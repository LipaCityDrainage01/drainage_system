<?php

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

Route::get('saveSensor', [\App\Http\Controllers\DetectionController::class, 'store']);

Route::middleware(['guest'])->group(function() {

    Route::get('/', function () {
        return view('secure.dashboard.index');
    })->name('home');

    Route::resource('/drainage', \App\Http\Controllers\BarangayListController::class);
    Route::resource('/maintenance', \App\Http\Controllers\MaintenanceReportController::class);

});


Route::group(['prefix' => 'aviary'], function () {
    Voyager::routes();
});
