<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\Jurusan; // Tambahkan import model Jurusan
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    public function index()
    {
        // Menggunakan with('jurusan') agar pengambilan data lebih efisien (Eager Loading)
        $matakuliah = Matakuliah::with('jurusan')->get();
        
        // Ambil data jurusan agar bisa ditampilkan di dropdown Modal
        $jurusan = Jurusan::all();
        
        return view('mahasiswa.matakuliah', compact('matakuliah', 'jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_matakuliah' => 'required|string|max:255',
            'sks'             => 'required|numeric|min:1|max:6',
            'id_jurusan'      => 'required|exists:jurusan,id_jurusan', // Pastikan id_jurusan ada di tabel jurusan
        ]);

        Matakuliah::create($request->all());
        
        return redirect()->back()->with('success', 'Mata kuliah berhasil ditambah!');
    }

    public function update(Request $request, $id)
    {
        $mk = Matakuliah::findOrFail($id);
        
        $request->validate([
            'nama_matakuliah' => 'required|string|max:255',
            'sks'             => 'required|numeric|min:1|max:6',
            'id_jurusan'      => 'required|exists:jurusan,id_jurusan',
        ]);

        $mk->update($request->all());
        
        return redirect()->back()->with('success', 'Mata kuliah berhasil diupdate!');
    }

    public function destroy($id)
    {
        $mk = Matakuliah::findOrFail($id);
        $mk->delete();
        
        return redirect()->back()->with('success', 'Mata kuliah dihapus!');
    }
}