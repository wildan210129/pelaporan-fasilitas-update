<?php

namespace App\Exports;

use App\Models\Laporan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LaporanExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    ShouldAutoSize
{
    public function collection()
    {
        if (auth()->user()->role == 'admin') {

            return Laporan::with([
                'lokasi',
                'kategori',
                'user',
                'petugas'
            ])
                ->latest()
                ->get();
        }

        return Laporan::with([
            'lokasi',
            'kategori',
            'user',
            'petugas'
        ])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Judul',
            'Deskripsi',
            'Lokasi',
            'Kategori',
            'Status',
            'Pelapor',
            'Petugas',
            'Tanggal Laporan',
        ];
    }

    public function map($laporan): array
    {
        static $no = 0;

        $no++;

        return [
            $no,
            $laporan->judul,
            $laporan->deskripsi,
            $laporan->lokasi->nama_lokasi ?? '-',
            $laporan->kategori->nama_kategori ?? '-',
            $laporan->status,
            $laporan->user->name ?? '-',
            $laporan->petugas->name ?? '-',
            $laporan->created_at
                ? $laporan->created_at->format('d-m-Y H:i')
                : '-',
        ];
    }
}
