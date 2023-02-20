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
        $data = Siswa::latest()->paginate(5);

        return view( 'dashboard.manajemen_siswa.siswa.index', [
            'title'  => 'Siswa',
            'active' => 'manajemen-siswa',
            'sub'    => 'siswa',
            'siswa'  => $data,
            'index'  => $data->firstItem()
        ]);
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
        return redirect('/siswa')->with( 'msg', 'Siswa berhasil di tambahkan' );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        //
    }
}
