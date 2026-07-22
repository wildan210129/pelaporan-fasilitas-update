<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">

            <div>

                <h2 class="text-2xl font-bold text-gray-800">
                    Dashboard
                </h2>

                <p class="text-gray-500 text-sm mt-1">
                    Sistem Pelaporan Kerusakan Fasilitas Sekolah
                </p>

            </div>

            <div class="flex w-fit items-center gap-2 bg-blue-100 text-blue-700 px-4 py-2 rounded-full">

                <span class="text-lg">🛠</span>

                <span class="font-semibold">
                    {{ ucfirst(Auth::user()->role) }}
                </span>

            </div>

        </div>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-indigo-100 py-8">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- HERO -->

            <div
                class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 rounded-3xl shadow-xl overflow-hidden">

                <div class="p-6 md:p-10 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-8">

                    <div>

                        <h1 class="text-2xl md:text-4xl font-bold text-white">

                            Halo, {{ Auth::user()->name }} 👋

                        </h1>

                        <p class="mt-4 text-blue-100 text-sm md:text-lg">

                            Selamat datang kembali di Sistem Pelaporan
                            Kerusakan Fasilitas Sekolah.

                        </p>

                        <div class="mt-6 flex flex-wrap gap-3">

                            <span
                                class="bg-white/20 backdrop-blur px-4 py-2 rounded-full text-white">

                                📅 {{ now()->format('d F Y') }}

                            </span>

                            <span
                                class="bg-white/20 backdrop-blur px-4 py-2 rounded-full text-white">

                                👤 {{ ucfirst(Auth::user()->role) }}

                            </span>

                        </div>

                    </div>

                    <div class="hidden lg:block text-8xl xl:text-[120px]">
                        🏫

                    </div>

                </div>

            </div>

            <!-- Statistik -->

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mt-8">

                <!-- Total -->

                <div
                    class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition duration-300 p-6">

                    <div class="flex items-center justify-between gap-4">

                        <div>

                            <p class="text-gray-500">

                                Total Laporan

                            </p>

                            <h2 class="text-4xl md:text-5xl font-bold text-blue-600 mt-2">

                                {{ $totalLaporan }}

                            </h2>

                            <p class="text-gray-400 text-sm mt-2">

                                Seluruh laporan masuk

                            </p>

                        </div>

                        <div
                            class="w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-blue-100 flex items-center justify-center text-4xl">

                            📋

                        </div>

                    </div>

                </div>

                <!-- Menunggu -->

                <div
                    class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition duration-300 p-6">

                    <div class="flex items-center justify-between gap-4">

                        <div>

                            <p class="text-gray-500">

                                Menunggu

                            </p>

                            <h2 class="text-4xl md:text-5xl font-bold text-yellow-500 mt-2">

                                {{ $menunggu }}

                            </h2>

                            <p class="text-gray-400 text-sm mt-2">

                                Belum diproses

                            </p>

                        </div>

                        <div
                            class="w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-yellow-100 flex items-center justify-center text-4xl">

                            ⏳

                        </div>

                    </div>

                </div>

                <!-- Diproses -->

                <div
                    class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition duration-300 p-6">

                    <div class="flex items-center justify-between gap-4">

                        <div>

                            <p class="text-gray-500">

                                Diproses

                            </p>

                            <h2 class="text-4xl md:text-5xl font-bold text-blue-500 mt-2">

                                {{ $diproses }}

                            </h2>

                            <p class="text-gray-400 text-sm mt-2">

                                Sedang diperbaiki

                            </p>

                        </div>

                        <div
                            class="w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-blue-100 flex items-center justify-center text-4xl">

                            🔧

                        </div>

                    </div>

                </div>

                <!-- Selesai -->

                <div
                    class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition duration-300 p-6">

                    <div class="flex items-center justify-between gap-4">

                        <div>

                            <p class="text-gray-500">

                                Selesai

                            </p>

                            <h2 class="text-4xl md:text-5xl font-bold text-green-600 mt-2">

                                {{ $selesai }}

                            </h2>

                            <p class="text-gray-400 text-sm mt-2">

                                Sudah selesai

                            </p>

                        </div>

                        <div
                            class="w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-green-100 flex items-center justify-center text-4xl">

                            ✅

                        </div>

                    </div>

                </div>

            </div>

            <!-- Laporan Terbaru -->
            <div class="mt-8 bg-white rounded-3xl shadow-lg overflow-hidden">

                <div
                    class="flex items-center justify-between px-8 py-6 bg-gradient-to-r from-blue-600 to-indigo-600">

                    <div>

                        <h2 class="text-2xl font-bold text-white">

                            📋 Laporan Terbaru

                        </h2>

                        <p class="text-blue-100 mt-1">

                            Daftar laporan kerusakan yang baru dikirim.

                        </p>

                    </div>

                    <span
                        class="bg-white text-blue-600 px-4 py-2 rounded-full font-semibold">

                        {{ count($laporanTerbaru) }} Laporan

                    </span>

                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead
                            class="bg-gray-100 text-gray-700 uppercase text-sm">

                            <tr>

                                <th class="px-6 py-4 text-left">

                                    Laporan

                                </th>

                                <th class="px-6 py-4 text-left">

                                    Lokasi

                                </th>

                                <th class="px-6 py-4 text-center">

                                    Status

                                </th>

                                <th class="px-6 py-4 text-center">

                                    Tanggal

                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($laporanTerbaru as $laporan)

                            <tr
                                class="border-b hover:bg-blue-50 transition duration-300">

                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-4">

                                        @if($laporan->foto)

                                        <img
                                            src="{{ asset('storage/'.$laporan->foto) }}"
                                            class="w-14 h-14 rounded-xl object-cover shadow">

                                        @else

                                        <div
                                            class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center text-2xl">

                                            📄

                                        </div>

                                        @endif

                                        <div>

                                            <h3
                                                class="font-semibold text-gray-800">

                                                {{ $laporan->judul }}

                                            </h3>

                                            <p
                                                class="text-sm text-gray-500">

                                                {{ Str::limit($laporan->deskripsi, 50) }}

                                            </p>

                                        </div>

                                    </div>

                                </td>

                                <td class="px-6 py-5">

                                    <div
                                        class="flex items-center gap-2">

                                        📍

                                        {{ $laporan->lokasi->nama_lokasi }}

                                    </div>

                                </td>

                                <td class="px-6 py-5 text-center">

                                    @if($laporan->status == 'Menunggu')

                                    <span
                                        class="px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 font-semibold">

                                        ⏳ Menunggu

                                    </span>

                                    @elseif($laporan->status == 'Diproses')

                                    <span
                                        class="px-4 py-2 rounded-full bg-blue-100 text-blue-700 font-semibold">

                                        🔧 Diproses

                                    </span>

                                    @else

                                    <span
                                        class="px-4 py-2 rounded-full bg-green-100 text-green-700 font-semibold">

                                        ✅ Selesai

                                    </span>

                                    @endif

                                </td>

                                <td
                                    class="px-6 py-5 text-center">

                                    <div
                                        class="font-semibold text-gray-800">

                                        {{ $laporan->created_at->format('d M Y') }}

                                    </div>

                                    <div
                                        class="text-sm text-gray-500">

                                        {{ $laporan->created_at->format('H:i') }}

                                    </div>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td
                                    colspan="4"
                                    class="py-12 text-center text-gray-500">

                                    <div class="text-6xl mb-3">

                                        📭

                                    </div>

                                    Belum ada laporan.

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            {{-- Grafik --}}
            <div class="mt-8 bg-white rounded-2xl shadow-lg border border-gray-100 p-6">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-6">

                    <div>

                        <h2 class="text-xl font-bold text-gray-800">
                            Statistik Laporan
                        </h2>

                        <p class="text-gray-500 text-sm">
                            Grafik jumlah laporan berdasarkan status.
                        </p>

                    </div>

                </div>

                <div class="h-[260px] sm:h-[320px] md:h-[380px]">

                    <canvas id="chartLaporan"></canvas>

                </div>

            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('chartLaporan');

        new Chart(ctx, {

            type: 'doughnut',

            data: {

                labels: [

                    'Menunggu',

                    'Diproses',

                    'Selesai'

                ],

                datasets: [{

                    data: [

                        {
                            {
                                $menunggu
                            }
                        },

                        {
                            {
                                $diproses
                            }
                        },

                        {
                            {
                                $selesai
                            }
                        }

                    ],

                    backgroundColor: [

                        '#FBBF24',

                        '#3B82F6',

                        '#22C55E'

                    ],

                    borderWidth: 0,

                    hoverOffset: 15

                }]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                plugins: {

                    legend: {

                        position: 'bottom',

                        labels: {

                            usePointStyle: true,

                            padding: 20,

                            font: {

                                size: 13

                            }

                        }

                    }

                }

            }

        });
    </script>

</x-app-layout>