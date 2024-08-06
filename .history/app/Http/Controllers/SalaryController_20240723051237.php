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
use Auth;

use Session;


use App\Models\Manpower;
use App\Models\Dcurecap;
use App\Models\Timesheet;
use App\Models\Salary;
use App\Models\ConfirmSalary;

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
        // $dataManpower = Manpower::with('salary')->with('dcurecap')->get();
        // debug

        
        
        $monthYear = Date('F Y');

        // $monthYear = 'January 2024';

        // dd($monthYear);exit;

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

        // dd($pattern);

        $dataManpower = Manpower::with('salary')->with(['dcurecap' => function ($query) use ($pattern) {
            // $pattern = '2024-07-\d{2}$';
            // $pattern = $pattern;
            $query->whereRaw('tanggal REGEXP ?', [$pattern]);
        }])->get();
        //enddebug
        // $dataTimesheet = Timesheet::with('dcurecap')->get();
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
        // return view('gaji_recap.index', ["manpowers" => $dataManpower, "dataTimesheet" => $dataTimesheet]);
        $monthYear = $year.'-'.$monthName;
        return view('gaji_recap.index', ["manpowers" => $dataManpower, "monthYear" => $monthYear]);
    }

    public function indexPerson($id) : View
    {
        //get posts
        // $data = [['title'=>'Manpower']];
        // dd(Session::get('dateThisDay'));
        // $dataManpower = Manpower::with('salary')->with('dcurecap')->get();
        // debug

        
        
        $monthYear = Date('F Y');

        // $monthYear = 'January 2024';

        // dd($monthYear);exit;

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

        // dd($pattern);

        $dataManpower = Manpower::where('id',$id)->with('salary')->with(['dcurecap' => function ($query) use ($pattern) {
            // $pattern = '2024-07-\d{2}$';
            // $pattern = $pattern;
            $query->whereRaw('tanggal REGEXP ?', [$pattern]);
        }])->get();
        //enddebug
        // $dataTimesheet = Timesheet::with('dcurecap')->get();
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
        // return view('gaji_recap.index', ["manpowers" => $dataManpower, "dataTimesheet" => $dataTimesheet]);
        $monthYear = $year.'-'.$monthName;
        
        return view('gaji_recap.index', ["manpowers" => $dataManpower, "monthYear" => $monthYear]);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @return RedirectResponse
     */

    

    public function getViewIndexSlipGajiByMonthYear(Request $request) : View
    {
        //get posts
        // $data = [['title'=>'Manpower']];
        // dd(Session::get('dateThisDay'));
        // $dataManpower = Manpower::with('salary')->with('dcurecap')->get();
        // debug

        // dd($request);exit;

      
        $monthYear = $request->monthYear;

        // $monthYear = 'January 2024';

        // dd($monthYear);exit;

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

        // dd($pattern);

        $dataManpower = Manpower::with('salary')->with(['dcurecap' => function ($query) use ($pattern) {
            // $pattern = '2024-07-\d{2}$';
            // $pattern = $pattern;
            $query->whereRaw('tanggal REGEXP ?', [$pattern]);
        }])->get();
        if(Auth::user()->level == 'pekerja') {
            $dataManpower = Manpower::where('id', Auth::user()->manpower_id)->with('salary')->with(['dcurecap' => function ($query) use ($pattern) {
                // $pattern = '2024-07-\d{2}$';
                // $pattern = $pattern;
                $query->whereRaw('tanggal REGEXP ?', [$pattern]);
            }])->get();
        }
        //enddebug
        // $dataTimesheet = Timesheet::with('dcurecap')->get();
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
        // return view('gaji_recap.index', ["manpowers" => $dataManpower, "dataTimesheet" => $dataTimesheet]);
        $monthYear = $year.'-'.$monthName;
        return view('gaji_recap.tableSlipGajiByMonth', ["manpowers" => $dataManpower, "monthYear" => $monthYear]);
    }

    public function show($id, string $monthYear): View
    {
        // dd($monthYear);
        // $monthYear = strval($monthYear);
        // $monthYear = "July 2024";
        // dd($monthYear);
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

        // dd($dataSalary->jumlah_gaji_Bersih);exit;

        //render view with post
        
        return view('gaji_recap.detailSlipGaji', ["dataSalary" => $dataSalary, "arrDataTimesheet" => $arrDataTimesheet, "id" => $id, "monthYear" => $monthYear]);
        
    }




    public function getSlipGajiPerson(Request $request) {

        //get post by ID
        // $dataSalary = Salary::findOrFail($id)->first();
        $dataSalary = Salary::where('manpower_id', $request->id)->with('timesheet')->first();
        $confirmSalaryPerson = ConfirmSalary::where('salary_id', $dataSalary->id)->first();


        // $dataManpower = Manpower::find($request->id)->get();

        
        
        

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

        if($dataSalary != null) {

        

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
            $total_gaji_bersih = $dataSalary->jumlah_gaji_bersih+$total_gaji_lembur;
            // exit;

            // $dataSalary->update(['jumlah_gaji_lembur' => $total_gaji_lembur]);

            $arrDataTimesheet = [
                "totalHariMasuk" =>  count($dataSalary->timesheet),
                "totalJamLembur" => $totalJamLembur,
            ];
        }
        // data-------------------------------------------------------

        $dataManpower = Manpower::find($request->id);



        if($confirmSalaryPerson->status_gaji == false) {
            // return "<h5 class='text-center text-danger'>Slip gaji belum dapat ditampilkan, karena belum di-approve oleh bagian finance</h5>";
            return '<div class="card"><div class="card-body text-danger">Slip gaji belum dapat ditampilkan, karena belum di-approve.</div></div>';
        } else {
            return view('gaji_recap.templateSlipGaji', ["dataSalary" => $dataSalary, "arrDataTimesheet" => $arrDataTimesheet, "dataManpower" => $dataManpower, "monthYear" => $request->monthYear]);
        }

        // return view('gaji_recap.templateSlipGaji', ["dataSalary" => $dataSalary, "arrDataTimesheet" => $arrDataTimesheet, "dataManpower" => $dataManpower, "monthYear" => $request->monthYear]);

        
    }

    public function getDataTableTimesheetPerson(Request $request) {
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

    public function getDataTablePendapatanPerson(Request $request) {

        $dataSalary = Salary::where('manpower_id', $request->id)->with('manpower')->first();
        $confirmSalaryPerson = ConfirmSalary::where('salary_id', $dataSalary->id)->first();

        return view('gaji_recap.tablePendapatanPerson', ["dataSalary" => $dataSalary, "confirmSalaryPerson" => $confirmSalaryPerson]);

        // return "<h1>njnj</h1>";
    }

    public function updatePendapatanGaji(Request $request)
    {
        $dataSalaryPerson = Salary::where('manpower_id', $request->id)->first();

        try {
            $dataSalaryPerson->fill([
                "jumlah_gaji_harian" => $request->jumlahGajiHarian,
                "jumlah_gaji_lembur" => $request->jumlahGajiLembur,
                // "jumlah_gaji_bersih" => $request->jumlahGajiBersih,
            ]);

            $dataSalaryPerson->update();

            // Prepare the redirect URL
            $redirectUrl = route('rekap-slip-gaji.show', ['id' => $request->id, 'monthYear' => $request->monthYear]);

            session()->flash('success', 'Data Berhasil Diupdate!');

            return response()->json(['redirect' => $redirectUrl]);

            // return redirect()->route('/rekap-slip-gaji')->with(['success' => 'Data Berhasil Disimpan!']);
            // return "redirect()->route('rekap-slip-gaji.show', ['id'=>$id, 'monthYear' => $monthYear])->with(['success' => 'Data Berhasil Disimpan!'])";
        } catch (\Throwable $th) {

            $redirectUrl = route('rekap-slip-gaji.show', ['id' => $request->id, 'monthYear' => $request->monthYear]);

            session()->flash('error', 'Data Gagal Diupdate!');

            return response()->json(['redirect' => $redirectUrl]);
            // echo "data gagal Disimpan";
            // return redirect()->route('/rekap-slip-gaji')->with(['error' => 'Data gagal Disimpan!']);
        }
        
        // echo $request->id;
        // echo $request->jumlahGajiHarian;
        // echo $request->jumlahGajiLembur;
        // echo $request->jumlahGajiBersih;

        // return view('/dashboard');
    }

    public function approvePendapatanGajiByHRD(Request $request)
    {
        $dataSalaryPerson = Salary::where('manpower_id', $request->id)->first();
        $confirmSalaryPerson = ConfirmSalary::where('salary_id', $dataSalaryPerson->id)->first();

        try {
            $dataSalaryPerson->fill([
                "jumlah_gaji_harian" => $request->jumlahGajiHarian,
                "jumlah_gaji_lembur" => $request->jumlahGajiLembur,
                "jumlah_gaji_bersih" => $request->jumlahGajiBersih,
            ]);

            $dataSalaryPerson->update();

            $confirmSalaryPerson->update([
                "konfirmasi_hrd" => true
            ]);

            // Prepare the redirect URL
            $redirectUrl = route('rekap-slip-gaji.show', ['id' => $request->id, 'monthYear' => $request->monthYear]);

            session()->flash('success', 'Approve Gaji Pekerja Berhasil!');

            return response()->json(['redirect' => $redirectUrl]);

            // return redirect()->route('/rekap-slip-gaji')->with(['success' => 'Data Berhasil Disimpan!']);
            // return "redirect()->route('rekap-slip-gaji.show', ['id'=>$id, 'monthYear' => $monthYear])->with(['success' => 'Data Berhasil Disimpan!'])";
        } catch (\Throwable $th) {

            $redirectUrl = route('rekap-slip-gaji.show', ['id' => $request->id, 'monthYear' => $request->monthYear]);

            session()->flash('error', 'Approve Gaji Pekerja Gagal!');

            return response()->json(['redirect' => $redirectUrl]);
            // echo "data gagal Disimpan";
            // return redirect()->route('/rekap-slip-gaji')->with(['error' => 'Data gagal Disimpan!']);
        }
    }

    public function cancelApprovePendapatanGajiByHRD(Request $request)
    {
        $dataSalaryPerson = Salary::where('manpower_id', $request->id)->first();
        $confirmSalaryPerson = ConfirmSalary::where('salary_id', $dataSalaryPerson->id)->first();

        try {
            $dataSalaryPerson->fill([
                "jumlah_gaji_harian" => $request->jumlahGajiHarian,
                "jumlah_gaji_lembur" => $request->jumlahGajiLembur,
                "jumlah_gaji_bersih" => $request->jumlahGajiBersih-$request->jumlahGajiLembur,
            ]);

            $dataSalaryPerson->update();

            if($confirmSalaryPerson->konfirmasi_keuangan == false) {
                $confirmSalaryPerson->update([
                    "konfirmasi_hrd" => false
                ]);
            } else {
                // gagal kan karena sudah di approve oleh keuangan

                $redirectUrl = route('rekap-slip-gaji.show', ['id' => $request->id, 'monthYear' => $request->monthYear]);

                session()->flash('error', 'Gaji Sudah Diapperove oleh keuangan, tidak bisa di cancel!');

                return response()->json(['redirect' => $redirectUrl]);
                exit;
            }
            

            // Prepare the redirect URL
            $redirectUrl = route('rekap-slip-gaji.show', ['id' => $request->id, 'monthYear' => $request->monthYear]);

            session()->flash('success', 'Cancel Gaji Pekerja Berhasil!');

            return response()->json(['redirect' => $redirectUrl]);

            // return redirect()->route('/rekap-slip-gaji')->with(['success' => 'Data Berhasil Disimpan!']);
            // return "redirect()->route('rekap-slip-gaji.show', ['id'=>$id, 'monthYear' => $monthYear])->with(['success' => 'Data Berhasil Disimpan!'])";
        } catch (\Throwable $th) {

            $redirectUrl = route('rekap-slip-gaji.show', ['id' => $request->id, 'monthYear' => $request->monthYear]);

            session()->flash('error', 'Cancel Gaji Pekerja Gagal!');

            return response()->json(['redirect' => $redirectUrl]);
            // echo "data gagal Disimpan";
            // return redirect()->route('/rekap-slip-gaji')->with(['error' => 'Data gagal Disimpan!']);
        }
    }
    public function approvePendapatanGajiByKeuangan(Request $request)
    {
        $dataSalaryPerson = Salary::where('manpower_id', $request->id)->first();
        $confirmSalaryPerson = ConfirmSalary::where('salary_id', $dataSalaryPerson->id)->first();

        try {
            $dataSalaryPerson->fill([
                "jumlah_gaji_harian" => $request->jumlahGajiHarian,
                "jumlah_gaji_lembur" => $request->jumlahGajiLembur,
                "jumlah_gaji_bersih" => $request->jumlahGajiBersih,
            ]);

            $dataSalaryPerson->update();

            $confirmSalaryPerson->update([
                "konfirmasi_keuangan" => true,
                "status_gaji" => true,
                "tanggal_cetak" => null,
            ]);

            // Prepare the redirect URL
            $redirectUrl = route('rekap-slip-gaji.show', ['id' => $request->id, 'monthYear' => $request->monthYear]);

            session()->flash('success', 'Approve Gaji Pekerja Berhasil!');

            return response()->json(['redirect' => $redirectUrl]);

            // return redirect()->route('/rekap-slip-gaji')->with(['success' => 'Data Berhasil Disimpan!']);
            // return "redirect()->route('rekap-slip-gaji.show', ['id'=>$id, 'monthYear' => $monthYear])->with(['success' => 'Data Berhasil Disimpan!'])";
        } catch (\Throwable $th) {

            $redirectUrl = route('rekap-slip-gaji.show', ['id' => $request->id, 'monthYear' => $request->monthYear]);

            session()->flash('error', 'Approve Gaji Pekerja Gagal!');

            return response()->json(['redirect' => $redirectUrl]);
            // echo "data gagal Disimpan";
            // return redirect()->route('/rekap-slip-gaji')->with(['error' => 'Data gagal Disimpan!']);
        }
    }

    public function cancelApprovePendapatanGajiByKeuangan(Request $request)
    {
        $dataSalaryPerson = Salary::where('manpower_id', $request->id)->first();
        $confirmSalaryPerson = ConfirmSalary::where('salary_id', $dataSalaryPerson->id)->first();

        try {
            $dataSalaryPerson->fill([
                "jumlah_gaji_harian" => $request->jumlahGajiHarian,
                "jumlah_gaji_lembur" => $request->jumlahGajiLembur,
                "jumlah_gaji_bersih" => $request->jumlahGajiBersih-$request->jumlahGajiLembur,
            ]);

            $dataSalaryPerson->update();

            $confirmSalaryPerson->update([
                "konfirmasi_keuangan" => false,
                "status_gaji" => false,
                "tanggal_cetak" => null,
            ]);

            // Prepare the redirect URL
            $redirectUrl = route('rekap-slip-gaji.show', ['id' => $request->id, 'monthYear' => $request->monthYear]);

            session()->flash('success', 'Cancel Gaji Pekerja Berhasil!');

            return response()->json(['redirect' => $redirectUrl]);

            // return redirect()->route('/rekap-slip-gaji')->with(['success' => 'Data Berhasil Disimpan!']);
            // return "redirect()->route('rekap-slip-gaji.show', ['id'=>$id, 'monthYear' => $monthYear])->with(['success' => 'Data Berhasil Disimpan!'])";
        } catch (\Throwable $th) {

            $redirectUrl = route('rekap-slip-gaji.show', ['id' => $request->id, 'monthYear' => $request->monthYear]);

            session()->flash('error', 'Cancel Gaji Pekerja Gagal!');

            return response()->json(['redirect' => $redirectUrl]);
            // echo "data gagal Disimpan";
            // return redirect()->route('/rekap-slip-gaji')->with(['error' => 'Data gagal Disimpan!']);
        }
    }


}
