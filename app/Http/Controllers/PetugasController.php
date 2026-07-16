<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = User::where('role', 'petugas')->latest()->get();

        return view('petugas.index', compact('petugas'));
    }

  public function store(Request $request)
{
    $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'petugas',
    ]);

    return redirect()->route('petugas.index')
        ->with('success', 'Petugas berhasil ditambahkan.');
}

public function update(Request $request, User $petugas)
{
    $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users,email,' . $petugas->id,
    ]);

    $data = [
        'name' => $request->name,
        'email' => $request->email,
    ];

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $petugas->update($data);

    return redirect()->route('petugas.index')
        ->with('success', 'Petugas berhasil diupdate.');
}

public function destroy(User $petugas)
{
    $petugas->delete();

    return redirect()->route('petugas.index')
        ->with('success', 'Petugas berhasil dihapus.');
}
}