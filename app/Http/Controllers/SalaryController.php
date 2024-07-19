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

class SalaryController extends Controller
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
        $dataManpower = Manpower::with('salary')->get();
        // $dataSalary = Salary::with('manpower')->first();
        // $dataManpower1 = Manpower::find(1)->first();
        // dd($dataManpower1->id);

        // dd($dataManpower[0]->salary->no_rekening);

        // $dcurecap = Dcurecap::where('tanggal', '2024-07-08');
        // $timesheets = Dcurecap::where('tanggal', '2024-07-08');
        // $dcurecap = Dcurecap::all();
        // $timesheet =  Timesheet::where('tanggal', '2024-07-08')->get();
        //render view with posts
        // return view('dashboard.index', ["manpowers" => $dataManpower, "dcurecap" => Dcurecap::all(), "timesheet" => Timesheet::all()]);
        return view('gaji_recap.index', ["manpowers" => $dataManpower]);
    }

    public function show($id): View
    {
        //get post by ID
        // $dataSalary = Salary::findOrFail($id)->first();
        $dataSalary = Salary::where('manpower_id', $id)->with('timesheet')->first();
        // $dataManpower = Manpower::find($id)->get();

        
        
        

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

        foreach($dataSalary->timesheet as $data) {
            $time1 = parseTime($totalJamLembur);
            $time2 = parseTime($data->totalWaktuLembur);

            // Calculate total time in minutes
            // $totalMinutes = $time1 + $time2;
            $totalJamLembur = $time1 + $time2;

        }

        list($totalHours, $totalMinutes) = convertMinutesToHoursAndMinutes($totalJamLembur);

        // // Print the result
        // echo "Total time: {$totalHours} hours {$totalMinutes} minutes";
        // echo '<br>';
        
        // echo $totalHours*$dataSalary->gaji_lembur;

        $totalJamLembur = $totalHours;
        $total_gaji_lembur = $totalHours*$dataSalary->gaji_lembur;
        // exit;

        $arrDataTimesheet = [
            "totalHariMasuk" =>  count($dataSalary->timesheet),
            "totalJamLembur" => $totalJamLembur,
            "jumlah_gaji_lembur" => $total_gaji_lembur
        ];

        // data-------------------------------------------------------

        $dataManpower = Manpower::find($id)->get();

        // dd($arrDataTimesheet["jumlahHariMasuk"]);

        // dd($dataSalary->jumlah_gaji_harian);exit;

        //render view with post
        
        return view('gaji_recap.detailSlipGaji', ["dataSalary" => $dataSalary, "arrDataTimesheet" => $arrDataTimesheet, "id" => $id]);
        
    }

    public function getSlipGajiPerson(Request $request) {

        //get post by ID
        // $dataSalary = Salary::findOrFail($id)->first();
        $dataSalary = Salary::where('manpower_id', $request->id)->with('timesheet')->first();
        // $dataManpower = Manpower::find($id)->get();

        
        
        

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

        foreach($dataSalary->timesheet as $data) {
            $time1 = parseTime($totalJamLembur);
            $time2 = parseTime($data->totalWaktuLembur);

            // Calculate total time in minutes
            // $totalMinutes = $time1 + $time2;
            $totalJamLembur = $time1 + $time2;

        }

        list($totalHours, $totalMinutes) = convertMinutesToHoursAndMinutes($totalJamLembur);

        // // Print the result
        // echo "Total time: {$totalHours} hours {$totalMinutes} minutes";
        // echo '<br>';
        
        // echo $totalHours*$dataSalary->gaji_lembur;

        $totalJamLembur = $totalHours;
        $total_gaji_lembur = $totalHours*$dataSalary->gaji_lembur;
        // exit;

        $arrDataTimesheet = [
            "totalHariMasuk" =>  count($dataSalary->timesheet),
            "totalJamLembur" => $totalJamLembur,
            "jumlah_gaji_lembur" => $total_gaji_lembur
        ];

        // data-------------------------------------------------------

        $dataManpower = Manpower::find($request->id)->get();

        return view('gaji_recap.templateSlipGaji', ["dataSalary" => $dataSalary, "arrDataTimesheet" => $arrDataTimesheet]);
    }

    public function getDataTableTimesheetPerson(Request $request) {
        // echo $request->monthYear;
        // exit;
        $monthYear = "July 2024";
        // $monthYear = $request->monthYear;
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
        // $dataManpower = Manpower::all();
        // dd($$request->id);
        $dataManpower = Manpower::where('id', $request->id)->get();
        $dataTimesheets = Timesheet::all();
        // $dataTimesheets = Timesheet::with('dcurecap')->get();

        // dd($dataTimesheets[0]->dcurecap->tanggal);
        // dd(($dataTimesheets->where('dcurecap_id', 14)->first()) == null);

        return view('gaji_recap.tableAbsensiPerson', ["data" => $data, "dataManpower" => $dataManpower, "timesheets" => $dataTimesheets,"monthYear" => $monthYear]);
    }

    public function getDataTableLemburPerson(Request $request) {
        // echo $request->monthYear;
        // exit;
        $monthYear = "July 2024";
        // $monthYear = $request->monthYear;
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
        // $dataManpower = Manpower::all();
        // dd($$request->id);
        $dataManpower = Manpower::where('id', $request->id)->get();
        $dataTimesheets = Timesheet::all();
        // $dataTimesheets = Timesheet::with('dcurecap')->get();

        // dd($dataTimesheets[0]->dcurecap->tanggal);
        // dd(($dataTimesheets->where('dcurecap_id', 14)->first()) == null);

        return view('gaji_recap.tableLemburPerson', ["data" => $data, "dataManpower" => $dataManpower, "timesheets" => $dataTimesheets,"monthYear" => $monthYear]);
    }
    
    public function getDataTableGajiPerson(Request $request) {

        $dataSalary = Salary::where('manpower_id', $request->id)->with('manpower')->first();
        // $dataSalary = Salary::all()->get();

        return view('gaji_recap.tableGajiPerson', ["dataSalary" => $dataSalary]);
    }


}
