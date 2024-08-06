<?php

namespace App\Http\Controllers;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

//reponse
use Illuminate\Support\Facades\Response;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

use Session;


use App\Models\Manpower;
use App\Models\Dcurecap;
use App\Models\Timesheet;
use App\Models\Salary;

class TimesheetController extends Controller
{
     /**
     * index
     *
     * @return View
     */
    public function index() : View
    {
        //get posts
        // $data = [['title'=>'Manpower']];
        // dd(Session::get('dateThisDay'));
        $dataManpower = Manpower::with('dcurecap')->get();

        // $dcurecap = Dcurecap::where('tanggal', '2024-07-08');
        // $timesheets = Dcurecap::where('tanggal', '2024-07-08');
        $dcurecap = Dcurecap::all();
        // $timesheet =  Timesheet::where('tanggal', '2024-07-08')->get();
        //render view with posts
        // return view('dashboard.index', ["manpowers" => $dataManpower, "dcurecap" => Dcurecap::all(), "timesheet" => Timesheet::all()]);
        return view('dashboard.index', ["manpowers" => $dataManpower, compact('dcurecap'), "timesheet" => Timesheet::all()]);
    }

    public function getDataTableTimesheetByDate(Request $request) : View
    {
        $inputDatePickerRekapDcu = $request->inputDatePickerRekapDcu;
        // $inputDatePickerRekapDcu = "2024-07-15";

        // $dataManpower = Manpower::with('dcurecap')->get();
        $dataManpower = Manpower::all();

        // dd($dataManpower[0]->dcurecap[0]->id);

        $dataTimesheet = Timesheet::with(['dcurecap' => function ($query) use ($inputDatePickerRekapDcu) {
                $query->where('tanggal', $inputDatePickerRekapDcu); // replace 'column_name' and 'value' with your condition
            }])->get();

        // $dataTimesheet = Timesheet::all();
        // dd($dataTimesheet);

        $dataDCU = Dcurecap::where('tanggal', $inputDatePickerRekapDcu)->get();

        // dd($dataTimesheet);
        return view('absensi_recap.index', ["manpowers" => $dataManpower, "timesheets" => $dataTimesheet, "rekapDCU" => $dataDCU, "date" => $inputDatePickerRekapDcu]);
    }

    public function getTimesheets() : View
    {
        //get posts
        // $data = [['title'=>'Manpower']];
        // dd(Session::get('dateThisDay'));
        $dataManpower = Manpower::with('dcurecap')->get();

        // $dcurecap = Dcurecap::where('tanggal', '2024-07-08');
        // $timesheets = Dcurecap::where('tanggal', '2024-07-08');
        $thisDay = Session::get('dateThisDay');

        $dataDCU = Dcurecap::where('tanggal', $thisDay)->get();

        // dd(Timesheet::where('dcurecap_id', 8));exit;
        // $timesheet =  Timesheet::where('tanggal', '2024-07-08')->get();
        //render view with posts

        // $x = Timesheet::all();

        // dd($x)

        
        
        // return view('absensi_recap.index', ["manpowers" => $dataManpower, compact('dcurecap'), "timesheets" => Timesheet::all(), "data" => Dcurecap::all()]);
        return view('absensi_recap.index', ["manpowers" => $dataManpower, "timesheets" => Timesheet::all(), "rekapDCU" => $dataDCU, "date" => $thisDay]);
    }

    public function getDataTableTimesheetRecapByMonth(Request $request)
    {
        // echo $request->monthYear;
        // exit;
        // $monthYear = "July 2024";
        $monthYear = $request->monthYear;
        $monthYearArray = preg_split('/\s+/', $monthYear);

        $monthName = $monthYearArray[0];
        $year = $monthYearArray[1];

        switch ($monthName) {
            case 'January' :
                $monthName = '01';
                break;
            case 'February' :
                $monthName = '02';
                break;
            case 'March' :
                $monthName = '03';
                break;
            case 'April' :
                $monthName = '04';
                break;
            case 'May' :
                $monthName = '05';
                break;
            case 'June' :
                $monthName = '06';
                break;
            case 'July' :
                $monthName = '07';
                break;
            case 'August' :
                $monthName = '08';
                break;
            case 'September' :
                $monthName = '09';
                break;
            case 'October' :
                $monthName = '10';
                break;
            case 'November' :
                $monthName = '11';
                break;
            case 'December' :
                $monthName = '12';
                break;
            
        }

        // dd($monthName);
        $pattern = $year.'-'.$monthName.'-'.'\d{2}$';
        $data = Dcurecap::whereRaw('tanggal REGEXP ?', [$pattern])->get();
        $dataManpower = Manpower::all();
        $dataTimesheets = Timesheet::all();
        // $dataTimesheets = Timesheet::with('dcurecap')->get();

        // dd($dataTimesheets[0]->dcurecap->tanggal);
        // dd(($dataTimesheets->where('dcurecap_id', 14)->first()) == null);

        return view('absensi_recap.table', ["data" => $data, "dataManpower" => $dataManpower, "timesheets" => $dataTimesheets,"monthYear" => $monthYear]);
        // return view('absensi_recap.index', ["manpowers" => $dataManpower, "timesheets" => Timesheet::all(), "rekapDCU" => $dataDCU, "date" => $thisDay]);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */

    public function storeDCU(Request $request, $id): RedirectResponse
    {
        try {
            $dcu = new Dcurecap();

            // $date = "inputDate".$id;
            // echo $date;
            // echo $request["inputDate".$id];
            // echo $request->inputSuhuBadan4;
            // echo $request->kontol;
            // echo $request["inputStatusDCU".$id];
            //  exit;
            $dcu->fill([
                'tanggal'     => $request["inputDate".$id],
                // 'tanggal'     => "2024-07-10",
                'manpower_id'     => $id,
                'status_dcu'   => $request["inputStatusDCU".$id],
                'suhu_badan'   => $request["inputSuhuBadan".$id],
                'kadar_oksigen'   => $request["inputKadarOksigenDarah".$id],
                
            ]);

            if(!empty($request["inputTekananSistolik".$id]) && !empty($request["inputTekananDiastolik".$id])) {
                $dcu->fill([
                    'detak_jantung'   => $request["inputDetakJantung".$id],
                    'tekanan_darah'   => $request["inputTekananSistolik".$id]. " / " . $request["inputTekananDiastolik".$id],
                ]);
            }



            $dcu->save();

            

            return redirect()->route('dashboard.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Throwable $th) {
            // echo "data gagal Disimpan";
            return redirect()->route('dashboard.index')->with(['error' => 'Data gagal Disimpan!']);
        }
        

    }
    /**
     * update
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function updateDCU(Request $request, $id): RedirectResponse
    {

        //  $dcu = Dcurecap::where('manpower_id', $id)->get();
        //  $dcu = Dcurecap::where('manpower_id', $id)->where('tanggal', $request["inputDate".$id])->first();
        
        // foreach ($dcu as $data) {
        //     // dd($data->status_dcu);
            
        // }

        // dd($request["inputUbahJamMasuk".$id]);
        // exit;

        // $dcu->update(['status_dcu' => 'UNFIT']);
        
        // exit;
        
        try {
            // $dcu = new Dcurecap();
            // $dcu = Dcurecap::findOrFail($id);
            $dcu = Dcurecap::where('manpower_id', $id)->where('tanggal', $request["inputDate".$id])->first();
            // dd($dcu);
            // exit;

            // $date = "inputDate".$id;
            // echo $date;
            // echo $request["inputDate".$id];
            // echo $request->inputSuhuBadan4;
            // echo $request->kontol;
            // echo $request["inputStatusDCU".$id];
            //  exit;
            $dcu->fill([
                'tanggal'     => $request["inputDate".$id],
                // 'tanggal'     => "2024-07-10",
                'manpower_id'     => $id,
                'status_dcu'   => $request["inputStatusDCU".$id],
                'suhu_badan'   => $request["inputSuhuBadan".$id],
                'kadar_oksigen'   => $request["inputKadarOksigenDarah".$id],
                'detak_jantung'   => $request["inputDetakJantung".$id],
                'tekanan_darah'   => null,
            ]);

            if(!empty($request["inputTekananSistolik".$id]) && !empty($request["inputTekananDiastolik".$id])) {
                $dcu->fill([
                    
                    'tekanan_darah'   => $request["inputTekananSistolik".$id]. " / " . $request["inputTekananDiastolik".$id],
                ]);
            }



            $dcu->update();

            

            if($request["inputStatusDCU".$id] == "UNFIT") {
                $timesheet = Timesheet::where('dcurecap_id', $dcu->id)->first();

                if($timesheet != null) {
                    // dd("yes");exit;
                    $timesheet->delete();

                    return redirect()->route('dashboard.index')->with(['success' => 'Data Berhasil Disimpan!']);
                    // $timesheet::update(['jamMasuk' => null, 'jamLembur' => null, 
                    // 'jamPulang' => null, 'totalWaktuLembur' => null, 'keterangan_masuk' => null, 'keterangan_lembur' => null, 'keterangan_pulang' => null,])
                }
            }
            

            

            return redirect()->route('dashboard.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Throwable $th) {
            // echo "data gagal Disimpan";
            return redirect()->route('dashboard.index')->with(['error' => 'Data gagal Disimpan!']);
        }
        

    }

    /**
     * store
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */

    public function storeTimesheet(Request $request, $id, $dcurecap_id): RedirectResponse
    {
        // dd($id);
        $timesheet = new Timesheet();
        // $salary = Salary::where('manpower_id', $id)->first();
        // debug
        $salary = Salary::where('manpower_id', $id)->with('timesheet')->first();
        //end debug
        $manpowerPerson = Manpower::where('id', $id)->first();

        // dd($salary->id); exit;
        // dd($dcurecap_id);exit;
        try {
            

            // $date = "inputDate".$id;
            // echo $id;
            // echo $request["inputDate".$id];
            // echo $request->inputSuhuBadan4;
            // echo $request->kontol;
            // echo $request["inputJamMasuk".$id];
            // echo "<br>";
            // echo $request["inputJamLembur".$id];
            // echo "<br>";
            // echo $request["inputKeteranganLembur".$id];
            // echo $request["inputJamLembur".$id];
            // exit;

            $timesheet->fill([
                'dcurecap_id' => $dcurecap_id,
                'salary_id' => $salary->id,
                // 'jamMasuk'   => $request["inputJamMasuk".$id]
                
            ]);

            if(!empty($request["inputJamMasuk".$id])) {
                $timesheet->fill([
                    'jamMasuk'   => $request["inputJamMasuk".$id]
                ]);

                if(!empty($request["inputKeteranganMasuk".$id])) {
                    $timesheet->fill([
                        'keterangan_masuk'   => $request["inputKeteranganMasuk".$id],
                    ]);
                }
            }
            
            if(!empty($request["inputJamLembur".$id])) {
                $timesheet = Timesheet::where("dcurecap_id", $dcurecap_id)->first();
                // dd($timesheet->jamMasuk);
                // exit;
                $timesheet->fill([
                    'jamLembur'   => $request["inputJamLembur".$id],
                ]);

                if(!empty($request["inputKeteranganLembur".$id])) {
                    $timesheet->fill([
                        'keterangan_lembur'   => $request["inputKeteranganLembur".$id],
                    ]);
                }

                $timesheet->update();
                return redirect()->route('dashboard.index')->with(['success' => 'Data Berhasil Disimpan!']);
                exit;
            }

            if(!empty($request["inputJamPulang".$id])) {
                $timesheet = Timesheet::where("dcurecap_id", $dcurecap_id)->first();
                // dd($request["inputJamPulang".$id]);
                // exit;
                $timesheet->fill([
                    'jamPulang'   => $request["inputJamPulang".$id],
                ]);

                if(!empty($request["inputKeteranganPulang".$id])) {
                    $timesheet->fill([
                        'keterangan_pulang'   => $request["inputKeteranganPulang".$id],
                    ]);
                }

                if(!empty($request["inputTotalWaktuLembur".$id])) {
                    // dd($request["inputTotalWaktuLembur".$id]);
                    // exit;
                    $timesheet->fill([
                        'totalWaktuLembur'   => $request["inputTotalWaktuLembur".$id],
                    ]);
                }

                $timesheet->update();

                // unutk crud salary ketika manpower pulang

                // dd($salary->timesheet[1]->totalWaktuLembur);exit;

                


                if($salary != null) {
                    function parseTime($string) {
                        // Use regular expression to extract hours and minutes
                        preg_match('/(\d+)\s*Jam/', $string, $hoursMatch);
                        preg_match('/(\d+)\s*Menit/', $string, $minutesMatch);
                        
                        // Extract hours and minutes or set them to 0 if not found
                        $hours = isset($hoursMatch[1]) ? (int)$hoursMatch[1] : 0;
                        $minutes = isset($minutesMatch[1]) ? (int)$minutesMatch[1] : 0;
            
                        // Return total time in minutes
                        return ($hours * 60) + $minutes;
                    }
            
                    function convertMinutesToHoursAndMinutes($totalMinutes) {
                        $hours = intdiv($totalMinutes, 60);
                        $minutes = $totalMinutes % 60;
                        return [$hours, $minutes];
                    }
                    
                    $totalJamLembur = '0 Jam 0 Menit';

                    foreach($salary->timesheet as $data) {
                        $time1 = parseTime($totalJamLembur);
                        $time2 = parseTime($data->totalWaktuLembur);
        
                        // Calculate total time in minutes
                        // $totalMinutes = $time1 + $time2;
                        $totalJamLembur = $time1 + $time2;
                        
        
                    }

                    // exit;
        
                    list($totalHours, $totalMinutes) = convertMinutesToHoursAndMinutes($totalJamLembur);
        
                    // // Print the result
                    // echo "Total time: {$totalHours} hours {$totalMinutes} minutes";
                    // echo '<br>';
                    
                    // echo $totalHours*$salary->gaji_lembur;
        
                    $totalJamLembur = $totalHours;
                    $total_gaji_lembur = $totalHours*$salary->gaji_lembur;
                    $total_gaji_bersih = $salary->jumlah_gaji_bersih+$total_gaji_lembur;

                    // dd($totalJamLembur);exit;
                    // exit;
        
                    
                    // $salary->update(['jumlah_gaji_lembur' => 30000]);

                    // update salary
                    
                    
                    // if($manpowerPerson->status_pekerja == 'Lepas') {
                        $salary->update(['jumlah_gaji_lembur' => $total_gaji_lembur]);
                        
                        if($salary->jumlah_gaji_harian == null) {
                            $salary->fill([
                                'jumlah_gaji_harian'   => $salary->gaji_harian,
                                'jumlah_gaji_bersih'   => $salary->gaji_harian,
                            ]);
                        } else {
                            $salary->fill([
                                'jumlah_gaji_harian'   => $salary->jumlah_gaji_harian + $salary->gaji_harian,
                                'jumlah_gaji_bersih'   => $salary->jumlah_gaji_harian + $salary->jumlah_gaji_lembur,
                            ]);

                            if($salary->jumlah_gaji_lembur == null) {
                                if($salary->jumlah_gaji_harian == null) {
                                    $salary->fill([
                                        'jumlah_gaji_bersih'   => $salary->gaji_harian,
                                    ]);
                                } else {
                                    $salary->fill([
                                        'jumlah_gaji_bersih'   => $salary->jumlah_gaji_harian,
                                    ]);
                                }
                                
                            } else {
                                if($salary->jumlah_gaji_harian == null) {
                                    $salary->fill([
                                        'jumlah_gaji_bersih'   => $salary->gaji_harian,
                                    ]);
                                } else {
                                    $salary->fill([
                                        'jumlah_gaji_bersih'   => $salary->jumlah_gaji_harian+$salary->jumlah_gaji_lembur,
                                    ]);
                                }
                            }
                        }
                    // } 
                    

                    $salary->update();


                    return redirect()->route('dashboard.index')->with(['success' => 'Data Berhasil Disimpan!']);
                    exit;
                }
            }

            

            

            // if(!empty($request["inputKeteranganPulang".$id])) {
            //     $timesheet->fill([
            //         'keterangan_pulang'   => $request["inputKeteranganPulang".$id],
            //     ]);
            // }
            

            $timesheet->save();

            return redirect()->route('dashboard.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Throwable $th) {
            // echo "data gagal Disimpan";

            // dd($th);
            return redirect()->route('dashboard.index')->with(['error' => 'Data gagal Disimpan!']);
        }
        

    }

    public function updateTimesheet(Request $request, $id, $dcurecap_id): RedirectResponse
    {

        //  $dcu = Dcurecap::where('manpower_id', $id)->get();
        //  $dcu = Dcurecap::where('manpower_id', $id)->where('tanggal', $request["inputDate".$id])->first();
        
        // foreach ($dcu as $data) {
        //     // dd($data->status_dcu);
            
        // }

        // dd($request["inputUbahJamMasuk".$id]);
        // exit;

        // $dcu->update(['status_dcu' => 'UNFIT']);
        
        // exit;
        
        // try {
        //     // $dcu = new Dcurecap();
        //     // $dcu = Dcurecap::findOrFail($id);
        //     $dcu = Dcurecap::where('manpower_id', $id)->where('tanggal', $request["inputDate".$id])->first();
        //     // dd($dcu);
        //     // exit;

        //     // $date = "inputDate".$id;
        //     // echo $date;
        //     // echo $request["inputDate".$id];
        //     // echo $request->inputSuhuBadan4;
        //     // echo $request->kontol;
        //     // echo $request["inputStatusDCU".$id];
        //     //  exit;
        //     $dcu->fill([
        //         // 'tanggal'     => $request["inputDate".$id],
        //         'tanggal'     => "2024-07-10",
        //         'manpower_id'     => $id,
        //         'status_dcu'   => $request["inputStatusDCU".$id],
        //         'suhu_badan'   => $request["inputSuhuBadan".$id],
        //         'kadar_oksigen'   => $request["inputKadarOksigenDarah".$id],
        //         'detak_jantung'   => $request["inputDetakJantung".$id],
        //         'tekanan_darah'   => null,
        //     ]);
        try {
            // $timesheet = new Timesheet();
            $timesheet = Timesheet::where('dcurecap_id', $dcurecap_id)->first();

            // $date = "inputDate".$id;
            // echo $id;
            // echo $request["inputDate".$id];
            // echo $request->inputSuhuBadan4;
            // echo $request->kontol;
            // echo $request["inputJamMasuk".$id];
            // echo "<br>";
            // echo $request["inputJamLembur".$id];
            // echo "<br>";
            // echo $request["inputKeteranganLembur".$id];
            // echo $request["inputJamLembur".$id];
            // exit;

            // dd($timesheet->jamMasuk);exit;

            // $timesheet->fill([
            //     'dcurecap_id' => $dcurecap_id
            //     // 'jamMasuk'   => $request["inputJamMasuk".$id]
                
            // ]);

            if(!empty($request["inputUbahJamMasuk".$id])) {
                $timesheet->fill([
                    'jamMasuk'   => $request["inputUbahJamMasuk".$id]
                ]);

                // if(!empty($request["inputKeteranganMasuk".$id])) {
                //     $timesheet->fill([
                //         'keterangan_masuk'   => $request["inputKeteranganMasuk".$id],
                //     ]);
                // }
            }
            
            if(!empty($request["inputUbahJamLembur".$id])) {
                $timesheet->fill([
                    'jamLembur'   => $request["inputUbahJamLembur".$id],
                ]);
            }

            if(!empty($request["inputUbahJamPulang".$id])) {
                $timesheet->fill([
                    'jamPulang'   => $request["inputUbahJamPulang".$id],
                ]);
            }

            

            

            // if(!empty($request["inputKeteranganPulang".$id])) {
            //     $timesheet->fill([
            //         'keterangan_pulang'   => $request["inputKeteranganPulang".$id],
            //     ]);
            // }

            

            $timesheet->update();

            return redirect()->route('dashboard.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Throwable $th) {
            // echo "data gagal Disimpan";

            // dd($th);
            return redirect()->route('dashboard.index')->with(['error' => 'Data gagal Disimpan!']);
        }
        

    }

    public function destroyDcuTimesheet(Request $request, $dcurecap_id): RedirectResponse
    {

        // dd($dcurecap_id);

        try {

            $timesheet = Timesheet::where('dcurecap_id', $dcurecap_id)->first();
            $dcurecap = Dcurecap::where('id', $dcurecap_id)->first();

            // delete record
            if($timesheet != null) {
                $timesheet->delete();
            }

            if($dcurecap != null) {
                $dcurecap->delete();
            } else {
                return redirect()->route('dashboard.index')->with(['info' => 'Tidak Ada Data Yang Dihapus!']);
                exit;
            }
            
            

            return redirect()->route('dashboard.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.index')->with(['error' => 'Data Gagal Dihapus!']);
        }

        

    } 

    

    public function handleSession(Request $request)
    {
        // Session::forget('nama');
        // Session::forget('umur');
        
        // $nama = $request->input('nama');
        // $umur = $request->input('umur');
        $isHiddenBtnDCU = $request->input('isHiddenBtnDCU');
        $dateThisDay = $request->input('dateThisDay');
        // echo "tanggal skrng itu : " . $dateThisDay;

        // if(!empty(Session::get('nama'))) {
            // Session::forget('nama');
        // }

        // Session::put('nama' , $nama);
        // Session::put('umur' , $umur);
        Session::put('isHiddenBtnDCU' , $isHiddenBtnDCU);
        // Session::put('dateThisDay' , $dateThisDay);
        // $dateThisDay = "2024-07-13";
        // Session::put('dateThisDay' , "2024-07-13");
        // Session::forget('dateYesterday');
        /////////////////////////////////////////////////////////////
        
        // \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        if((Session::get('dateThisDay')) == $dateThisDay)  { //masih hari yg sama
                // Session::forget('resetTimesheet');
                Session::put('resetTimesheet' , 'false');
                
                // if(Session::put('dateYesterday') != $dateThisDay) {
                // Session::forget('dateThisDay');
                Session::put('dateThisDay' , $dateThisDay);
                // }
            
            // echo Session::get('dateThisDay');
            // echo "masih hari yg sama";
            // echo "skgn brok : ". Session::get('dateThisDay');
        } 
        else {
            // Session::forget('resetTimesheet');
            Session::put('resetTimesheet' , 'true');
        //     Session::put('dateThisDay' , $dateThisDay);
        }
        // echo Session::get('dateThisDay');
        // echo "<br>";
        // echo Session::get('umur');
        // Session::forget('nama');
        // if ($request->session()->has('nama') && $request->session()->has('umur')) {
        //     Session::forget('nama');
        //     Session::put('nama' , 'mico');
            
        //     // Session::put('umur' , $umur);
        //     // echo $session::get('umur');
        //     // echo "yes sudah";
        //     echo Session::get('nama') . " tak ada ya";
        // }

        // echo session('nama');
        // echo $nama;
        // echo $umur;
        

        // // Store data in Laravel session
        // // session(['nama' => $nama]);
        // // Session::put(['nama' => $nama, 'umur' => $umur]);
        
        // Session::put('nama' , $nama);
        // Session::put('umur' , $umur);

        // return response::json(['resetTimesheet' => Session::get('resetTimesheet')]);
        $resetTimesheet = Session::get('resetTimesheet');
        // return response()->json([
        //     'resetTimesheet' => $resetTimesheet,
        // ]);
        // aktifin lagi
        return Response::json(['resetTimesheet' => $resetTimesheet], 200);
        
        // $response = response()->json([
        //     'data' => $data
        // ], 200);
        // $response->header('Content-Type', 'application/vnd.api+json');
        // return $response;
    }

    public function updateDateSession(Request $request)
    {
        $dateThisDay = $request->input('dateThisDay');
        // $dateThisDay = "2024-07-07";

        Session::put('dateYesterday' , Session::get('dateThisDay'));
        Session::put('dateThisDay' , $dateThisDay);
        Session::save();

        
            
            
        echo " kemarin " . Session::get('dateYesterday');
    }

    public function updatePulangSession(Request $request, $id) {
        $key = 'isPulang'.$id; 
        // echo "ini key " . $key; 
        $value = $request->input('isPulang');
        Session::put($key , $value);
    }




}
