<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\History;
use Barryvdh\DomPDF\Facade\Pdf;

class HistoryController extends Controller
{
    public function index() {
        return view('dashboard.history_pembayaran.index', [
            'title'     => 'History Pembayaran',
            'active'    => 'history_pembayaran'
        ]);
    }

    public function _load(Request $request) {
        $history = History::latest()->get();

        $data = [];
        $no   = $request->start;

        if ($history->count()) {
            foreach ($history as $item) {
                $row = [];
                $pembayaran = $item->pembayaran;
                $siswa      = $pembayaran->siswa;
                $kelas      = $siswa->kelas;

                $btnEdit = "<a href='/edit-history/". $pembayaran->id_pembayaran ."' class='btn btn-warning btn-sm'><i class='bi bi-pencil-square'></i></a>";
                $btnCetak = "<a target='_blank' href='/cetak-kuitansi/". $pembayaran->id_pembayaran ."' class='btn btn-primary btn-sm'><i class='bi bi-printer'></i></a>";
                $btnHapus = "<button class='btn btn-danger btn-sm' type='button' onclick='_delete(".$item->id.")'><i class='bi bi-x-circle'></i></button>";

                $row[] = ++$no;
                $row[] = $siswa->nama;
                $row[] = $kelas->nama_kelas;
                $row[] = $pembayaran->bulan_dibayar . ' | ' . $pembayaran->tahun_dibayar;
                $row[] = $pembayaran->tgl_bayar;
                $row[] = convert_to_rupiah($pembayaran->jumlah_bayar);
                $row[] = "$btnEdit $btnCetak $btnHapus";

                $data[] = $row;
            }
        }

        return response()->json([
            'data' => $data
        ]);
    }

    public function previewKuitansi(Pembayaran $pembayaran) {
        return view('laporan.preview-kuitansi', [
            'title'         => 'Preview Kuitansi',
            'active'        => 'history_pembayaran',
            'pembayaran'    => $pembayaran
        ]);
    }

    public function cetakKuitansi(Pembayaran $pembayaran) {
        $pdf = Pdf::loadView('laporan.kuitansi', ['pembayaran'    => $pembayaran]);
        return $pdf->stream();
    }

    public function delete(History $history) {
        $history->delete();
        return response()->json([
            'status' => true,
            'msg'    => 'Data history berhasil dihapus'
        ]);
    }
}
