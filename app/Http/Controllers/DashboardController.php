<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        if (auth()->user()->level === 'siswa') {
            return redirect('/siswa-history');
        }

        return view('dashboard.index', [
            'title'     => 'Dashboard',
            'active'    => 'dashboard'
        ]);
    }
}
