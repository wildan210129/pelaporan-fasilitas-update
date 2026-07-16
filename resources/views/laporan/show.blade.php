<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Detail Laporan
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto">

            <div class="bg-white rounded-lg shadow p-6">

                <h2 class="text-2xl font-bold mb-6">
                    {{ $laporan->judul }}
                </h2>

                <div class="grid grid-cols-2 gap-4">

                    <div>
                        <strong>Lokasi</strong><br>
                        {{ $laporan->lokasi->nama_lokasi }}
                    </div>

                    <div>
                        <strong>Kategori</strong><br>
                        {{ $laporan->kategori->nama_kategori }}
                    </div>

                    <div class="col-span-2">
                        <strong>Deskripsi</strong><br>
                        {{ $laporan->deskripsi }}
                    </div>

                    <div>
                        <strong>Status</strong><br>
                        {{ $laporan->status }}
                    </div>

                </div>
                <div class="mt-6">
                    <h3 class="font-bold">Petugas</h3>

                    <p>
                        {{ $laporan->petugas?->name ?? 'Belum ditugaskan' }}
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow mt-6 p-6">

                <h2 class="text-xl font-bold mb-6">
                    Riwayat Status
                </h2>

                @forelse($laporan->riwayatStatus as $riwayat)

                    <div class="border-l-4 border-blue-500 pl-4 mb-6">

                        <div class="font-semibold">

                            {{ $riwayat->status }}

                        </div>

                        <div class="text-gray-600">

                            {{ $riwayat->keterangan }}

                        </div>

                        <div class="text-sm text-gray-400 mt-2">

                            {{ $riwayat->user->name }}
                            •

                            {{ $riwayat->created_at->format('d M Y H:i') }}

                        </div>

                    </div>

                @empty

                    <p class="text-gray-500">
                        Belum ada riwayat.
                    </p>

                @endforelse

            </div>

        </div>
    </div>

</x-app-layout>