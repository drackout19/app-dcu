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

Route::get('/', function () {
    return view('beranda');
});

Route::get('/dashboard', function () {
    return view('beranda');
});

Route::get('/manpower', function () {
    return view('manpower');
});

Route::get('/rekap-dcu', function () {
    return view('rekapDcu');
});

Route::get('/rekap-absensi', function () {
    return view('rekapAbsensi');
});

Route::get('/rekap-slip-gaji', function () {
    return view('rekapSlipGaji');
});

Route::get('/coba', function () {
    return view('coba');
});

// coba sendiri
Route::resource('/posts', \App\Http\Controllers\PostController::class);