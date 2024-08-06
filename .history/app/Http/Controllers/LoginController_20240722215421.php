<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function postLogin(Request $request)
    {
        // dd($request->all());
        if(Auth::attempt($request->only('id_badge', 'password'))) {
            // return redirect('admin');
            // dd(Auth::user()->level);exit;
            // dd(Auth::user()->level);exit;
            // if(Auth::check() && Auth::user()->level === 'hrd') {

            //     // dd("yes admin");exit;
            //     return redirect('/admin/dashboard');
            // } 

            // if(Auth::check() && Auth::user()->level === 'admin') {

            //     // dd("yes admin");exit;
            //     return redirect('/admin/dashboard');
            // } 

            if(Auth::check() && Auth::user()->level === 'pekerja') {
                // dd("yes pekerja");exit;
                return redirect('pekerja');
            }
        }

        

        return redirect('login');
    }

    public function postLoginStaff(Request $request)
    {
        // dd($request->all());
        if(Auth::attempt($request->only('nama_staff', 'password'))) {
            // return redirect('admin');
            // dd(Auth::user()->level);exit;
            // dd(Auth::user()->level);exit;
            if(Auth::check() && Auth::user()->level === 'keuangan') {

                // dd("yes admin");exit;
                return redirect('/admin/dashboard');
            } 

            if(Auth::check() && Auth::user()->level === 'hrd') {

                // dd("yes admin");exit;
                return redirect('/admin/dashboard');
            } 

            if(Auth::check() && Auth::user()->level === 'admin') {

                // dd("yes admin");exit;
                return redirect('/admin/dashboard');
            }
        }

        

        return redirect('login-staff');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
