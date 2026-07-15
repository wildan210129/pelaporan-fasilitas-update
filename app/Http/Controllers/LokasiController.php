<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    // Menampilkan semua lokasi
    public function index()
    {
        $lokasi = Lokasi::all();
        return view('lokasi.index', compact('lokasi'));
    }

    // Menampilkan form tambah lokasi
    public function create()
    {
        return view('lokasi.create');
    }

    // Menyimpan data lokasi
    public function store(Request $request)
{
    $request->validate([
        'nama_lokasi' => 'required|max:255'
    ]);

    Lokasi::create([
        'nama_lokasi' => $request->nama_lokasi
    ]);

    return redirect()->route('lokasi.index')
        ->with('success', 'Lokasi berhasil ditambahkan.');
}

    // Menampilkan detail lokasi
    public function show(Lokasi $lokasi)
    {
        return view('lokasi.show', compact('lokasi'));
    }

    // Menampilkan form edit lokasi
    public function edit(Lokasi $lokasi)
    {
        return view('lokasi.edit', compact('lokasi'));
    }

    // Mengupdate data lokasi
    public function update(Request $request, Lokasi $lokasi)
{
    $request->validate([
        'nama_lokasi' => 'required|max:255',
    ]);

    $lokasi->update([
        'nama_lokasi' => $request->nama_lokasi,
    ]);

    return redirect()->route('lokasi.index')
        ->with('success', 'Lokasi berhasil diupdate.');
}
    // Menghapus lokasi
    public function destroy(Lokasi $lokasi)
{
    $lokasi->delete();

    return redirect()->route('lokasi.index')
        ->with('success', 'Lokasi berhasil dihapus.');
}
}