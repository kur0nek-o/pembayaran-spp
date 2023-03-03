<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    use HasFactory;
    protected $guarded = ['id_spp'];
    
    public function siswa() {
        return $this->hasMany(Siswa::class, 'spp_id', 'id_spp');
    }

    public function getRouteKeyName() {
        return 'id_spp';
    }
}
