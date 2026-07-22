<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">

            <div>

                <h2 class="text-2xl md:text-3xl font-bold text-gray-800">

                    🛠 Data Petugas

                </h2>

                <p class="mt-1 text-sm md:text-base text-gray-500">

                    Kelola seluruh petugas yang menangani laporan kerusakan.

                </p>

            </div>

        </div>

    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))

            <div
                class="mb-6 rounded-2xl border border-green-300 bg-green-100 px-5 py-4 text-green-700 shadow-sm">

                {{ session('success') }}

            </div>

            @endif

            <div
                class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-xl">

                {{-- HEADER CARD --}}
                <div
                    class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5 border-b p-5 md:p-6">

                    <div>

                        <h2 class="text-xl md:text-2xl font-bold text-gray-800">

                            Daftar Petugas

                        </h2>

                        <p class="mt-1 text-sm text-gray-500">

                            Kelola seluruh petugas sekolah.

                        </p>

                    </div>

                    {{-- Search + Button --}}
                    <div
                        class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">

                        {{-- Search --}}
                        <div class="relative flex-1">

                            <input
                                id="searchPetugas"
                                type="text"
                                placeholder="Cari petugas..."
                                class="w-full rounded-xl border border-gray-300 py-2.5 pl-10 pr-4 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none">

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
                                    d="M21 21l-5-5m2-5a7 7 0 11-14 0a7 7 0 0114 0z" />

                            </svg>

                        </div>

                        {{-- Button --}}
                        <button
                            type="button"
                            onclick="bukaTambah()"
                            class="w-full sm:w-auto rounded-xl bg-blue-600 px-5 py-2.5 text-white shadow-md hover:bg-blue-700 transition">

                            ➕ Tambah Petugas

                        </button>

                    </div>

                </div>

                {{-- TABLE --}}
                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="bg-gray-100">

                            <tr>

                                <th
                                    class="w-20 px-4 py-4 text-center text-sm font-semibold text-gray-700">

                                    No

                                </th>

                                <th
                                    class="px-6 py-4 text-left text-sm font-semibold text-gray-700">

                                    Informasi Petugas

                                </th>

                                <th
                                    class="px-6 py-4 text-center text-sm font-semibold text-gray-700">

                                    Email

                                </th>

                                <th
                                    class="w-56 px-6 py-4 text-center text-sm font-semibold text-gray-700">

                                    Aksi

                                </th>

                            </tr>

                        </thead>

                        <tbody id="tablePetugas">

                            @forelse($petugas as $item)

                            <tr class="border-b hover:bg-blue-50 transition">

                                {{-- Nomor --}}
                                <td class="px-4 py-4 text-center">

                                    <div
                                        class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 font-bold text-blue-700">

                                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}

                                    </div>

                                </td>

                                {{-- Informasi Petugas --}}
                                <td class="px-6 py-4">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-12 w-12 items-center justify-center rounded-full bg-indigo-100 text-xl">

                                            🛠

                                        </div>

                                        <div>

                                            <h3 class="font-semibold text-gray-800">

                                                {{ $item->name }}

                                            </h3>

                                            <p class="text-sm text-gray-500">

                                                Petugas Sarpras

                                            </p>

                                        </div>

                                    </div>

                                </td>

                                {{-- Email --}}
                                <td class="px-6 py-4 text-center text-gray-600">

                                    {{ $item->email }}

                                </td>

                                {{-- Aksi --}}
                                <td class="px-6 py-4">

                                    <div
                                        class="flex flex-col sm:flex-row justify-center gap-2">

                                        <button
                                            type="button"
                                            onclick="editPetugas(
                                                '{{ $item->id }}',
                                                '{{ $item->name }}',
                                                '{{ $item->email }}'
                                            )"
                                            class="rounded-xl bg-yellow-500 px-4 py-2 text-white shadow hover:bg-yellow-600 transition">

                                            ✏ Edit

                                        </button>

                                        <button
                                            type="button"
                                            onclick="hapusPetugas('{{ $item->id }}')"
                                            class="rounded-xl bg-red-600 px-4 py-2 text-white shadow hover:bg-red-700 transition">

                                            🗑 Hapus

                                        </button>

                                    </div>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="4" class="py-16">

                                    <div class="flex flex-col items-center justify-center">

                                        <div class="text-6xl">

                                            🛠

                                        </div>

                                        <h3 class="mt-4 text-2xl font-bold text-gray-700">

                                            Belum Ada Petugas

                                        </h3>

                                        <p class="mt-2 text-gray-500">

                                            Silakan tambahkan petugas baru.

                                        </p>

                                        <button
                                            type="button"
                                            onclick="bukaTambah()"
                                            class="mt-6 rounded-xl bg-blue-600 px-6 py-3 text-white shadow hover:bg-blue-700 transition">

                                            ➕ Tambah Petugas

                                        </button>

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
     MODAL TAMBAH PETUGAS
========================= --}}

    <div id="modalTambah"
        class="hidden fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto">

        <div
            class="bg-white w-full max-w-2xl max-h-[90vh] rounded-3xl shadow-2xl flex flex-col overflow-hidden">

            {{-- Header --}}
            <div
                class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 md:px-8 py-6 text-white">

                <div class="flex items-center gap-4">

                    <div
                        class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center text-3xl">

                        🛠

                    </div>

                    <div>

                        <h2 class="text-2xl md:text-3xl font-bold">

                            Tambah Petugas

                        </h2>

                        <p class="text-blue-100 mt-1">

                            Tambahkan petugas baru ke dalam sistem.

                        </p>

                    </div>

                </div>

            </div>

            <form
                action="{{ route('petugas.store') }}"
                method="POST"
                class="flex flex-col flex-1">

                @csrf

                <div class="flex-1 overflow-y-auto p-6 md:p-8 space-y-6">

                    {{-- Nama --}}
                    <div>

                        <label class="block mb-2 font-semibold text-gray-700">

                            Nama Petugas

                        </label>

                        <input
                            type="text"
                            name="name"
                            class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan nama petugas"
                            required>

                    </div>

                    {{-- Email --}}
                    <div>

                        <label class="block mb-2 font-semibold text-gray-700">

                            Email

                        </label>

                        <input
                            type="email"
                            name="email"
                            class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="contoh@email.com"
                            required>

                    </div>

                    {{-- Password --}}
                    <div>

                        <label class="block mb-2 font-semibold text-gray-700">

                            Password

                        </label>

                        <input
                            type="password"
                            name="password"
                            class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan password"
                            required>

                    </div>

                </div>

                {{-- Footer --}}
                <div
                    class="bg-gray-50 border-t px-6 py-4 flex flex-col-reverse sm:flex-row justify-end gap-3">

                    <button
                        type="button"
                        onclick="tutupTambah()"
                        class="w-full sm:w-auto px-6 py-3 rounded-xl bg-gray-300 hover:bg-gray-400 transition">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="w-full sm:w-auto px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white shadow-lg transition">

                        💾 Simpan Petugas

                    </button>

                </div>

            </form>

        </div>

    </div>
    {{-- =========================
     MODAL EDIT PETUGAS
========================= --}}

    <div id="modalEdit"
        class="hidden fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto">

        <div
            class="bg-white w-full max-w-2xl max-h-[90vh] rounded-3xl shadow-2xl flex flex-col overflow-hidden">

            {{-- Header --}}
            <div
                class="bg-gradient-to-r from-yellow-500 to-orange-500 px-6 md:px-8 py-6 text-white">

                <div class="flex items-center gap-4">

                    <div
                        class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center text-3xl">

                        ✏

                    </div>

                    <div>

                        <h2 class="text-2xl md:text-3xl font-bold">

                            Edit Petugas

                        </h2>

                        <p class="text-yellow-100 mt-1">

                            Perbarui informasi petugas.

                        </p>

                    </div>

                </div>

            </div>

            <form
                id="formEdit"
                method="POST"
                class="flex flex-col flex-1">

                @csrf
                @method('PUT')

                <div class="flex-1 overflow-y-auto p-6 md:p-8 space-y-6">

                    {{-- Nama --}}
                    <div>

                        <label class="block mb-2 font-semibold text-gray-700">

                            Nama Petugas

                        </label>

                        <input
                            type="text"
                            id="editNama"
                            name="name"
                            class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                            required>

                    </div>

                    {{-- Email --}}
                    <div>

                        <label class="block mb-2 font-semibold text-gray-700">

                            Email

                        </label>

                        <input
                            type="email"
                            id="editEmail"
                            name="email"
                            class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                            required>

                    </div>

                    {{-- Password --}}
                    <div>

                        <label class="block mb-2 font-semibold text-gray-700">

                            Password Baru

                        </label>

                        <input
                            type="password"
                            name="password"
                            placeholder="Kosongkan jika tidak diubah"
                            class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">

                        <p class="mt-2 text-sm text-gray-500">

                            Biarkan kosong jika password tidak ingin diganti.

                        </p>

                    </div>

                </div>

                {{-- Footer --}}
                <div
                    class="bg-gray-50 border-t px-6 py-4 flex flex-col-reverse sm:flex-row justify-end gap-3">

                    <button
                        type="button"
                        onclick="tutupModalEdit()"
                        class="w-full sm:w-auto px-6 py-3 rounded-xl bg-gray-300 hover:bg-gray-400 transition">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="w-full sm:w-auto px-6 py-3 rounded-xl bg-yellow-500 hover:bg-yellow-600 text-white shadow-lg transition">

                        ✏ Update Petugas

                    </button>

                </div>

            </form>

        </div>

    </div>
    {{-- =========================
     MODAL HAPUS PETUGAS
========================= --}}

    <div id="modalDelete"
        class="hidden fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto">

        <div
            class="bg-white w-full max-w-md rounded-3xl shadow-2xl overflow-hidden">

            {{-- Header --}}
            <div
                class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-6 text-center text-white">

                <div
                    class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-white/20 text-5xl">

                    🗑

                </div>

                <h2 class="mt-5 text-2xl font-bold">

                    Hapus Petugas

                </h2>

                <p class="mt-2 text-red-100">

                    Data petugas yang dihapus tidak dapat dikembalikan.

                </p>

            </div>

            {{-- Body --}}
            <div class="px-6 py-8 text-center">

                <div
                    class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-red-100 text-3xl">

                    ⚠️

                </div>

                <h3 class="text-lg font-semibold text-gray-800">

                    Apakah Anda yakin?

                </h3>

                <p class="mt-2 text-sm text-gray-500 leading-relaxed">

                    Petugas yang dipilih akan dihapus secara permanen
                    dan tidak dapat dikembalikan lagi.

                </p>

            </div>

            <form id="formDelete" method="POST">

                @csrf
                @method('DELETE')

                {{-- Footer --}}
                <div
                    class="bg-gray-50 border-t px-6 py-5 flex flex-col-reverse sm:flex-row justify-center gap-3">

                    <button
                        type="button"
                        onclick="tutupDelete()"
                        class="w-full sm:w-auto px-6 py-3 rounded-xl bg-gray-300 hover:bg-gray-400 transition">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="w-full sm:w-auto px-6 py-3 rounded-xl bg-red-600 hover:bg-red-700 text-white shadow-lg transition">

                        🗑 Ya, Hapus

                    </button>

                </div>

            </form>

        </div>

    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // ===========================
            // SEARCH PETUGAS
            // ===========================

            const search = document.getElementById("searchPetugas");

            if (search) {

                search.addEventListener("keyup", function() {

                    let value = this.value.toLowerCase();

                    document.querySelectorAll("#tablePetugas tr").forEach(function(row) {

                        row.style.display = row.innerText.toLowerCase().includes(value) ?
                            "" :
                            "none";

                    });

                });

            }

        });


        /* ===========================
           MODAL TAMBAH
        =========================== */

        function bukaTambah() {

            document.body.classList.add("overflow-hidden");

            document.getElementById("modalTambah").classList.remove("hidden");

        }

        function tutupTambah() {

            document.body.classList.remove("overflow-hidden");

            document.getElementById("modalTambah").classList.add("hidden");

        }


        /* ===========================
           MODAL EDIT
        =========================== */

        function editPetugas(id, nama, email) {

            document.getElementById("editNama").value = nama;

            document.getElementById("editEmail").value = email;

            document.getElementById("formEdit").action = "/petugas/" + id;

            document.body.classList.add("overflow-hidden");

            document.getElementById("modalEdit").classList.remove("hidden");

        }

        function tutupModalEdit() {

            document.body.classList.remove("overflow-hidden");

            document.getElementById("modalEdit").classList.add("hidden");

        }


        /* ===========================
           MODAL DELETE
        =========================== */

        function hapusPetugas(id) {

            document.getElementById("formDelete").action = "/petugas/" + id;

            document.body.classList.add("overflow-hidden");

            document.getElementById("modalDelete").classList.remove("hidden");

        }

        function tutupDelete() {

            document.body.classList.remove("overflow-hidden");

            document.getElementById("modalDelete").classList.add("hidden");

        }


        /* ===========================
           TUTUP MODAL SAAT KLIK BACKDROP
        =========================== */

        ["modalTambah", "modalEdit", "modalDelete"].forEach(function(id) {

            const modal = document.getElementById(id);

            if (!modal) return;

            modal.addEventListener("click", function(e) {

                if (e.target === modal) {

                    modal.classList.add("hidden");

                    document.body.classList.remove("overflow-hidden");

                }

            });

        });


        /* ===========================
           ESC KEY
        =========================== */

        document.addEventListener("keydown", function(e) {

            if (e.key !== "Escape") return;

            document.body.classList.remove("overflow-hidden");

            ["modalTambah", "modalEdit", "modalDelete"].forEach(function(id) {

                const modal = document.getElementById(id);

                if (modal) {

                    modal.classList.add("hidden");

                }

            });

        });
    </script>

</x-app-layout>