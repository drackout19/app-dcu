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
Route::put('/dashboard/updateDCU/{id}', [\App\Http\Controllers\TimesheetController::class, 'updateDCU']);
Route::put('/dashboard/storeTimesheet/{id}/{dcurecap_id}', [\App\Http\Controllers\TimesheetController::class, 'storeTimesheet'])->name('dashboard.storeTimesheet');
Route::put('/dashboard/updateTimesheet/{id}/{dcurecap_id}', [\App\Http\Controllers\TimesheetController::class, 'updateTimesheet']);
Route::put('/dashboard/destroyDcuTimesheet/{dcurecap_id}', [\App\Http\Controllers\TimesheetController::class, 'destroyDcuTimesheet']);
// ini route buat session
Route::post('/handleSession', [App\Http\Controllers\TimesheetController::class, 'handleSession'])->name('handleSession');
// Route::get('/handleSession', [App\Http\Controllers\TimesheetController::class, 'handleSession'])->name('handleSession');
Route::post('/updateDateSession', [App\Http\Controllers\TimesheetController::class, 'updateDateSession'])->name('updateDateSession')->block($lockSeconds = 10, $waitSeconds = 10);
Route::post('/updatePulangSession/{id}', [App\Http\Controllers\TimesheetController::class, 'updatePulangSession'])->name('updatePulangSession')->block($lockSeconds = 10, $waitSeconds = 10);
//end route buat session


Route::resource('/manpower', \App\Http\Controllers\ManpowerController::class);

Route::resource('/dcu-recap', \App\Http\Controllers\DcurecapController::class);
// Route::post('/dcu-recap/{monthYear}', [\App\Http\Controllers\DcurecapController::class, 'getDataTableDcurecapByMonth'])->name('dcu-recap.getDataTableDcurecapByMonth');
Route::post('/dcuRecapMontYear', [\App\Http\Controllers\DcurecapController::class, 'getDataTableDcurecapByMonth'])->name('dcuRecapMontYear');

// Route::get('/cobaTable', [\App\Http\Controllers\DcurecapController::class, 'getDataTableDcurecapByMonth'])->name('dcuRecapMontYear');

// Route::get('/table/{monthYear}', [\App\Http\Controllers\DcurecapController::class, 'getDataTableDcurecapByMonth']);
// Route::get('/table',  function() {
//         return view('dcu_recap.table', ["title" => "Page Manpower"]);
//     });


Route::get('/rekap-absensi', [\App\Http\Controllers\TimesheetController::class, 'getTimesheets']);
Route::post('/rekap-absensi', [\App\Http\Controllers\TimesheetController::class, 'getDataTableTimesheetByDate'])->name('getDataTableTimesheetByDate');
Route::post('/timesheetRecapMontYear', [\App\Http\Controllers\TimesheetController::class, 'getDataTableTimesheetRecapByMonth'])->name('timesheetRecapMontYear');

// debugging
Route::get('/timesheetRecapMontYear', [\App\Http\Controllers\TimesheetController::class, 'getDataTableTimesheetRecapByMonth'])->name('timesheetRecapMontYear');
//end debugging

Route::resource('/rekap-slip-gaji', \App\Http\Controllers\SalaryController::class);
Route::post('/getDataTableTimesheetPerson', [\App\Http\Controllers\SalaryController::class, 'getDataTableTimesheetPerson'])->name('getDataTableTimesheetPerson');
Route::post('/getDataTableLemburPerson', [\App\Http\Controllers\SalaryController::class, 'getDataTableLemburPerson'])->name('getDataTableLemburPerson');
Route::post('/getDataTableGajiPerson', [\App\Http\Controllers\SalaryController::class, 'getDataTableGajiPerson'])->name('getDataTableGajiPerson');
Route::post('/getSlipGajiPerson', [\App\Http\Controllers\SalaryController::class, 'getSlipGajiPerson'])->name('getSlipGajiPerson');
// Route::get('/template', function () {
//     return view('gaji_recap.templateSlipGaji');
// });

// Route::get('/coba', function () {
//     return view('gaji_recap.templateSlipGaji');
// });

// coba sendiri
Route::resource('/posts', \App\Http\Controllers\PostController::class);