<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Spp;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $data = Siswa::_join()->latest()->paginate(5);

        return view( 'dashboard.manajemen_siswa.siswa.index', [
            'title'  => 'Siswa',
            'active' => 'manajemen-siswa',
            'sub'    => 'siswa',
            'siswa'  => $data,
            'index'  => $data->firstItem()
        ]);
    }

    public function _load(Request $request) {
        if ( $request->ajax() ) {
            $data = Siswa::_join();
            
            if ( $request->keyword != null ) {
                $data = $data->where( 'nisn', 'like', '%' . $request->keyword . '%' )
                        ->orWhere( 'nis', 'like', '%' . $request->keyword . '%' )
                        ->orWhere( 'nama', 'like', '%' . $request->keyword . '%' )
                        ->orWhere( 'nama_kelas', 'like', '%' . $request->keyword . '%' );
            }

            $data = $data->latest()->paginate(5);
            return view('dashboard.manajemen_siswa.siswa.table', [
                'siswa' => $data,
                'index' => $data->firstItem()
            ])->render();
        }
    }

    public function create()
    {
        return view( 'dashboard.manajemen_siswa.siswa.create', [
            'title'  => 'Siswa',
            'active' => 'manajemen-siswa',
            'sub'    => 'siswa',
            'kelas'  => Kelas::all(),
            'spp'    => Spp::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'nama'      => 'required|max:35',
                'nisn'      => 'required|size:10|unique:siswas',
                'nis'       => 'required|size:8|unique:siswas',
                'kelas_id'  => 'required',
                'spp_id'    => 'required',
                'no_telp'   => 'required|max:13',
                'alamat'    => 'required'
            ],
            [
                'nama.required'     => 'Nama siswa harus di isi',
                'nama.max'          => 'Nama tidak boleh lebih dari 35 karakter',
                'nisn.required'     => 'NISN harus di isi',
                'nisn.size'         => 'NISN harus berjumlah 10 karakter',  
                'nisn.unique'       => 'NISN sudah terdaftar',
                'nis.required'      => 'NIS harus di isi',
                'nis.size'          => 'NIS harus berjumlah 8 karakter',  
                'nis.unique'        => 'NIS sudah terdaftar',
                'kelas_id.required' => 'Kelas harus di isi',
                'spp_id.required'   => 'Spp harus di isi',
                'no_telp.required'  => 'Nomor telpon harus di isi',
                'no_telp.max'       => 'Nomor telpon tidak boleh lebih dari 13 karakter',
                'alamat.required'   => 'Alamat harus di isi'
            ]
        );

        Siswa::create($validated);
        return redirect('/siswa')->with( 'successMessage', 'Siswa berhasil di tambahkan' );
    }

    public function show(Siswa $siswa)
    {
        //
    }

    public function edit(Siswa $siswa)
    {
        return view( 'dashboard.manajemen_siswa.siswa.edit', [
            'title'  => 'Siswa',
            'active' => 'manajemen-siswa',
            'sub'    => 'siswa',
            'siswa'  => $siswa,
            'kelas'  => Kelas::all(),
            'spp'    => Spp::all()
            
        ]);
    }

    public function update(Request $request, Siswa $siswa)
    {
        $rules = [
            'nama'      => 'required|max:35',
            'nisn'      => 'required|size:10|unique:siswas',
            'nis'       => 'required|size:8|unique:siswas',
            'kelas_id'  => 'required',
            'spp_id'    => 'required',
            'no_telp'   => 'required|max:13',
            'alamat'    => 'required'
        ];

        $msg = [
            'nama.required'     => 'Nama siswa harus di isi',
            'nama.max'          => 'Nama tidak boleh lebih dari 35 karakter',
            'nisn.required'     => 'NISN harus di isi',
            'nisn.size'         => 'NISN harus berjumlah 10 karakter',  
            'nisn.unique'       => 'NISN sudah terdaftar',
            'nis.required'      => 'NIS harus di isi',
            'nis.size'          => 'NIS harus berjumlah 8 karakter',  
            'nis.unique'        => 'NIS sudah terdaftar',
            'kelas_id.required' => 'Kelas harus di isi',
            'spp_id.required'   => 'Spp harus di isi',
            'no_telp.required'  => 'Nomor telpon harus di isi',
            'no_telp.max'       => 'Nomor telpon tidak boleh lebih dari 13 karakter',
            'alamat.required'   => 'Alamat harus di isi'
        ];

        if ( $request->nisn == $siswa->nisn ) {
            $rules['nisn']  = 'required|size:10';
            $rules['nis']   = 'required|size:8';
        } else {
            $rules['nisn']  = 'required|size:10|unique:siswas';
            $rules['nis']   = 'required|size:8|unique:siswas';
        }

        $validated = $request->validate($rules, $msg);
        
        $siswa->fill($validated)->save();
        return redirect('/siswa')->with( 'successMessage', 'Data siswa berhasil diperbaharui' );
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return response()->json([
            'status' => true,
            'msg'    => 'Data siswa berhasil dihapus'
        ]);
    }
}
