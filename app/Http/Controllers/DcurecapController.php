<?php

namespace App\Http\Controllers;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

use App\Models\Manpower;
use App\Models\Dcurecap;

use Session;

class DcurecapController extends Controller
{
     /**
     * index
     * @return View
     */
    public function index() : View
    {
        //get data rekap dcu
        // $data = Manpower::with('dcurecap')->get();

        $thisDay = Session::get('dateThisDay');

        $data = Manpower::with(['dcurecap' => function ($query) use ($thisDay){
            $query->where('tanggal', $thisDay); // replace 'column_name' and 'value' with your condition
        }])->get();
        
        //render view with posts
        return view('dcu_recap.index', ["dataManpower" => $data]);
    }

    public function store(Request $request) : View
    {
        $inputDatePickerRekapDcu = $request->inputDatePickerRekapDcu;

        $data = Manpower::with(['dcurecap' => function ($query) use ($inputDatePickerRekapDcu) {
                $query->where('tanggal', $inputDatePickerRekapDcu); // replace 'column_name' and 'value' with your condition
            }])->get();

        return view('dcu_recap.index', ["dataManpower" => $data, "date" => $inputDatePickerRekapDcu]);
    }

    // public function getDataTableDcurecapByMonth()
    public function getDataTableDcurecapByMonth(Request $request)
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

        
        // for($day = 1; $day <= 31; $day++) {
        //     foreach($data->where('manpower_id', 4) as $dataDCU){
        //         if($day <= 9) {
        //             // $dayDecimal = '0'.$day;
        //             $dayDecimal = str_pad($day, 2, '0', STR_PAD_LEFT);
        //             // print_r($dataDCU->tanggal . '<br>');
        //             // if (preg_match('/^\d{4}-\d{2}-' . $dayDecimal . '$/', $dataDCU->tanggal)) {
        //             // $pattern = '/^\d{4}-\d{2}-13$/';
        //             $pattern = '/^\d{4}-\d{2}-'.$dayDecimal.'$/';
        //             // print_r($pattern.'<br>');
        //             // $subject = '2024-07-13';
        //             $subject = $dataDCU->tanggal;

        //             if (preg_match($pattern, $subject)) {
        //                 print_r($dayDecimal.' : '.$dataDCU->status_dcu.'<br>');
        //                 $day++;
        //             }
                    
                    
                    
        //         } else {
        //             $pattern = '/^\d{4}-\d{2}-'.$day.'$/';
        //             // print_r($pattern.'<br>');
        //             // $subject = '2024-07-13';
        //             $subject = $dataDCU->tanggal;

        //             if (preg_match($pattern, $subject)) {
        //             // if($dataDCU->tanggal == '^\d{4}-\d{2}-'.$day.'$') {
        //                 print_r($day.' : '.$dataDCU->status_dcu.'<br>');
        //                 $day++;
        //             }
        //         }
        //     }
            
        //     print_r($day. ' : '.'<br>');
        // }

        return view('dcu_recap.table', ["data" => $data, "dataManpower" => $dataManpower, "monthYear" => $monthYear]);
    }
}
