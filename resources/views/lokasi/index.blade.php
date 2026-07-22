<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-bold text-gray-800">
                    📍 Data Lokasi
                </h2>

                <p class="text-gray-500 mt-1">
                    Kelola semua lokasi fasilitas sekolah
                </p>

            </div>

        </div>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Alert --}}
            @if(session('success'))

                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-green-700 shadow-sm">

                    <div class="flex items-center gap-3">

                        <div class="text-2xl">
                            ✅
                        </div>

                        <div>

                            <h3 class="font-semibold">
                                Berhasil
                            </h3>

                            <p>
                                {{ session('success') }}
                            </p>

                        </div>

                    </div>

                </div>

            @endif

            <div class="bg-white rounded-2xl shadow-xl border border-gray-100">

                {{-- Header Card --}}
                <div class="p-6 border-b border-gray-100">

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                        <div>

                            <h3 class="text-xl font-bold text-gray-800">

                                📍 Daftar Lokasi

                            </h3>

                            <p class="text-gray-500 text-sm mt-1">

                                Seluruh lokasi fasilitas sekolah yang dapat dipilih ketika membuat laporan.

                            </p>

                        </div>

                        <div class="flex gap-3">

                            <div class="relative">

                                <input
                                    id="searchLokasi"
                                    type="text"
                                    placeholder="Cari lokasi..."
                                    class="w-64 rounded-xl border-gray-300 pl-10 focus:border-blue-500 focus:ring-blue-500">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="absolute left-3 top-3 h-5 w-5 text-gray-400"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M21 21l-4.35-4.35M16 10a6 6 0 11-12 0 6 6 0 0112 0z"/>

                                </svg>

                            </div>

                            <button

                                onclick="document.getElementById('modalTambah').classList.remove('hidden')"

                                class="bg-blue-600 hover:bg-blue-700 transition text-white px-5 py-2.5 rounded-xl font-semibold shadow-lg">

                                + Tambah Lokasi

                            </button>

                        </div>

                    </div>

                </div>

                {{-- Table --}}
                <div class="overflow-x-auto">

                    <table class="min-w-full" id="tableLokasi">

                        <thead class="bg-gradient-to-r from-blue-600 to-blue-700 text-white">

                            <tr>

                                <th class="px-6 py-4 text-center w-20">
                                    No
                                </th>

                                <th class="px-6 py-4 text-left">
                                    Nama Lokasi
                                </th>

                                <th class="px-6 py-4 text-center w-60">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white">
                        
                        @forelse($lokasi as $item)

<tr class="hover:bg-blue-50 transition duration-200">

    <td class="px-6 py-4 text-center">

        <div class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 text-blue-700 font-bold">

            {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}

        </div>

    </td>

    <td class="px-6 py-4">

        <div class="flex items-center gap-4">

            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-2xl">

                📍

            </div>

            <div>

                <h4 class="font-semibold text-gray-800 text-lg">

                    {{ $item->nama_lokasi }}

                </h4>

                <p class="text-sm text-gray-500">

                    Lokasi fasilitas sekolah

                </p>

            </div>

        </div>

    </td>

    <td class="px-6 py-4">

        <div class="flex justify-center gap-3">

            <button

                onclick="editLokasi('{{ $item->id }}','{{ $item->nama_lokasi }}')"

                class="bg-amber-400 hover:bg-amber-500 text-white px-4 py-2 rounded-xl shadow font-medium transition">

                ✏ Edit

            </button>

            <button

                onclick="hapusLokasi('{{ $item->id }}')"

                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl shadow font-medium transition">

                🗑 Hapus

            </button>

        </div>

    </td>

</tr>

@empty

<tr>

    <td colspan="3" class="py-14">

        <div class="flex flex-col items-center justify-center">

            <div class="text-6xl mb-4">

                📍

            </div>

            <h3 class="text-xl font-semibold text-gray-700">

                Belum Ada Data Lokasi

            </h3>

            <p class="text-gray-500 mt-2">

                Silakan tambahkan lokasi baru.

            </p>

        </div>

    </td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>

</div>

</div>

{{-- =========================
     MODAL TAMBAH LOKASI
========================= --}}

<div id="modalTambah"
    class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">

    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-5 text-white">

            <div class="flex items-center justify-between">

                <div>

                    <h2 class="text-xl font-bold">
                        📍 Tambah Lokasi
                    </h2>

                    <p class="text-blue-100 text-sm mt-1">
                        Tambahkan lokasi fasilitas sekolah.
                    </p>

                </div>

                <button
                    onclick="tutupModalTambah()"
                    class="text-3xl hover:rotate-90 transition">

                    &times;

                </button>

            </div>

        </div>

        {{-- Form --}}
        <form
            action="{{ route('lokasi.store') }}"
            method="POST">

            @csrf

            <div class="p-6">

                <label class="block font-semibold text-gray-700 mb-2">

                    Nama Lokasi

                </label>

                <input
                    type="text"
                    name="nama_lokasi"
                    placeholder="Contoh: Laboratorium Komputer"
                    class="w-full rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    required>

                <p class="text-sm text-gray-500 mt-2">

                    Lokasi ini akan muncul pada saat siswa membuat laporan.

                </p>

            </div>

            {{-- Footer --}}
            <div class="bg-gray-50 px-6 py-4 flex justify-end gap-3">

                <button
                    type="button"
                    onclick="tutupModalTambah()"
                    class="px-5 py-2 rounded-xl bg-gray-300 hover:bg-gray-400 transition">

                    Batal

                </button>

                <button
                    type="submit"
                    class="px-5 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white shadow-lg transition">

                    💾 Simpan

                </button>

            </div>

        </form>

    </div>

</div>
{{-- =========================
     MODAL EDIT LOKASI
========================= --}}

<div id="modalEdit"
    class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">

    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-amber-500 to-orange-500 px-6 py-5 text-white">

            <div class="flex items-center justify-between">

                <div>

                    <h2 class="text-xl font-bold">
                        ✏ Edit Lokasi
                    </h2>

                    <p class="text-amber-100 text-sm mt-1">
                        Perbarui nama lokasi fasilitas sekolah.
                    </p>

                </div>

                <button
                    type="button"
                    onclick="tutupModalEdit()"
                    class="text-3xl hover:rotate-90 transition">

                    &times;

                </button>

            </div>

        </div>

        <form
            id="formEdit"
            method="POST">

            @csrf
            @method('PUT')

            <div class="p-6">

                <label class="block font-semibold text-gray-700 mb-2">

                    Nama Lokasi

                </label>

                <input
                    id="editNama"
                    type="text"
                    name="nama_lokasi"
                    class="w-full rounded-xl border-gray-300 focus:ring-amber-500 focus:border-amber-500"
                    required>

                <p class="text-sm text-gray-500 mt-2">

                    Pastikan nama lokasi sudah benar sebelum disimpan.

                </p>

            </div>

            <div class="bg-gray-50 px-6 py-4 flex justify-end gap-3">

                <button
                    type="button"
                    onclick="tutupModalEdit()"
                    class="px-5 py-2 rounded-xl bg-gray-300 hover:bg-gray-400 transition">

                    Batal

                </button>

                <button
                    type="submit"
                    class="px-5 py-2 rounded-xl bg-amber-500 hover:bg-amber-600 text-white shadow-lg transition">

                    💾 Update

                </button>

            </div>

        </form>

    </div>

</div>
{{-- =========================
     MODAL HAPUS LOKASI
========================= --}}

<div id="modalDelete"
    class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">

    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-5 text-white text-center">

            <div class="w-20 h-20 mx-auto rounded-full bg-white/20 flex items-center justify-center text-5xl">

                🗑

            </div>

            <h2 class="mt-4 text-2xl font-bold">

                Hapus Lokasi

            </h2>

            <p class="text-red-100 mt-2">

                Data yang dihapus tidak dapat dikembalikan.

            </p>

        </div>

        {{-- Body --}}
        <div class="p-6 text-center">

            <p class="text-gray-600">

                Apakah Anda yakin ingin menghapus lokasi ini?

            </p>

            <p class="text-sm text-gray-400 mt-2">

                Tindakan ini bersifat permanen.

            </p>

        </div>

        {{-- Footer --}}
        <form id="formDelete" method="POST">

            @csrf
            @method('DELETE')

            <div class="bg-gray-50 px-6 py-4 flex justify-center gap-3">

                <button
                    type="button"
                    onclick="tutupDelete()"
                    class="px-5 py-2 rounded-xl bg-gray-300 hover:bg-gray-400 transition">

                    Batal

                </button>

                <button
                    type="submit"
                    class="px-5 py-2 rounded-xl bg-red-600 hover:bg-red-700 text-white shadow-lg transition">

                    🗑 Ya, Hapus

                </button>

            </div>

        </form>

    </div>

</div>
<script>

function editLokasi(id, nama)
{
    document.getElementById('editNama').value = nama;

    document.getElementById('formEdit').action = "/lokasi/" + id;

    document.getElementById('modalEdit').classList.remove('hidden');
}

function tutupModalEdit()
{
    document.getElementById('modalEdit').classList.add('hidden');
}

function tutupModalTambah()
{
    document.getElementById('modalTambah').classList.add('hidden');
}

function hapusLokasi(id)
{
    document.getElementById('formDelete').action = "/lokasi/" + id;

    document.getElementById('modalDelete').classList.remove('hidden');
}

function tutupDelete()
{
    document.getElementById('modalDelete').classList.add('hidden');
}

</script>

</x-app-layout>