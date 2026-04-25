<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;

    protected $table = 'matakuliah';
    protected $primaryKey = 'id_matakuliah';

    protected $fillable = [
        'nama_matakuliah',
        'sks',
        'id_jurusan'
    ];

    /**
     * Relasi ke model Jurusan (Many-to-One)
     * Satu Mata Kuliah dimiliki oleh satu Jurusan
     */
    public function jurusan()
    {
        // belongsTo(NamaModel, foreign_key, owner_key)
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id_jurusan');
    }
}