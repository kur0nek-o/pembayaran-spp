<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use HasFactory;
    protected $guarded  = ['id_petugas'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName() {
        return 'id_petugas';
    }

    public function scope_Join() {
        return User::join('petugas', 'users.id', '=', 'petugas.user_id')->select('users.*', 'petugas.id_petugas', 'petugas.nama_petugas');
    }
}
