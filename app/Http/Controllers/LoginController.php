<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login_proses(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($data)) {
            $user = Auth::user();

            if ($user->role === 'bendahara') {
                return redirect()->route('dashboard'); // /dashboard
            } elseif ($user->role === 'kepala sekolah') {
                return redirect()->route('kepsek.dashboard'); // /kepsek/dashboard
            } else {
                return redirect('/'); // fallback kalau role-nya tidak dikenali
            }
        } else {
            return redirect()->route('login')->with('failed', 'Email atau password salah');
        }
    }
}
