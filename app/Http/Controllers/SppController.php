<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use Illuminate\Http\Request;

class SppController extends Controller
{
    public function index()
    {
        $data = Spp::latest()->paginate(5);

        return view( 'dashboard.spp.index', [
            'title'     => 'Spp',
            'active'    => 'spp',
            'spp'       => $data,
            'index'     => $data->firstItem()
        ]);
    }

    public function _load( Request $request ) {
        if ( $request->ajax() ) {
            $data = Spp::latest();
            
            if ( $request->keyword != null ) {
                $data = $data->where( 'tahun', 'like', '%' . $request->keyword . '%' )
                        ->orWhere( 'nominal', 'like', '%' . $request->keyword . '%' );
            }

            $data = $data->latest()->paginate(5);
            return view('dashboard.spp.table', [
                'spp'   => $data,
                'index' => $data->firstItem()
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
                'tahun'     => 'required|max:11|unique:spps',
                'nominal'   => 'required'
            ],
            [
                'tahun.required'    => 'Tahun harus di isi',
                'tahun.max'         => 'Tahun tidak boleh lebih dari 11 karakter',
                'tahun.unique'      => 'Spp untuk tahun ini sudah ada',
                'nominal.required'  => 'Nominal harus di isi'
            ]
        );

        $validated['nominal'] = convert_to_int( $validated['nominal'] );

        Spp::create($validated);
        return response()->json([
            'status' => true,
            'msg'    => "Spp berhasil di tambahkan"
        ]);
    }

    public function show(Spp $spp)
    {
        //
    }

    public function edit(Spp $spp)
    {
        $spp->nominal = convert_to_rupiah($spp->nominal);
        return response()->json($spp);
    }

    public function update(Request $request, Spp $spp)
    {
        $validationRules = ['nominal'   => 'required'];
        $validationMsg = [
            'tahun.required'    => 'Tahun harus di isi',
            'tahun.max'         => 'Tahun tidak boleh lebih dari 11 karakter',
            'nominal.required'  => 'Nominal harus di isi'
        ];

        if ( $request->tahun == $spp->tahun ) {
            $validationRules['tahun'] = 'required|max:11';
        } else {
            $validationRules['tahun'] = 'required|max:11|unique:spps';
            $validationMsg['tahun.unique'] = 'Spp untuk tahun ini sudah ada';
        }
        
        $validated = $request->validate($validationRules, $validationMsg);
        $validated['nominal'] = convert_to_int( $validated['nominal'] );

        Spp::where('id_spp', $request->id)->update($validated);
        return response()->json([
            'status' => true,
            'msg'    => "Data spp berhasil diperbaharui"
        ]);
    }

    public function destroy(Spp $spp)
    {
        Spp::where('id_spp', $spp->id_spp)->delete();
        return response()->json([
            'status' => true,
            'msg'    => "Data spp berhasil dihapus"
        ]);
    }
}
