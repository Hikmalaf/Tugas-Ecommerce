<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Hash;
use Illuminate\Support\Facades\Hash as FacadesHash;

class PenggunaSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan beberapa pengguna contoh
        DB::table('pengguna')->insert([
            [
                'nama' => 'Perusahaan Operator',
                'email' => 'upi1@upi.com',
                'password' => FacadesHash::make('123456789'),
                'role' => 'Perusahaan Operator',
                'perusahaan_id' => 3, // Misal terkait perusahaan dengan ID 2
                'created_at' => now(),
                'updated_at' => now(),
            ],
          
        ]);
    }
}
