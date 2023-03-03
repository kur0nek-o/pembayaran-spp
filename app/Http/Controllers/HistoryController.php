<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Barryvdh\DomPDF\Facade\Pdf;

class HistoryController extends Controller
{
    public function index() {
        return view('dashboard.history_pembayaran.index', [
            'title'     => 'History Pembayaran',
            'active'    => 'history_pembayaran'
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
}
