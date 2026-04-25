<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('matakuliah')->insert([
            ['nama_matakuliah' => 'Algoritma', 'sks' => 3, 'id_jurusan' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nama_matakuliah' => 'Struktur Data', 'sks' => 3, 'id_jurusan' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nama_matakuliah' => 'Basis Data', 'sks' => 3, 'id_jurusan' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nama_matakuliah' => 'Sistem Informasi', 'sks' => 2, 'id_jurusan' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nama_matakuliah' => 'Jaringan Komputer', 'sks' => 3, 'id_jurusan' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['nama_matakuliah' => 'Arsitektur Komputer', 'sks' => 2, 'id_jurusan' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}