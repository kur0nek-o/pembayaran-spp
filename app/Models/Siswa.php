<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $guarded  = ['id'];
    protected $with     = ['kelas', 'spp'];

    public function kelas() {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id_kelas');
    }

    public function spp() {
        return $this->belongsTo(Spp::class, 'spp_id', 'id_spp');
    }

    public function scope_Join($withSpp = false) {
        $query = Siswa::join('kelas', 'kelas.id_kelas', '=', 'siswas.kelas_id')->select('siswas.*', 'kelas.nama_kelas');
        
        if ($withSpp) {
            $query->join('spps', 'spps.id_spp', '=', 'siswas.spp_id')->addSelect('spps.tahun', 'spps.nominal');
        }
        return $query;
    }
}
