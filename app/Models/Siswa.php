<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $guarded  = ['id'];
    protected $with     = ['kelas'];

    public function kelas() {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id_kelas');
    }

    public function scope_Join() {
        return Siswa::join('kelas', 'kelas.id_kelas', '=', 'siswas.kelas_id')->select('siswas.*', 'kelas.nama_kelas');
    }
}
