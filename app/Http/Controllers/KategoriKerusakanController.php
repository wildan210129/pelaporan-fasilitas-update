<?php

namespace App\Http\Controllers;

use App\Models\KategoriKerusakan;
use Illuminate\Http\Request;

class KategoriKerusakanController extends Controller
{
    public function index()
    {
        $kategori = KategoriKerusakan::all();
        return view('kategori.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|max:255'
        ]);

        KategoriKerusakan::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, KategoriKerusakan $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|max:255'
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil diupdate.');
    }

    public function destroy(KategoriKerusakan $kategori)
    {
        $kategori->delete();

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}