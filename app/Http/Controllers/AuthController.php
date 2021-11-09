<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        if (Auth::attempt(['kode_kelompok' => $request->kode_kelompok, 'password' => $request->password])) {
            return redirect('/dashboard');
        } else {
            return redirect()->back();
        };
    }

    public function tbh_kelompok()
    {
        return view('admin.tambah.tbh_kelompok');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelompok' => 'required|min:3',
            'kode_kelompok' => 'required|min:4',
            'password' => 'required|min:4'
        ]);

        $user = new User;
        $user->kode_kelompok = $request->kode_kelompok;
        $user->password = bcrypt($request->password);
        $user->nama_kelompok = $request->nama_kelompok;

        $user->save();

        return redirect('/tbh_kelompok')->with('sukses_kel', 'Kelompok Baru Berhasil Di Tambahkan');
    }


    public function ganti_pass(Request $request)
    {

        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:5|confirmed'
        ]);

        $cekPassword = auth()->user()->password;

        $old_password = $request->old_password;

        if (Hash::check($old_password, $cekPassword)) {
            $kelompok = Auth::user();
            $kelompok->password = bcrypt($request->get('password'));
            $kelompok->save();

            return back()->with('update_pas', 'Password Berhasil Di Upgrade');
        } else {
            return back()->with('gagal', 'Password Gagal Di Upgrade');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
