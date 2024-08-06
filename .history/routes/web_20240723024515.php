<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\LoginController;

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
Route::get('/', function() {
    return view('login.index');
});
Route::get('/login', function() {
    return view('login.index');
})->name('login');

Route::get('/login-staff', function() {
    return view('login.indexStaff');
})->name('loginstaff');

Route::post('/postLogin', [LoginController::class, 'postLogin'])->name('postLogin');
Route::post('/postLoginStaff', [LoginController::class, 'postLoginStaff'])->name('postLoginStaff');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', function () {
    return view('register.index');
});

Route::group(['middleware' => ['auth', 'CekLevel:keuangan,hrd,admin']], function () {
    // handle dashboard
    Route::get('/admin/dashboard', [\App\Http\Controllers\dashboardController::class, 'index'])->name('admin');
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

    // handle manpower
    Route::resource('/manpower', \App\Http\Controllers\ManpowerController::class);

    // handle dcu recap
    Route::resource('/dcu-recap', \App\Http\Controllers\DcurecapController::class);
    Route::post('/dcuRecapMontYear', [\App\Http\Controllers\DcurecapController::class, 'getDataTableDcurecapByMonth'])->name('dcuRecapMontYear');

    // handle absensi recap
    Route::get('/rekap-absensi', [\App\Http\Controllers\TimesheetController::class, 'getTimesheets']);
    Route::post('/rekap-absensi', [\App\Http\Controllers\TimesheetController::class, 'getDataTableTimesheetByDate'])->name('getDataTableTimesheetByDate');
    Route::post('/timesheetRecapMontYear', [\App\Http\Controllers\TimesheetController::class, 'getDataTableTimesheetRecapByMonth'])->name('timesheetRecapMontYear');


    // handle rekap slip gaji
    // Route::get('/admin/rekap-slip-gaji', [\App\Http\Controllers\dashboardController::class, 'pekerja'])->name('pekerja');
    Route::get('/rekap-slip-gaji', [\App\Http\Controllers\SalaryController::class, 'index']);
    Route::post('/updatePendapatanGaji', [\App\Http\Controllers\SalaryController::class, 'updatePendapatanGaji'])->name('updatePendapatanGaji');
    Route::post('/approvePendapatanGaji', [\App\Http\Controllers\SalaryController::class, 'approvePendapatanGaji'])->name('approvePendapatanGaji');
    Route::post('/cancelApprovePendapatanGaji', [\App\Http\Controllers\SalaryController::class, 'cancelApprovePendapatanGaji'])->name('cancelApprovePendapatanGaji');
    Route::post('/getViewIndexSlipGajiByMonthYear', [\App\Http\Controllers\SalaryController::class, 'getViewIndexSlipGajiByMonthYear'])->name('getViewIndexSlipGajiByMonthYear');
    // Route::get('/rekap-slip-gaji/{id}/{monthYear}', [\App\Http\Controllers\SalaryController::class, 'edit'])->name('rekap-slip-gaji.edit');
    Route::get('/rekap-slip-gaji/{id}/{monthYear}', [\App\Http\Controllers\SalaryController::class, 'show'])->name('rekap-slip-gaji.show');
    Route::post('/getDataTableTimesheetPerson', [\App\Http\Controllers\SalaryController::class, 'getDataTableTimesheetPerson'])->name('getDataTableTimesheetPerson');
    Route::post('/getDataTableLemburPerson', [\App\Http\Controllers\SalaryController::class, 'getDataTableLemburPerson'])->name('getDataTableLemburPerson');
    Route::post('/getDataTableGajiPerson', [\App\Http\Controllers\SalaryController::class, 'getDataTableGajiPerson'])->name('getDataTableGajiPerson');
    Route::post('/getDataTablePendapatanPerson', [\App\Http\Controllers\SalaryController::class, 'getDataTablePendapatanPerson'])->name('getDataTablePendapatanPerson');
    Route::post('/getSlipGajiPerson', [\App\Http\Controllers\SalaryController::class, 'getSlipGajiPerson'])->name('getSlipGajiPerson');

    Route::get('/konfirmasiPerubahanData', [\App\Http\Controllers\UpdateProfilePendingController::class, 'index'])->name('konfirmasiPerubahanData');
    Route::get('/getViewCompareDataPersonBeforeAfter/{id}', [\App\Http\Controllers\UpdateProfilePendingController::class, 'getViewCompareDataPersonBeforeAfter'])->name('getViewCompareDataPersonBeforeAfter');
    Route::get('/approveUpdatePerubahanData/{id}', [\App\Http\Controllers\UpdateProfilePendingController::class, 'approveUpdatePerubahanData'])->name('approveUpdatePerubahanData');
});

Route::group(['middleware' => ['auth', 'CekLevel:keuangan,hrd,admin,pekerja']], function () {
    // handle manpower
    Route::get('/datadiri/{id}', [\App\Http\Controllers\ManpowerController::class, 'show'])->name('dataDiri');
    Route::get('/updateProfilePerson/{id}', [\App\Http\Controllers\ManpowerController::class, 'edit'])->name('updateProfilePerson');
    Route::put('/updateProfilePersonPending/{id}', [\App\Http\Controllers\UpdateProfilePendingController::class, 'updateProfilePersonPending'])->name('updateProfilePersonPending');
    UserController
    Route::get('/datadiri/{id}', [\App\Http\Controllers\ManpowerController::class, 'show'])->name('dataDiri');

    Route::get('/pekerja', [\App\Http\Controllers\dashboardController::class, 'pekerja'])->name('pekerja');
    Route::get('/rekap-slip-gaji', [\App\Http\Controllers\SalaryController::class, 'index']);
    Route::get('/rekap-slip-gaji-person/{id}', [\App\Http\Controllers\SalaryController::class, 'indexPerson']);
    Route::post('/updatePendapatanGaji', [\App\Http\Controllers\SalaryController::class, 'updatePendapatanGaji'])->name('updatePendapatanGaji');
    Route::post('/approvePendapatanGaji', [\App\Http\Controllers\SalaryController::class, 'approvePendapatanGaji'])->name('approvePendapatanGaji');
    Route::post('/cancelApprovePendapatanGaji', [\App\Http\Controllers\SalaryController::class, 'cancelApprovePendapatanGaji'])->name('cancelApprovePendapatanGaji');
    Route::post('/getViewIndexSlipGajiByMonthYear', [\App\Http\Controllers\SalaryController::class, 'getViewIndexSlipGajiByMonthYear'])->name('getViewIndexSlipGajiByMonthYear');
    // Route::get('/rekap-slip-gaji/{id}/{monthYear}', [\App\Http\Controllers\SalaryController::class, 'edit'])->name('rekap-slip-gaji.edit');
    Route::get('/rekap-slip-gaji/{id}/{monthYear}', [\App\Http\Controllers\SalaryController::class, 'show'])->name('rekap-slip-gaji.show');
    Route::post('/getDataTableTimesheetPerson', [\App\Http\Controllers\SalaryController::class, 'getDataTableTimesheetPerson'])->name('getDataTableTimesheetPerson');
    Route::post('/getDataTableLemburPerson', [\App\Http\Controllers\SalaryController::class, 'getDataTableLemburPerson'])->name('getDataTableLemburPerson');
    Route::post('/getDataTableGajiPerson', [\App\Http\Controllers\SalaryController::class, 'getDataTableGajiPerson'])->name('getDataTableGajiPerson');
    Route::post('/getDataTablePendapatanPerson', [\App\Http\Controllers\SalaryController::class, 'getDataTablePendapatanPerson'])->name('getDataTablePendapatanPerson');
    Route::post('/getSlipGajiPerson', [\App\Http\Controllers\SalaryController::class, 'getSlipGajiPerson'])->name('getSlipGajiPerson');
});



// komen
// Route::put('/dashboard/storeDCU/{id}', [\App\Http\Controllers\TimesheetController::class, 'storeDCU'])->name('dashboard.storeDCU');
// Route::put('/dashboard/updateDCU/{id}', [\App\Http\Controllers\TimesheetController::class, 'updateDCU']);
// Route::put('/dashboard/storeTimesheet/{id}/{dcurecap_id}', [\App\Http\Controllers\TimesheetController::class, 'storeTimesheet'])->name('dashboard.storeTimesheet');
// Route::put('/dashboard/updateTimesheet/{id}/{dcurecap_id}', [\App\Http\Controllers\TimesheetController::class, 'updateTimesheet']);
// Route::put('/dashboard/destroyDcuTimesheet/{dcurecap_id}', [\App\Http\Controllers\TimesheetController::class, 'destroyDcuTimesheet']);
// // ini route buat session
// Route::post('/handleSession', [App\Http\Controllers\TimesheetController::class, 'handleSession'])->name('handleSession');
// // Route::get('/handleSession', [App\Http\Controllers\TimesheetController::class, 'handleSession'])->name('handleSession');
// Route::post('/updateDateSession', [App\Http\Controllers\TimesheetController::class, 'updateDateSession'])->name('updateDateSession')->block($lockSeconds = 10, $waitSeconds = 10);
// Route::post('/updatePulangSession/{id}', [App\Http\Controllers\TimesheetController::class, 'updatePulangSession'])->name('updatePulangSession')->block($lockSeconds = 10, $waitSeconds = 10);
//end route buat session
//end komen


// Route::resource('/manpower', \App\Http\Controllers\ManpowerController::class);

// Route::resource('/dcu-recap', \App\Http\Controllers\DcurecapController::class);
// Route::post('/dcu-recap/{monthYear}', [\App\Http\Controllers\DcurecapController::class, 'getDataTableDcurecapByMonth'])->name('dcu-recap.getDataTableDcurecapByMonth');
// Route::post('/dcuRecapMontYear', [\App\Http\Controllers\DcurecapController::class, 'getDataTableDcurecapByMonth'])->name('dcuRecapMontYear');

// Route::get('/cobaTable', [\App\Http\Controllers\DcurecapController::class, 'getDataTableDcurecapByMonth'])->name('dcuRecapMontYear');

// Route::get('/table/{monthYear}', [\App\Http\Controllers\DcurecapController::class, 'getDataTableDcurecapByMonth']);
// Route::get('/table',  function() {
//         return view('dcu_recap.table', ["title" => "Page Manpower"]);
//     });


// Route::get('/rekap-absensi', [\App\Http\Controllers\TimesheetController::class, 'getTimesheets']);
// Route::post('/rekap-absensi', [\App\Http\Controllers\TimesheetController::class, 'getDataTableTimesheetByDate'])->name('getDataTableTimesheetByDate');
// Route::post('/timesheetRecapMontYear', [\App\Http\Controllers\TimesheetController::class, 'getDataTableTimesheetRecapByMonth'])->name('timesheetRecapMontYear');

// debugging
Route::get('/timesheetRecapMontYear', [\App\Http\Controllers\TimesheetController::class, 'getDataTableTimesheetRecapByMonth'])->name('timesheetRecapMontYear');
//end debugging


// komen
// Route::resource('/rekap-slip-gaji', \App\Http\Controllers\SalaryController::class);
// Route::get('/rekap-slip-gaji', [\App\Http\Controllers\SalaryController::class, 'index']);
// Route::post('/updatePendapatanGaji', [\App\Http\Controllers\SalaryController::class, 'updatePendapatanGaji'])->name('updatePendapatanGaji');
// Route::post('/approvePendapatanGaji', [\App\Http\Controllers\SalaryController::class, 'approvePendapatanGaji'])->name('approvePendapatanGaji');
// Route::post('/cancelApprovePendapatanGaji', [\App\Http\Controllers\SalaryController::class, 'cancelApprovePendapatanGaji'])->name('cancelApprovePendapatanGaji');
// Route::post('/getViewIndexSlipGajiByMonthYear', [\App\Http\Controllers\SalaryController::class, 'getViewIndexSlipGajiByMonthYear'])->name('getViewIndexSlipGajiByMonthYear');
// // Route::get('/rekap-slip-gaji/{id}/{monthYear}', [\App\Http\Controllers\SalaryController::class, 'edit'])->name('rekap-slip-gaji.edit');
// Route::get('/rekap-slip-gaji/{id}/{monthYear}', [\App\Http\Controllers\SalaryController::class, 'show'])->name('rekap-slip-gaji.show');
// Route::post('/getDataTableTimesheetPerson', [\App\Http\Controllers\SalaryController::class, 'getDataTableTimesheetPerson'])->name('getDataTableTimesheetPerson');
// Route::post('/getDataTableLemburPerson', [\App\Http\Controllers\SalaryController::class, 'getDataTableLemburPerson'])->name('getDataTableLemburPerson');
// Route::post('/getDataTableGajiPerson', [\App\Http\Controllers\SalaryController::class, 'getDataTableGajiPerson'])->name('getDataTableGajiPerson');
// Route::post('/getDataTablePendapatanPerson', [\App\Http\Controllers\SalaryController::class, 'getDataTablePendapatanPerson'])->name('getDataTablePendapatanPerson');
// Route::post('/getSlipGajiPerson', [\App\Http\Controllers\SalaryController::class, 'getSlipGajiPerson'])->name('getSlipGajiPerson');
// end komen

// route role HRD
Route::get('/hrd/dashboard', function() {
    return view('hrd.layouts.main');
});

// Route::get('/hrd/manpower', function() {
//     return view('hrd.layouts.main');
// });

// coba sendiri
Route::resource('/posts', \App\Http\Controllers\PostController::class);