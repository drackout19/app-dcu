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

class DcurecapController extends Controller
{
     /**
     * index
     *
     * @return View
     */
    public function index() : View
    {
        //get data rekap dcu
        $data = Manpower::with('dcurecap')->get();
        // echo $data->count();
// .' °C'
        //render view with posts
        return view('dcu_recap.index', ["dataManpower" => $data]);
    }
}
