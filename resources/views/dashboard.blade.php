<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Total Laporan -->
                <div class="bg-white rounded-xl shadow p-6 border-l-4 border-blue-500">
                    <h3 class="text-gray-500 text-sm">Total Laporan</h3>

                    <p class="text-4xl font-bold mt-3">
                        {{ $totalLaporan }}
                    </p>
                </div>

                <!-- Menunggu -->
                <div class="bg-white rounded-xl shadow p-6 border-l-4 border-yellow-500">
                    <h3 class="text-gray-500 text-sm">Menunggu</h3>

                    <p class="text-4xl font-bold mt-3 text-yellow-600">
                        {{ $menunggu }}
                    </p>
                </div>

                <!-- Diproses -->
                <div class="bg-white rounded-xl shadow p-6 border-l-4 border-blue-600">
                    <h3 class="text-gray-500 text-sm">Diproses</h3>

                    <p class="text-4xl font-bold mt-3 text-blue-600">
                        {{ $diproses }}
                    </p>
                </div>

                <!-- Selesai -->
                <div class="bg-white rounded-xl shadow p-6 border-l-4 border-green-500">
                    <h3 class="text-gray-500 text-sm">Selesai</h3>

                    <p class="text-4xl font-bold mt-3 text-green-600">
                        {{ $selesai }}
                    </p>
                </div>

            </div>

        </div>
    </div>
    <div class="mt-8 bg-white rounded-xl shadow">

    <div class="p-6 border-b">

        <h2 class="text-xl font-bold">
            Laporan Terbaru
        </h2>

    </div>

    <div class="overflow-x-auto">

        <table class="min-w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="px-6 py-3 text-left">
                        Judul
                    </th>

                    <th class="px-6 py-3 text-left">
                        Lokasi
                    </th>

                    <th class="px-6 py-3 text-center">
                        Status
                    </th>

                    <th class="px-6 py-3 text-center">
                        Tanggal
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($laporanTerbaru as $laporan)

                <tr class="border-b hover:bg-gray-50">

                    <td class="px-6 py-4">
                        {{ $laporan->judul }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $laporan->lokasi->nama_lokasi }}
                    </td>

                    <td class="px-6 py-4 text-center">

                        @if($laporan->status == 'Menunggu')

                            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm">
                                Menunggu
                            </span>

                        @elseif($laporan->status == 'Diproses')

                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm">
                                Diproses
                            </span>

                        @else

                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">
                                Selesai
                            </span>

                        @endif

                    </td>

                    <td class="px-6 py-4 text-center">

                        {{ $laporan->created_at->format('d M Y') }}

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="4" class="text-center py-8 text-gray-500">

                        Belum ada laporan.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>
<div class="bg-white rounded-xl shadow mt-8 p-6">

    <h2 class="text-xl font-bold mb-6">
        Statistik Laporan
    </h2>

    <canvas id="chartLaporan" height="100"></canvas>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('chartLaporan');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: [

            'Menunggu',

            'Diproses',

            'Selesai'

        ],

        datasets: [{

            label: 'Jumlah Laporan',

            data: [

                {{ $menunggu }},

                {{ $diproses }},

                {{ $selesai }}

            ],

            backgroundColor: [

                '#FACC15',

                '#3B82F6',

                '#22C55E'

            ],

            borderRadius: 10

        }]

    },

    options: {

        responsive: true,

        plugins: {

            legend: {

                display: false

            }

        },

        scales: {

            y: {

                beginAtZero: true,

                ticks: {

                    precision: 0

                }

            }

        }

    }

});

</script>

</x-app-layout>