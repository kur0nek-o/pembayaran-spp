<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::latest()->paginate(5);

        return view( 'dashboard.manajemen_siswa.kelas.index', [
            'title'  => 'Kelas',
            'active' => 'manajemen-siswa',
            'sub'    => 'kelas',
            'kelas'  => $kelas,
            'index'  => $kelas->firstItem()
        ]);
    }

    public function _load( Request $request ) {
        if ( $request->ajax() ) {
            $kelas = Kelas::latest();
            
            if ( $request->keyword != null ) {
                $kelas = $kelas->where( 'nama_kelas', 'like', '%' . $request->keyword . '%' )
                        ->orWhere( 'kompetensi_keahlian', 'like', '%' . $request->keyword . '%' );
            }

            $kelas = $kelas->paginate(5);
            return view('dashboard.manajemen_siswa.kelas.table', [
                'kelas' => $kelas,
                'index' => $kelas->firstItem()
            ])->render();
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'nama_kelas'            => 'required|max:10|unique:kelas',
                'kompetensi_keahlian'   => 'required|max:50'
            ],
            [
                'nama_kelas.required'           => 'Nama kelas harus di isi',
                'nama_kelas.unique'             => 'Nama kelas sudah ada',
                'nama_kelas.max'                => 'Nama kelas tidak boleh lebih dari 10 karakter',
                'kompetensi_keahlian.required'  => 'Kompetensi keahlian harus di isi',
                'kompetensi_keahlian.max'       => 'Kompetensi keahlian tidak boleh lebih dari 50 karakter',
            ]
        );

        Kelas::create($validated);
        
        return response()->json([
            'status' => true,
            'msg'    => 'Kelas berhasil di tambahkan'
        ]);
    }

    public function show(Kelas $kelas)
    {
        //
    }

    public function edit(Kelas $kela)
    {
        return response()->json($kela);
    }

    public function update(Request $request, Kelas $kela)
    {
        $validationRules = [
            'kompetensi_keahlian'   => 'required|max:50'
        ];

        $validationMsg = [
            'nama_kelas.required'           => 'Nama kelas harus di isi',
            'nama_kelas.max'                => 'Nama kelas tidak boleh lebih dari 10 karakter',
            'kompetensi_keahlian.required'  => 'Kompetensi keahlian harus di isi',
            'kompetensi_keahlian.max'       => 'Kompetensi keahlian tidak boleh lebih dari 50 karakter',
        ];

        if ( $request->nama_kelas == $kela->nama_kelas ) {
            $validationRules['nama_kelas'] = 'required|max:10';
        } else {
            $validationRules['nama_kelas'] = 'required|max:10|unique:kelas';
            $validationMsg['nama_kelas.unique'] = 'Nama kelas sudah ada';
        }

        $validated = $request->validate( $validationRules, $validationMsg );
        Kelas::where( 'id_kelas', $request->id )->update( $validated );

        return response()->json([
            'status' => true,
            'msg'    => 'Data kelas berhasil diperbaharui'
        ]);
    }

    public function destroy(Kelas $kela)
    {
        Kelas::where( 'id_kelas', $kela->id_kelas )->delete();
        return response()->json([
            'status' => true,
            'msg'    => 'Data kelas berhasil dihapus'
        ]);
    }
}
