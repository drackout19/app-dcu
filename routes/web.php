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

// Route::get('/', function () {
//     return view('beranda');
// });

// Route::get('/dashboard', function () {
//     return view('beranda');
// });

// Route::get('/manpower', function () {
//     return view('manpower.index', [
//         "title" => "Page Manpower",
//         "manpowers" => App\Models\Manpower::all()
//     ]);
// });

// Route::resource('/', \App\Http\Controllers\TimesheetController::class);

Route::resource('/dashboard', \App\Http\Controllers\TimesheetController::class);

Route::put('/dashboard/storeDCU/{id}', [\App\Http\Controllers\TimesheetController::class, 'storeDCU'])->name('dashboard.storeDCU');
Route::put('/dashboard/storeTimesheet/{id}', [\App\Http\Controllers\TimesheetController::class, 'storeTimesheet'])->name('dashboard.storeTimesheet');

Route::resource('/manpower', \App\Http\Controllers\ManpowerController::class);

Route::resource('/dcu-recap', \App\Http\Controllers\DcurecapController::class);
// Route::delete('/manpower/{manpower:id}', [\App\Http\Controllers\ManpowerController::class, 'delete']);

// Route::get('/manpower/addperson', function () {
//     return view('manpower.addperson', [
//         "title" => "Add Person Manpower"
//     ]);
// });

// Route::resource('/manpower/create', \App\Http\Controllers\ManpowerController::class);

// Route::get('/rekap-dcu', function () {
//     return view('rekapDcu');
// });

Route::get('/rekap-absensi', function () {
    return view('rekapAbsensi', [
        "title" => "Page Rekap Absensi"
    ]);
});

Route::get('/rekap-slip-gaji', function () {
    return view('rekapSlipGaji');
});

Route::get('/coba', function () {
    return view('coba');
});

// coba sendiri
Route::resource('/posts', \App\Http\Controllers\PostController::class);