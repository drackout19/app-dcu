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
use App\Models\Timesheet;

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
        $dataManpower = Manpower::with('dcurecap')->get();
        //render view with posts
        return view('dashboard.index', ["manpowers" => $dataManpower, "dcurecap" => Dcurecap::all()]);
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
     * store
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */

    public function storeTimesheet(Request $request, $id): RedirectResponse
    {
        try {
            $timesheet = new Timesheet();

            // $date = "inputDate".$id;
            // echo $id;
            // echo $request["inputDate".$id];
            // echo $request->inputSuhuBadan4;
            // echo $request->kontol;
            // echo $request["inputJamMasuk".$id];
            // echo "<br>";
            // echo $request["inputJamLembur".$id];
            // echo "<br>";
            // echo $request["inputJamPulang".$id];
            // exit;

            $timesheet->fill([
                'dcurecap_id' => $id,
                'jamMasuk'   => $request["inputJamMasuk".$id]
                
            ]);

            // if(!empty($request["inputJamMasuk".$id])) {
            //     $timesheet->fill([
            //         'jamMasuk'   => $request["inputJamMasuk".$id]
            //     ]);
            // }
            
            if(!empty($request["inputJamLembur".$id])) {
                $timesheet->fill([
                    'jamLembur'   => $request["inputJamLembur".$id],
                ]);
            }

            if(!empty($request["inputJamPulang".$id])) {
                $timesheet->fill([
                    'jamPulang'   => $request["inputJamPulang".$id],
                ]);
            }

            

            $timesheet->save();

            return redirect()->route('dashboard.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Throwable $th) {
            // echo "data gagal Disimpan";
            return redirect()->route('dashboard.index')->with(['error' => 'Data gagal Disimpan!']);
        }
        

    }


}
