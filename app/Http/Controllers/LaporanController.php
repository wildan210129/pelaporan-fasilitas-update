<?php

namespace App\Http\Controllers;


use App\Models\Laporan;
use App\Models\Lokasi;
use App\Models\KategoriKerusakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\RiwayatStatus;
use App\Models\User;
use App\Exports\LaporanExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\LaporanDiprosesNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class LaporanController extends Controller
{
    public function index()
    {
        $petugas = User::where('role', 'petugas')->get();

        if (auth()->user()->role == 'admin') {

            $laporan = Laporan::with(['lokasi', 'kategori', 'user'])
                ->latest()
                ->get();
        } else {

            $laporan = Laporan::with(['lokasi', 'kategori', 'user'])
                ->where('user_id', auth()->id())
                ->latest()
                ->get();
        }

        $lokasi = Lokasi::all();
        $kategori = KategoriKerusakan::all();

        return view('laporan.index', compact(
            'laporan',
            'lokasi',
            'kategori',
            'petugas'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'lokasi_id' => 'required|exists:lokasis,id',
            'kategori_kerusakan_id' => 'required|exists:kategori_kerusakans,id',
            'deskripsi' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $foto = null;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('laporan', 'public');
        }

        $laporan = Laporan::create([
            'user_id' => Auth::id(),
            'lokasi_id' => $request->lokasi_id,
            'kategori_kerusakan_id' => $request->kategori_kerusakan_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $foto,
            'status' => 'Menunggu',
        ]);
        RiwayatStatus::create([
            'laporan_id' => $laporan->id,
            'user_id' => auth()->id(),
            'status' => 'Menunggu',
            'keterangan' => 'Laporan dibuat.',

        ]);

        activity('Menambah Laporan', 'Laporan');

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan berhasil ditambahkan.');
    }


    public function destroy(Laporan $laporan)
    {

        if (auth()->user()->role != 'admin') {
            abort(403, 'Akses ditolak.');
        }

        if ($laporan->foto && Storage::disk('public')->exists($laporan->foto)) {
            Storage::disk('public')->delete($laporan->foto);
        }

        activity('Menghapus Laporan', 'Laporan');

        $laporan->delete();

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }



    public function update(Request $request, Laporan $laporan)
    {
        if (auth()->user()->role != 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'status' => 'required|in:Menunggu,Diproses,Selesai',
            'petugas_id' => 'nullable|exists:users,id',
        ]);

        $petugasSebelumnya = $laporan->petugas_id;

        $laporan->update([
            'status' => $request->status,
            'petugas_id' => $request->petugas_id,
        ]);

        RiwayatStatus::create([
            'laporan_id' => $laporan->id,
            'user_id' => auth()->id(),
            'status' => $request->status,
            'keterangan' => 'Status diubah menjadi ' . $request->status,
        ]);

        activity('Memproses laporan menjadi ' . $request->status, 'Laporan');

        $pesanEmail = null;

        // Kirim email ke petugas jika status "Diproses" dan ada petugas yang ditugaskan
        if ($request->status === 'Diproses' && $request->petugas_id) {
            try {
                $laporan->load('petugas', 'lokasi', 'kategori');
                if ($laporan->petugas && $laporan->petugas->email) {
                    $isiEmail = "Laporan #{$laporan->id} telah ditugaskan kepada Anda.\n"
                        . "Lokasi: {$laporan->lokasi->nama}\n"
                        . "Kategori: {$laporan->kategori->nama}\n"
                        . "Status: {$laporan->status}";

                    Mail::raw($isiEmail, function ($message) use ($laporan) {
                        $message->to($laporan->petugas->email)
                            ->subject('Laporan Baru Ditugaskan');
                    });
                }
            } catch (\Exception $e) {
                Log::error('Gagal mengirim email notifikasi laporan #' . $laporan->id . ': ' . $e->getMessage());

                $pesanEmail = ' Namun, notifikasi email ke petugas gagal terkirim.';
            }
        }

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan berhasil diproses.' . $pesanEmail);
    }

    public function show(Laporan $laporan)
    {
        $laporan->load(
            'lokasi',
            'kategori',
            'petugas',
            'riwayatStatus.user'
        );

        return view('laporan.show', compact('laporan'));
    }

    /**
     * Export laporan ke Excel
     */
    public function exportExcel()
    {
        return Excel::download(
            new LaporanExport(),
            'data-laporan-kerusakan.xlsx'
        );
    }

    /**
     * Cetak laporan ke PDF
     */
    public function exportPdf()
    {
        if (auth()->user()->role == 'admin') {

            $laporan = Laporan::with([
                'lokasi',
                'kategori',
                'user',
                'petugas'
            ])
                ->latest()
                ->get();
        } else {

            $laporan = Laporan::with([
                'lokasi',
                'kategori',
                'user',
                'petugas'
            ])
                ->where('user_id', auth()->id())
                ->latest()
                ->get();
        }

        $pdf = Pdf::loadView(
            'laporan.pdf',
            compact('laporan')
        );

        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('data-laporan-kerusakan.pdf');
    }
}
