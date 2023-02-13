<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petugas;

class LoadController extends Controller
{
    public function _load( Request $request ) {
        if ( $request->ajax() ) {
            $petugas = Petugas::_Join();
            
            if ( $request->keyword != null ) {
                $petugas = $petugas->where( 'nama_petugas', 'like', '%' . $request->keyword . '%' )
                        ->orWhere( 'username', 'like', '%' . $request->keyword . '%' );
            }

            $petugas = $petugas->latest()->paginate(5);
            return view('menu.petugas.table', [
                'petugas' => $petugas,
                'index'   => $petugas->firstItem()
            ])->render();
        }
    }
}
