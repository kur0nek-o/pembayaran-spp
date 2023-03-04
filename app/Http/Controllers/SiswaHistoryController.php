<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;

class SiswaHistoryController extends Controller
{
    public function index() {
        return view('dashboard.history_pembayaran.siswa', [
            'title'     => 'History Pembayaran',
            'active'    => 'history_pembayaran_siswa'
        ]);
    }

    public function _load(Request $request) {
        $history = History::where('siswa_id', auth()->user()->siswa->id)->latest()->get();

        $data = [];
        $no   = $request->start;

        if ($history->count()) {
            foreach ($history as $item) {
                $row = [];
                $pembayaran = $item->pembayaran;
                $siswa      = $pembayaran->siswa;
                $kelas      = $siswa->kelas;

                $row[] = ++$no;
                $row[] = $siswa->nama;
                $row[] = $kelas->nama_kelas;
                $row[] = $pembayaran->bulan_dibayar . ' | ' . $pembayaran->tahun_dibayar;
                $row[] = $pembayaran->tgl_bayar;
                $row[] = convert_to_rupiah($pembayaran->jumlah_bayar);

                $data[] = $row;
            }
        }

        return response()->json([
            'data' => $data
        ]);
    }
}
