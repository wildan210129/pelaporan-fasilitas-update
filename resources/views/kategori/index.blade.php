<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>

                <h2 class="text-2xl md:text-3xl font-bold text-gray-800">

                    🗂 Data Kategori Kerusakan

                </h2>

                <p class="text-gray-500 mt-1">

                    Kelola semua kategori kerusakan fasilitas sekolah.

                </p>

            </div>

        </div>

    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))

            <div class="mb-6 rounded-xl bg-green-100 border border-green-300 text-green-700 px-5 py-4">

                {{ session('success') }}

            </div>

            @endif

            <div class="bg-white rounded-2xl shadow-lg border border-gray-200">

                <div class="p-6 border-b flex flex-col md:flex-row md:justify-between md:items-center gap-4">

                    <div>

                        <h2 class="text-2xl font-bold text-gray-800">

                            Kategori Kerusakan

                        </h2>

                        <p class="text-gray-500">

                            Kelola kategori yang digunakan saat membuat laporan.

                        </p>

                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">

                        <div class="relative flex-1">

                            <input
                                id="searchKategori"
                                type="text"
                                placeholder="Cari kategori..."
                                class="w-full sm:w-64 pl-10 pr-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 absolute left-3 top-2.5 text-gray-400"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M21 21l-5-5m2-5a7 7 0 11-14 0a7 7 0 0114 0z" />

                            </svg>

                        </div>

                        <button
                            onclick="document.getElementById('modalTambah').classList.remove('hidden')"
                            class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow">

                            + Tambah Kategori

                        </button>

                    </div>

                </div>
                {{-- =========================
     TABEL KATEGORI
========================= --}}

                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="bg-gray-100 text-gray-700">

                            <tr>

                                <th class="px-4 py-4 text-center w-24">

                                    No

                                </th>

                                <th class="px-4 py-4 text-left">

                                    Nama Kategori

                                </th>

                                <th class="px-4 py-4 text-center sm:w-52">

                                    Aksi

                                </th>

                            </tr>

                        </thead>

                        <tbody id="tableKategori">

                            @forelse($kategori as $item)

                            <tr class="border-b hover:bg-blue-50 transition duration-200">

                                <td class="px-6 py-4 text-center">

                                    <div class="inline-flex items-center justify-center
                            w-10 h-10 rounded-full
                            bg-blue-100 text-blue-700 font-bold">

                                        {{ str_pad($loop->iteration,2,'0',STR_PAD_LEFT) }}

                                    </div>

                                </td>

                                <td class="px-6 py-4">

                                    <div class="flex items-center gap-3">

                                        <div class=w-9 h-9 md:w-10 md:h-10 rounded-full
                                            bg-red-100
                                            flex items-center justify-center">

                                            🛠

                                        </div>

                                        <div>

                                            <h3 class="font-semibold text-gray-800">

                                                {{ $item->nama_kategori }}

                                            </h3>

                                            <p class="text-sm text-gray-400">

                                                Kategori Kerusakan

                                            </p>

                                        </div>

                                    </div>

                                </td>

                                <td class="px-6 py-4">

                                    <div class="flex flex-col sm:flex-row justify-center gap-2">

                                        <button
                                            onclick="editKategori(
                            '{{ $item->id }}',
                            '{{ $item->nama_kategori }}'
                        )"
                                            class="bg-yellow-500 hover:bg-yellow-600
                               text-white w-full sm:w-auto px-3 py-2 text-sm md:px-4 md:text-base rounded-lg
                               shadow">

                                            ✏ Edit

                                        </button>

                                        <button
                                            onclick="hapusKategori('{{ $item->id }}')"
                                            class="bg-red-600 hover:bg-red-700
                               text-white w-full sm:w-auto px-3 py-2 text-sm md:px-4 md:text-base rounded-lg
                               shadow">

                                            🗑 Hapus

                                        </button>

                                    </div>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="3" class="py-16 text-center">

                                    <div class="flex flex-col items-center">

                                        <div class="text-6xl">

                                            📂

                                        </div>

                                        <h3 class="mt-4 text-xl font-bold text-gray-700">

                                            Belum Ada Kategori

                                        </h3>

                                        <p class="text-gray-500">

                                            Silakan tambahkan kategori baru.

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
     MODAL TAMBAH KATEGORI
========================= --}}

    <div id="modalTambah"
        class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">

        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden">

            {{-- Header --}}
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-5 text-white">

                <h2 class="text-2xl font-bold">

                    ➕ Tambah Kategori

                </h2>

                <p class="text-blue-100 mt-1">

                    Tambahkan kategori kerusakan baru.

                </p>

            </div>

            <form action="{{ route('kategori.store') }}" method="POST">

                @csrf

                <div class="p-6">

                    <label class="block mb-2 font-semibold text-gray-700">

                        Nama Kategori

                    </label>

                    <input
                        type="text"
                        name="nama_kategori"
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Contoh : Kerusakan Ringan"
                        required>

                </div>

                <div class="bg-gray-50 px-6 py-4 flex justify-end gap-3">

                    <button
                        type="button"
                        onclick="document.getElementById('modalTambah').classList.add('hidden')"
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
     MODAL EDIT KATEGORI
========================= --}}

    <div id="modalEdit"
        class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">

        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden">

            {{-- Header --}}
            <div class="bg-gradient-to-r from-yellow-500 to-orange-500 px-6 py-5 text-white">

                <h2 class="text-2xl font-bold">

                    ✏ Edit Kategori

                </h2>

                <p class="text-yellow-100 mt-1">

                    Ubah nama kategori kerusakan.

                </p>

            </div>

            <form
                id="formEdit"
                method="POST">

                @csrf
                @method('PUT')

                <div class="p-6">

                    <label class="block mb-2 font-semibold text-gray-700">

                        Nama Kategori

                    </label>

                    <input
                        type="text"
                        id="editNama"
                        name="nama_kategori"
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                        required>

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
                        class="px-5 py-2 rounded-xl bg-yellow-500 hover:bg-yellow-600 text-white shadow-lg transition">

                        ✏ Update

                    </button>

                </div>

            </form>

        </div>

    </div>
    {{-- =========================
     MODAL HAPUS KATEGORI
========================= --}}

    <div id="modalDelete"
        class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">

        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">

            <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-5 text-white text-center">

                <div class="w-20 h-20 mx-auto rounded-full bg-white/20 flex items-center justify-center text-5xl">

                    🗑

                </div>

                <h2 class="mt-4 text-2xl font-bold">

                    Hapus Kategori

                </h2>

                <p class="text-red-100 mt-2">

                    Data yang dihapus tidak dapat dikembalikan.

                </p>

            </div>

            <div class="p-6 text-center">

                <p class="text-gray-600">

                    Apakah Anda yakin ingin menghapus kategori ini?

                </p>

            </div>

            <form id="formDelete" method="POST">

                @csrf
                @method('DELETE')

                <div class="bg-gray-50 px-6 py-4 flex justify-center gap-3">

                    <button
                        type="button"
                        onclick="tutupDelete()"
                        class="px-5 py-2 rounded-xl bg-gray-300 hover:bg-gray-400">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="px-5 py-2 rounded-xl bg-red-600 hover:bg-red-700 text-white">

                        🗑 Ya, Hapus

                    </button>

                </div>

            </form>

        </div>

    </div>

    <script>
        // =====================
        // SEARCH
        // =====================

        document.getElementById("searchKategori").addEventListener("keyup", function() {

            let value = this.value.toLowerCase();

            let rows = document.querySelectorAll("#tableKategori tr");

            rows.forEach(function(row) {

                row.style.display =
                    row.innerText.toLowerCase().includes(value) ?
                    "" :
                    "none";

            });

        });


        // =====================
        // EDIT
        // =====================

        function editKategori(id, nama) {
            document.getElementById("editNama").value = nama;

            document.getElementById("formEdit").action = "/kategori/" + id;

            document.getElementById("modalEdit").classList.remove("hidden");
        }

        function tutupModalEdit() {
            document.getElementById("modalEdit").classList.add("hidden");
        }


        // =====================
        // DELETE
        // =====================

        function hapusKategori(id) {
            document.getElementById("formDelete").action = "/kategori/" + id;

            document.getElementById("modalDelete").classList.remove("hidden");
        }

        function tutupDelete() {
            document.getElementById("modalDelete").classList.add("hidden");
        }
    </script>

</x-app-layout>