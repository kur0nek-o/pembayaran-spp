<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
    public function _validateRequest( Request $request ) {
        $credentials = $request->validate(
            [
                'username'  => 'required|max:25',
                'password'  => 'required|max:25'
            ],
            [
                'username.required' => 'Username tidak boleh kosong',
                'username.max'      => 'Username tidak boleh lebih dari 25 karakter',
                'password.required' => 'Password tidak boleh kosong',
                'password.max'      => 'Password tidak boleh lebih dari 25 karakter'
            ]
        );

        if ( Auth::attempt($credentials) ) {
            $request->session()->regenerate();

            if (auth()->user()->level != 'siswa') {
                return redirect()->intended('/dashboard');
            }
            return redirect()->intended('/siswa-history');
        }

        return back()->with( 'invalidMessage', 'Gagal login periksa username dan password' )->onlyInput( 'username' );
    }

    public function logout(Request $request) {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}
