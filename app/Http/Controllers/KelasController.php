<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $data = Kelas::latest()->paginate(5);

        return view( 'dashboard.manajemen_siswa.kelas.index', [
            'title'  => 'Kelas',
            'active' => 'manajemen-siswa',
            'sub'    => 'kelas',
            'kelas'  => $data,
            'index'  => $data->firstItem()
        ]);
    }

    public function _load( Request $request ) {
        if ( $request->ajax() ) {
            $data = Kelas::latest();
            
            if ( $request->keyword != null ) {
                $data = $data->where( 'nama_kelas', 'like', '%' . $request->keyword . '%' )
                        ->orWhere( 'kompetensi_keahlian', 'like', '%' . $request->keyword . '%' );
            }

            $data = $data->paginate(5);
            return view('dashboard.manajemen_siswa.kelas.table', [
                'kelas' => $data,
                'index' => $data->firstItem()
            ])->render();
        }
    }

    public function _getItems() {
        return response()->json(Kelas::all());
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
        $isActive = Siswa::where('kelas_id', $kela->id_kelas)->get();
        if ($isActive->count()) {
            return response()->json([
                'status' => false,
                'msg'    => "Data kelas aktif dan sedang digunakan"
            ]);
        }

        Kelas::where( 'id_kelas', $kela->id_kelas )->delete();
        return response()->json([
            'status' => true,
            'msg'    => 'Data kelas berhasil dihapus'
        ]);
    }
}
