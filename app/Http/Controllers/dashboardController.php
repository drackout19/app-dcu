<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardController extends Controller
{
    //
    public function index() 
    {
        return redirect('dashboard');
    }

    public function pekerja() 
    {
        return redirect('rekap-slip-gaji');
    }

}
