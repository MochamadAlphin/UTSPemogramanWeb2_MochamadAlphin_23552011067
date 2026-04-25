<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mahasiswa')->insert([
            ['nim' => '230001', 'nama' => 'Andi', 'id_jurusan' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '230002', 'nama' => 'Budi', 'id_jurusan' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '230003', 'nama' => 'Citra', 'id_jurusan' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '230004', 'nama' => 'Dewi', 'id_jurusan' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '230005', 'nama' => 'Eka', 'id_jurusan' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '230006', 'nama' => 'Fajar', 'id_jurusan' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '230007', 'nama' => 'Gina', 'id_jurusan' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '230008', 'nama' => 'Hadi', 'id_jurusan' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '230009', 'nama' => 'Indra', 'id_jurusan' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '230010', 'nama' => 'Joko', 'id_jurusan' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}