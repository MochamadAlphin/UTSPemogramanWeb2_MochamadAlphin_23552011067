<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    
    public function index(Request $request) 
    {
        $search = $request->search;
        
        $mahasiswa = Mahasiswa::with('jurusan')
            ->when($search, function($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                      ->orWhere('nim', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(5);

        $jurusan = Jurusan::all(); 

        return view('mahasiswa.index', compact('mahasiswa', 'jurusan'));
    }

 
    public function create() 
    {
        return redirect()->route('mahasiswa.index');
    }

    public function store(Request $request) 
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim',
            'nama' => 'required|min:3',
            'id_jurusan' => 'required',
        ], [
            'nim.unique' => 'NIM sudah terdaftar!',
            'nama.min' => 'Nama minimal harus 3 karakter.'
        ]);

        Mahasiswa::create($request->all());
        
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa baru berhasil ditambahkan!');
    }

    public function edit($id) 
    {
        return redirect()->route('mahasiswa.index');
    }

    public function update(Request $request, $id) 
    {
        $request->validate([
            // Validasi unik NIM kecuali untuk ID yang sedang diedit
            'nim' => 'required|unique:mahasiswa,nim,'.$id.',id_mahasiswa',
            'nama' => 'required|min:3',
            'id_jurusan' => 'required',
        ]);

        $mhs = Mahasiswa::findOrFail($id);
        $mhs->update($request->all());

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    public function destroy($id) 
    {
        $mhs = Mahasiswa::findOrFail($id);
        $mhs->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa telah dihapus!');
    }
}