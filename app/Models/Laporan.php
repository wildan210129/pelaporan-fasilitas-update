<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RiwayatStatus;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',
    'lokasi_id',
    'kategori_kerusakan_id',
    'judul',
    'deskripsi',
    'foto',
    'status',
];

    public function riwayatStatus()
    {
        return $this->hasMany(RiwayatStatus::class)
                ->latest();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriKerusakan::class, 'kategori_kerusakan_id');
    }
}