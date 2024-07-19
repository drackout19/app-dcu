<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionStorageController extends Controller
{
    public function handleSession(Request $request)
    {
        // Session::forget('nama');
        // Session::forget('umur');
        
        $nama = $request->input('nama');
        $umur = $request->input('umur');

        // if(!empty(Session::get('nama'))) {
        //     // Session::forget('nama');
        // }

        if ($request->session()->has('nama')) {
            // $request->session()->pull('nama', $nama);
            // Session::put('nama' , $nama);
            session('nama', $nama);
        }

        echo session('nama');
        // echo $nama;

        // // Store data in Laravel session
        // // session(['nama' => $nama]);
        // // Session::put(['nama' => $nama, 'umur' => $umur]);
        
        // Session::put('nama' , $nama);
        // Session::put('umur' , $umur);

        // return response()->json(['message' => 'Data received', 'nama' => $nama]);
    }
}
