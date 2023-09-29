<?php

use App\Http\Controllers\DurableController;
use App\Http\Controllers\FixController;
use App\Http\Controllers\RepairController;
use App\Livewire\Setting\DurableType;
use Illuminate\Support\Facades\Auth;
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
    return view('layouts.layout');
})->name('index');
/* Route::get('/durables', function () {
    return view('admin.durables');
})->name('durables'); */
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'user-role:Admin'])->group(function () {
    Route::controller(DurableController::class)->group(function () {
        Route::get('/durables', 'index')->name('durables');
        Route::post('/daruble_edit', 'daruble_edit')->name('daruble_edit');
        Route::post('/daruble_add', 'daruble_add')->name('daruble_add');
        Route::delete('/daruble_del/{id}', 'destroy')->name('daruble_del');
        Route::get('/durables_qrcode', 'durables_qrcode')->name('durables_qrcode');
        Route::get('/pdf/{id}', 'pdf')->name('pdf');
    });

    Route::controller(RepairController::class)->group(function () {
        Route::get('/repair', 'index')->name('repair');
        Route::post('/updateRepair', 'updateRepair')->name('updateRepair');
        Route::delete('/DelRepair/{id}', 'DelRepair')->name('DelRepair');
    });
});

Route::controller(FixController::class)->group(function () {
    Route::get('/fix', 'index')->name('fix');
    Route::post('/fix', 'fix')->name('fix1');
});


Route::get('type', DurableType::class)->name('rrr');