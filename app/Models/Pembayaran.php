<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $guarded = ['id_pembayaran'];
    protected $with    = ['siswa', 'petugas'];
    protected $primaryKey = 'id_pembayaran';

    public function siswa() {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }

    public function petugas() {
        return $this->belongsTo(Petugas::class, 'id_petugas', 'id_petugas');
    }
}
