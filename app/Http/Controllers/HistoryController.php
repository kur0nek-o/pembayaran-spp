<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Barryvdh\DomPDF\Facade\Pdf;

class HistoryController extends Controller
{
    public function previewKwitansi(Pembayaran $pembayaran) {
        return view('laporan.preview-kwitansi', [
            'title'         => 'Preview kwitansi',
            'active'        => 'transaksi_pembayaran',
            'pembayaran'    => $pembayaran
        ]);
    }

    public function cetakKwitansi(Pembayaran $pembayaran) {
        $pdf = Pdf::loadView('laporan.kwitansi', [
            'title'         => 'kwitansi',
            'active'        => 'transaksi_pembayaran',
            'pembayaran'    => $pembayaran
        ]);
        return $pdf->stream();
    }
}
