<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     DB::table('jurusan')->insert([
            [
                'nama_jurusan' => 'Informatika',
                'akreditasi' => 'A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jurusan' => 'Sistem Informasi',
                'akreditasi' => 'B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jurusan' => 'Teknik Komputer',
                'akreditasi' => 'A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
