<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\History;
use App\Models\Spp;

class PembayaranController extends Controller
{
    public function index() {
        $data = Siswa::_join(true)->latest()->paginate(5);

        return view( 'dashboard.entri_transaksi.index', [
            'title'  => 'Transaksi Pembayaran',
            'active' => 'transaksi_pembayaran',
            'siswa'  => $data,
            'index'  => $data->firstItem()
        ]);
    }

    public function _load(Request $request) {
        if ( $request->ajax() ) {
            $data = Siswa::_join(true);
            
            if ( $request->keyword != null ) {
                $data = $data->where( 'nisn', 'like', '%' . $request->keyword . '%' )
                        ->orWhere( 'nis', 'like', '%' . $request->keyword . '%' )
                        ->orWhere( 'nama', 'like', '%' . $request->keyword . '%' )
                        ->orWhere( 'nama_kelas', 'like', '%' . $request->keyword . '%' )
                        ->orWhere( 'tahun', 'like', '%' . $request->keyword . '%' )
                        ->orWhere( 'nominal', 'like', '%' . $request->keyword . '%' );
            }

            $data = $data->latest()->paginate(5);
            return view('dashboard.entri_transaksi.table', [
                'siswa' => $data,
                'index' => $data->firstItem()
            ])->render();
        }
    }

    public function create(Siswa $siswa) {
        $bulan  = $this->getBulan($siswa->spp->tahun, $siswa->id);

        return view('dashboard.entri_transaksi.create', [
            'title'  => 'Transaksi Pembayaran',
            'active' => 'transaksi_pembayaran',
            'siswa'  => $siswa,
            'bulan'  => $bulan 
        ]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'id_petugas'        => 'required',
            'siswa_id'          => 'required',
            'tgl_bayar'         => 'required',
            'pembayaran-spp'    => 'required',
            'jumlah_bayar'      => 'required'
        ], [
            'pembayaran-spp.required' => 'Pembayaran SPP harus diisi'
        ]);

        $pembayaran = explode(' | ', $validated['pembayaran-spp']);
        $validated['bulan_dibayar'] = $pembayaran[0];
        $validated['tahun_dibayar'] = $pembayaran[1];
        $validated['jumlah_bayar']  = convert_to_int($validated['jumlah_bayar']);

        $validated = collect($validated);
        $data = Pembayaran::create($validated->except('pembayaran-spp')->toArray());
        
        History::create(['id_pembayaran' => $data->id]);
        return redirect()->away('/preview-kuitansi/' . $data->id)->with( 'successMessage', 'Pembayaran berhasil dilakukan' );
    }

    public function getBulan($tahunSPP, $id) {
        $activeBulan = Pembayaran::where('siswa_id', $id)->get();
        $bulanList   = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $tempBln = [];
        for ($i = 0; $i < 4; $i++) {
            foreach($bulanList as $item) {
                $tempBln[] = $item . " | " . $tahunSPP;
            }
            $tahunSPP++;
        }

        $activePembayaran = [];
        if ( $activeBulan->count() ) {
            foreach ($activeBulan as $item) {
                $activePembayaran[] = $item->bulan_dibayar . ' | ' . $item->tahun_dibayar;
            }
        } else {
            return $tempBln;
        }

        $final = [];
        foreach ($tempBln as $item) {
            $active = false;
            foreach ($activePembayaran as $subItem) {
                ($item == $subItem) ? $active = true : '';
            }

            ($active) ? '' : $final[] = $item;
        }
        return $final;
    }
}