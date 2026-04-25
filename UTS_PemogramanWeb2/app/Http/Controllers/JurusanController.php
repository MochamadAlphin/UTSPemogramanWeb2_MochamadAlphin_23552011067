<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusan = Jurusan::all();
        // Sesuai struktur folder Anda
        return view('mahasiswa.jurusan', compact('jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:255',
            'akreditasi'   => 'nullable|string|max:2' // Validasi jika nanti ditambah ke form
        ]);

        // Gabungkan data request dengan nilai default untuk akreditasi agar tidak error 1364
        Jurusan::create([
            'nama_jurusan' => $request->nama_jurusan,
            'akreditasi'   => $request->akreditasi ?? 'B', // Jika form kosong, otomatis isi 'B'
        ]);

        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil ditambah!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:255',
            'akreditasi'   => 'nullable|string|max:2'
        ]);

        $jurusan = Jurusan::findOrFail($id);
        
        $jurusan->update([
            'nama_jurusan' => $request->nama_jurusan,
            'akreditasi'   => $request->akreditasi ?? $jurusan->akreditasi,
        ]);

        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil diubah!');
    }

    public function destroy($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();
        
        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil dihapus!');
    }
}