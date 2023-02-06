<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
    public function _validateRequest( Request $request ) {
        $credentials = $request->validate(
            [
                'username'  => 'required',
                'password'  => 'required'
            ],
            [
                'username.required' => 'Username tidak boleh kosong',
                'password.required' => 'Password tidak boleh kosong'
            ]
        );

        if ( Auth::attempt($credentials) ) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
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