<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Petugas;
use App\Models\Kelas;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username'  => 'kuro',
            'password'  => bcrypt('bagus'),
            'level'     => 'admin' 
        ]);

        Petugas::create([
            'user_id'       => 1,
            'nama_petugas'  => 'Bagus Maulana H'
        ]);
    }
}
