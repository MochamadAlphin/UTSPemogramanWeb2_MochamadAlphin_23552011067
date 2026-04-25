<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    // Menentukan nama tabel (karena bukan mahasiswas)
    protected $table = 'mahasiswa';

    // Menentukan primary key (karena bukan id)
    protected $primaryKey = 'id_mahasiswa';

    // Mengizinkan kolom ini diisi saat simpan data
    protected $fillable = [
        'nim', 
        'nama', 
        'id_jurusan'
    ];

    // Relasi ke tabel Jurusan
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id_jurusan');
    }
}