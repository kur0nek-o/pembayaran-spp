<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Petugas;

class DashboardController extends Controller
{
    public function index() {
        if (auth()->user()->level === 'siswa') {
            return redirect('/siswa-history');
        }

        return view('dashboard.index', [
            'title'     => 'Dashboard',
            'active'    => 'dashboard',
            'siswa'     => Siswa::all()->count(),
            'kelas'     => Kelas::all()->count(),
            'petugas'   => Petugas::all()->count()
        ]);
    }
}
