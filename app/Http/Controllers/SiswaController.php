<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\Siswa;

class SiswaController extends Controller
{
    public function index()
    {
        return view('siswa.login');
    }

    public function Dashboard()
    {
        return view('siswa.index');
    }

    protected function guard()
    {
        return Auth::guard();
    }

    public function Login(Request $request)
    {
        // dd($request->all());

        // $credentials = $request->validate([
        //     'nisn' => [ 'required', 'nisn'],
        //     'password' => [ 'required'],
        //     ]);
        //     if (Auth:: attempt($credentials)) {
        //     $request->session()->regenerate();
        //     return redirect('siswa.dashboard');
        //     }
        //     return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.', ])->onlyInput('nisn');

        $check = $request->all();
        if(Auth::guard('siswa')->attempt(['nisn' => $check['nisn'], 'password' => $check['password']  ])){
            $request->session()->regenerate();
            return redirect()->route('siswa.dashboard')->with('error', 'Siswa Login Berhasil');
        }
        else{
            return back()->with('error', 'username atau passwordnya salah');
        }
    }

}
