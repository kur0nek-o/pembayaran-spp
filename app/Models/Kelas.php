<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    
    protected $guarded = ['id_kelas'];

    public function getRouteKeyName()
    {
        return 'id_kelas';
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'kelas_id', 'id_kelas');
    }
}
