<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index()
    {
        $data = Petugas::_Join()->latest()->paginate(5);

        return view( 'dashboard.petugas.index', [
            'title'     => 'Petugas',
            'active'    => 'petugas',
            'petugas'   => $data,
            'index'     => $data->firstItem()
        ]);
    }

    public function _load( Request $request ) {
        if ( $request->ajax() ) {
            $data = Petugas::_Join();
            
            if ( $request->keyword != null ) {
                $data = $data->where( 'nama_petugas', 'like', '%' . $request->keyword . '%' )
                        ->orWhere( 'username', 'like', '%' . $request->keyword . '%' );
            }

            $data = $data->latest()->paginate(5);
            return view('dashboard.petugas.table', [
                'petugas' => $data,
                'index'   => $data->firstItem()
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

    public function show(Petugas $petuga)
    {
        //
    }

    public function edit(Petugas $petuga)
    {
        return response()->json($petuga);
    }

    public function update(Request $request, Petugas $petuga)
    {
        $validationRules = [
            'nama_petugas' => 'required',
            'level'        => 'required'
        ];

        $validationMsg = [
            'nama_petugas.required' => 'Nama petugas harus di isi',
            'username.required'     => 'Username harus di isi',
            'username.min'          => 'Username tidak boleh kurang dari 4 karakter',
            'username.max'          => 'Username tidak boleh lebih dari 25 karakter',
            'level.required'        => 'Pilih level petugas'
        ];

        if ( $request->username == $petuga->user->username ) {
            $validationRules['username'] = 'required|min:4|max:25';
        } else {
            $validationRules['username'] = 'required|min:4|max:25|unique:users';
            $validationMsg['username.unique'] = 'Username sudah dipakai';
        }

        $validated = $request->validate($validationRules, $validationMsg);

        if ( $request->password != null ) {
            $validated['password'] = Hash::make( $request->password );
        }
        $data = collect($validated);
        
        User::where('id', $request->id_user)->update( $data->except('nama_petugas')->toArray() );
        $petuga::where('id_petugas', $request->id)->update( $data->only(['user_id', 'nama_petugas'])->toArray() );
        
        return response()->json([
            'status' => true,
            'msg'    => 'Data petugas berhasil diperbaharui'
        ]);
    }

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
