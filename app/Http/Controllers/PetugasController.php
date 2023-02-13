<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $petugas = Petugas::_Join()->latest()->paginate(5);

        return view( 'menu.petugas.index', [
            'title'     => 'Petugas',
            'active'    => 'petugas',
            'petugas'   => $petugas,
            'index'     => $petugas->firstItem()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'nama_petugas' => 'required',
                'username'     => 'required|min:4|max:25|unique:users',
                'password'     => 'required',
                'level'        => 'required'
            ],
            [
                'nama_petugas.required' => 'Nama petugas harus di isi',
                'username.required'     => 'Username harus di isi',
                'username.min'          => 'Username tidak boleh kurang dari 4 karakter',
                'username.max'          => 'Username tidak boleh lebih dari 25 karakter',
                'username.unique'       => 'Username sudah dipakai',
                'password.required'     => 'Password petugas harus di isi',
                'level.required'        => 'Pilih level petugas'
            ]
        );

        $validated['password'] = Hash::make( $validated['password'] );

        $data = collect($validated);
        $user = User::create( $data->except('nama_petugas')->toArray() );

        $data['user_id'] = $user->id;
        Petugas::create( $data->only(['user_id', 'nama_petugas'])->toArray() );
        
        return response()->json([
            'status' => true,
            'msg'    => 'Petugas berhasil di tambahkan'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function show(Petugas $petuga)
    {
        return response()->json($petuga);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function edit(Petugas $petugas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Petugas $petugas)
    {
        $validated = $request->validate(
            [
                'nama_petugas' => 'required',
                'username'     => 'required|min:4|max:25|unique:users',
                'level'        => 'required'
            ],
            [
                'nama_petugas.required' => 'Nama petugas harus di isi',
                'username.required'     => 'Username harus di isi',
                'username.min'          => 'Username tidak boleh kurang dari 4 karakter',
                'username.max'          => 'Username tidak boleh lebih dari 25 karakter',
                'username.unique'       => 'Username sudah dipakai',
                'level.required'        => 'Pilih level petugas'
            ]
        );

        if ( $request->password != null ) {
            $validated['password'] = Hash::make( $request->password );
        }
        $data = collect($validated);
        
        User::where('id', $request->id_user)->update( $data->except('nama_petugas')->toArray() );
        $petugas::where('id_petugas', $request->id)->update( $data->only(['user_id', 'nama_petugas'])->toArray() );
        
        return response()->json([
            'status' => true,
            'msg'    => 'Data petugas berhasil diperbaharui'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Petugas $petuga)
    {
        $id_petugas = $petuga->id_petugas;

        User::where( 'id', $petuga->user->id )->delete();
        Petugas::where( 'id_petugas', $id_petugas )->delete();

        return response()->json([
            'status' => true,
            'msg'    => 'Data petugas berhasil dihapus'
        ]);
    }
}
