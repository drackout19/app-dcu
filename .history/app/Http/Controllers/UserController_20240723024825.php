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

use App\Models\User;

class UserController extends Controller
{

    public function index($id)
    {

        $user = User::where
        return view('akun.index');
    }
   
}
