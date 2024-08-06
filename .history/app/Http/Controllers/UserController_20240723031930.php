<?php

namespace App\Http\Controllers;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use Auth;

use App\Models\Manpower;

use App\Models\User;




class UserController extends Controller
{

    public function index($id)
    {

        $user = User::where('manpower_id',  Auth::user()->manpower_id)->first();

        // dd($user->level);
        return view('akun.index', ["user" => $user]);
    }

    public function updateAkunPekerja(Request $request, $id) : redirectResponse
    {
        // $user = User::find($id);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('akunPekerja', ["id" =>  $id])->with(['error' => 'Data gagal Diubah!']);
        }

        // $user->password = Hash::make($request->new_password);
        // $user->save();

        // dd($user->password);
        // dd($request->inputPasswordLama);
        // dd($request->inputPasswordBaru);
        // dd($request->inputKonfirmasiPasswordBaru);

    }
   
}
