<?php

namespace App\Http\Controllers;

use App\Models\Laporan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLaporan = Laporan::count();

        $menunggu = Laporan::where('status', 'Menunggu')->count();

        $diproses = Laporan::where('status', 'Diproses')->count();

        $selesai = Laporan::where('status', 'Selesai')->count();

        $laporanTerbaru = Laporan::with(['lokasi'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalLaporan',
            'menunggu',
            'diproses',
            'selesai',
            'laporanTerbaru'
        ));
    }
}