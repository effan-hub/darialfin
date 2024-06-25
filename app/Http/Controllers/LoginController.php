<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('login.index');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'user' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (auth()->user()->role == 'admin') {
                session([
                    'nama' => auth()->user()->user,
                    'foto' => 'dist/img/opp.jpeg'
                ]);
            } else {
                $mahasiswa = Mahasiswa::find($credentials['user'], ['nama', 'foto']);
                session([
                    'nama' => $mahasiswa['nama'],
                    'foto' => 'storage/' . $mahasiswa['foto']
                ]);
            }

            return redirect()->intended('/');
        }

        return back()->with('loginError', 'Login Gagal (user atau password salah)');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->forget((['nama', 'foto']));
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
