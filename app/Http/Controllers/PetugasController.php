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
        return view( 'menu.petugas.index', [
            'title'     => 'Petugas',
            'active'    => 'petugas',
            'petugas'   => Petugas::latest()->get()
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
                'username'     => 'required|min:8|max:25|unique:users',
                'password'     => 'required'
            ],
            [
                'nama_petugas.required' => 'Nama petugas harus di isi',
                'username.required'     => 'Username harus di isi',
                'username.min'          => 'Username tidak boleh kurang dari 8 karakter',
                'username.max'          => 'Username tidak boleh lebih dari 25 karakter',
                'username.unique'       => 'Username sudah dipakai',
                'password.required'     => 'Password petugas harus di isi'
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
    public function show(Petugas $petugas)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Petugas $petugas)
    {
        //
    }
}
