<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-3xl font-bold text-gray-800">

                    📋 Data Laporan Kerusakan

                </h2>

                <p class="text-gray-500 mt-1">

                    Kelola seluruh laporan kerusakan fasilitas sekolah.

                </p>

            </div>

            <div>

                <span
                    class="px-4 py-2 rounded-full bg-blue-100 text-blue-700 font-semibold">

                    {{ now()->format('d F Y') }}

                </span>

            </div>

        </div>

    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))

            <div
                class="mb-6 rounded-xl bg-green-50 border border-green-300 text-green-700 px-5 py-4 shadow">

                <div class="flex items-center gap-3">

                    <div class="text-2xl">

                        ✅

                    </div>

                    <div>

                        {{ session('success') }}

                    </div>

                </div>

            </div>

            @endif

            <!-- HERO -->

            <div
                class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 rounded-3xl shadow-xl p-8 text-white">

                <div class="flex flex-col lg:flex-row items-center justify-between">

                    <div>

                        <h1 class="text-4xl font-bold">

                            🛠 Sistem Pelaporan Kerusakan

                        </h1>

                        <p class="mt-3 text-blue-100 max-w-xl">

                            Kelola seluruh laporan kerusakan fasilitas sekolah dengan
                            lebih cepat, modern, dan efisien.

                        </p>

                    </div>

                    @if(auth()->user()->role=='siswa')

                    <button

                        onclick="document.getElementById('modalTambah').classList.remove('hidden')"

                        class="mt-6 lg:mt-0 bg-white text-blue-700 px-6 py-3 rounded-xl font-bold hover:scale-105 transition shadow-lg">

                        ➕ Tambah Laporan

                    </button>

                    @endif

                </div>

            </div>

            <!-- Statistik -->

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">

                <div
                    class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-blue-500">

                    <p class="text-gray-500">

                        Total Laporan

                    </p>

                    <h2 class="text-4xl font-bold mt-3">

                        {{ $laporan->count() }}

                    </h2>

                </div>

                <div
                    class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-yellow-500">

                    <p class="text-gray-500">

                        Menunggu

                    </p>

                    <h2 class="text-4xl font-bold mt-3 text-yellow-600">

                        {{ $laporan->where('status','Menunggu')->count() }}

                    </h2>

                </div>

                <div
                    class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-green-500">

                    <p class="text-gray-500">

                        Selesai

                    </p>

                    <h2 class="text-4xl font-bold mt-3 text-green-600">

                        {{ $laporan->where('status','Selesai')->count() }}

                    </h2>

                </div>

            </div>

            <!-- CARD TABEL -->

            <div class="bg-white rounded-3xl shadow-xl mt-8 overflow-hidden">

                <div
                    class="flex flex-col lg:flex-row justify-between items-center px-8 py-6 border-b">

                    <div>

                        <h2 class="text-2xl font-bold">

                            Daftar Laporan

                        </h2>

                        <p class="text-gray-500">

                            Seluruh data laporan kerusakan fasilitas.

                        </p>

                    </div>

                    <div class="mt-4 lg:mt-0">

                        <input

                            type="text"

                            placeholder="🔍 Cari laporan..."

                            class="rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 w-72">

                    </div>

                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="px-6 py-4 text-left">

                                    No

                                </th>

                                <th class="px-6 py-4 text-left">

                                    Judul

                                </th>

                                <th class="px-6 py-4 text-left">

                                    Lokasi

                                </th>

                                <th class="px-6 py-4 text-left">

                                    Kategori

                                </th>

                                <th class="px-6 py-4 text-left">

                                    Status

                                </th>

                                <th class="px-6 py-4 text-center">

                                    Foto

                                </th>

                                <th class="px-6 py-4 text-center">

                                    Aksi

                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($laporan as $item)

                            <tr class="border-b hover:bg-blue-50 transition duration-200">

                                <td class="px-6 py-5 font-semibold text-gray-600">

                                    {{ $loop->iteration }}

                                </td>

                                <td class="px-6 py-5">

                                    <div>

                                        <h3 class="font-bold text-gray-800">

                                            {{ $item->judul }}

                                        </h3>

                                        <p class="text-sm text-gray-500 mt-1">

                                            {{ Str::limit($item->deskripsi,60) }}

                                        </p>

                                    </div>

                                </td>

                                <td class="px-6 py-5">

                                    <span
                                        class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-sm">

                                        📍 {{ $item->lokasi->nama_lokasi }}

                                    </span>

                                </td>

                                <td class="px-6 py-5">

                                    <span
                                        class="px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 text-sm">

                                        {{ $item->kategori->nama_kategori }}

                                    </span>

                                </td>

                                <td class="px-6 py-5">

                                    @if($item->status=="Menunggu")

                                    <span
                                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 text-sm font-semibold">

                                        🟡 Menunggu

                                    </span>

                                    @elseif($item->status=="Diproses")

                                    <span
                                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-100 text-blue-700 text-sm font-semibold">

                                        🔵 Diproses

                                    </span>

                                    @else

                                    <span
                                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm font-semibold">

                                        🟢 Selesai

                                    </span>

                                    @endif

                                </td>

                                <td class="px-6 py-5 text-center">

                                    @if($item->foto)

                                    <img

                                        src="{{ asset('storage/'.$item->foto) }}"

                                        class="w-20 h-20 object-cover rounded-2xl border shadow mx-auto hover:scale-110 transition cursor-pointer">

                                    @else

                                    <div
                                        class="w-20 h-20 rounded-2xl bg-gray-100 flex items-center justify-center mx-auto text-gray-400">

                                        📷

                                    </div>

                                    @endif

                                </td>

                                <td class="px-6 py-5">

                                    <div class="flex justify-center gap-2">

                                        <a

                                            href="{{ route('laporan.show',$item->id) }}"

                                            class="px-4 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition">

                                            Detail

                                        </a>

                                        @if(auth()->user()->role=="admin")

                                        <button

                                            onclick="editLaporan(

'{{ $item->id }}',

'{{ $item->judul }}',

'{{ $item->lokasi_id }}',

'{{ $item->kategori_kerusakan_id }}',

`{{ $item->deskripsi }}`,

'{{ $item->status }}',

'{{ $item->petugas_id }}'

)"

                                            class="px-4 py-2 rounded-xl bg-yellow-500 text-white hover:bg-yellow-600 transition">

                                            Edit

                                        </button>

                                        <button

                                            onclick="hapusLaporan('{{ $item->id }}')"

                                            class="px-4 py-2 rounded-xl bg-red-600 text-white hover:bg-red-700 transition">

                                            Hapus

                                        </button>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td

                                    colspan="7"

                                    class="text-center py-20">

                                    <div class="flex flex-col items-center">

                                        <div class="text-6xl">

                                            📂

                                        </div>

                                        <h3 class="text-2xl font-bold mt-4">

                                            Belum Ada Laporan

                                        </h3>

                                        <p class="text-gray-500 mt-2">

                                            Silakan membuat laporan baru.

                                        </p>

                                    </div>

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- ===================== -->
            <!-- MODAL TAMBAH LAPORAN -->
            <!-- ===================== -->

            <div id="modalTambah"
                class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">

                <div class="bg-white rounded-3xl shadow-2xl w-full max-w-3xl overflow-hidden animate-fade">

                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6 flex justify-between items-center">

                        <div>

                            <h2 class="text-2xl font-bold text-white">

                                ➕ Tambah Laporan

                            </h2>

                            <p class="text-blue-100 mt-1">

                                Silakan isi data laporan kerusakan.

                            </p>

                        </div>

                        <button

                            type="button"

                            onclick="document.getElementById('modalTambah').classList.add('hidden')"

                            class="text-white text-3xl hover:rotate-90 transition">

                            &times;

                        </button>

                    </div>

                    <form
                        action="{{ route('laporan.store') }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div class="md:col-span-2">

                                <label class="font-semibold text-gray-700">

                                    Judul Kerusakan

                                </label>

                                <input

                                    type="text"

                                    name="judul"

                                    required

                                    placeholder="Contoh : Proyektor Rusak"

                                    class="mt-2 w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            </div>

                            <div>

                                <label class="font-semibold text-gray-700">

                                    Lokasi

                                </label>

                                <select

                                    name="lokasi_id"

                                    required

                                    class="mt-2 w-full rounded-xl border-gray-300 focus:border-blue-500">

                                    <option value="">

                                        Pilih Lokasi

                                    </option>

                                    @foreach($lokasi as $l)

                                    <option value="{{ $l->id }}">

                                        {{ $l->nama_lokasi }}

                                    </option>

                                    @endforeach

                                </select>

                            </div>

                            <div>

                                <label class="font-semibold text-gray-700">

                                    Kategori

                                </label>

                                <select

                                    name="kategori_kerusakan_id"

                                    required

                                    class="mt-2 w-full rounded-xl border-gray-300 focus:border-blue-500">

                                    <option value="">

                                        Pilih Kategori

                                    </option>

                                    @foreach($kategori as $k)

                                    <option value="{{ $k->id }}">

                                        {{ $k->nama_kategori }}

                                    </option>

                                    @endforeach

                                </select>

                            </div>

                            <div class="md:col-span-2">

                                <label class="font-semibold text-gray-700">

                                    Deskripsi

                                </label>

                                <textarea

                                    name="deskripsi"

                                    rows="5"

                                    required

                                    placeholder="Jelaskan kerusakan..."

                                    class="mt-2 w-full rounded-xl border-gray-300 focus:border-blue-500"></textarea>

                            </div>

                            <div class="md:col-span-2">

                                <label class="font-semibold text-gray-700">

                                    Upload Foto

                                </label>

                                <input

                                    type="file"

                                    name="foto"

                                    accept="image/*"

                                    class="mt-2 w-full rounded-xl border-gray-300">

                                <p class="text-sm text-gray-500 mt-2">

                                    Format JPG, JPEG, PNG maksimal 2 MB.

                                </p>

                            </div>

                        </div>

                        <div class="bg-gray-50 px-8 py-5 flex justify-end gap-3">

                            <button

                                type="button"

                                onclick="document.getElementById('modalTambah').classList.add('hidden')"

                                class="px-6 py-3 rounded-xl bg-gray-200 hover:bg-gray-300 font-semibold">

                                Batal

                            </button>

                            <button

                                type="submit"

                                class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-lg">

                                💾 Simpan Laporan

                            </button>

                        </div>

                    </form>

                </div>

            </div>

            <!-- ===================== -->
            <!-- MODAL EDIT LAPORAN -->
            <!-- ===================== -->

            <div id="modalEdit"
                class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 overflow-y-auto">
                <div class="bg-white rounded-3xl shadow-2xl w-full max-w-3xl overflow-hidden">

                    <div class="bg-gradient-to-r from-yellow-500 to-orange-500 px-8 py-6 flex justify-between items-center">

                        <div>

                            <h2 class="text-2xl font-bold text-white">

                                ✏ Edit Laporan

                            </h2>

                            <p class="text-yellow-100 mt-1">

                                Perbarui informasi laporan kerusakan.

                            </p>

                        </div>

                        <button

                            type="button"

                            onclick="tutupModalEdit()"

                            class="text-white text-3xl hover:rotate-90 transition">

                            &times;

                        </button>

                    </div>

                    <form
                        id="formEdit"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div class="md:col-span-2">

                                <label class="font-semibold text-gray-700">

                                    Judul Kerusakan

                                </label>

                                <input

                                    id="editJudul"

                                    type="text"

                                    name="judul"

                                    required

                                    class="mt-2 w-full rounded-xl border-gray-300 focus:ring-yellow-500 focus:border-yellow-500">

                            </div>

                            <div>

                                <label class="font-semibold text-gray-700">

                                    Lokasi

                                </label>

                                <select

                                    id="editLokasi"

                                    name="lokasi_id"

                                    class="mt-2 w-full rounded-xl border-gray-300">

                                    @foreach($lokasi as $l)

                                    <option value="{{ $l->id }}">

                                        {{ $l->nama_lokasi }}

                                    </option>

                                    @endforeach

                                </select>

                            </div>

                            <div>

                                <label class="font-semibold text-gray-700">

                                    Kategori

                                </label>

                                <select

                                    id="editKategori"

                                    name="kategori_kerusakan_id"

                                    class="mt-2 w-full rounded-xl border-gray-300">

                                    @foreach($kategori as $k)

                                    <option value="{{ $k->id }}">

                                        {{ $k->nama_kategori }}

                                    </option>

                                    @endforeach

                                </select>

                            </div>

                            <div class="md:col-span-2">

                                <label class="font-semibold text-gray-700">

                                    Deskripsi

                                </label>

                                <textarea

                                    id="editDeskripsi"

                                    name="deskripsi"

                                    rows="5"

                                    class="mt-2 w-full rounded-xl border-gray-300"></textarea>

                            </div>

                            <div>

                                <label class="font-semibold text-gray-700">

                                    Status

                                </label>

                                <select

                                    id="editStatus"

                                    name="status"

                                    class="mt-2 w-full rounded-xl border-gray-300">

                                    <option value="Menunggu">

                                        Menunggu

                                    </option>

                                    <option value="Diproses">

                                        Diproses

                                    </option>

                                    <option value="Selesai">

                                        Selesai

                                    </option>

                                </select>

                            </div>

                            <div>

                                <label class="font-semibold text-gray-700">

                                    Petugas

                                </label>

                                <select

                                    id="editPetugas"

                                    name="petugas_id"

                                    class="mt-2 w-full rounded-xl border-gray-300">

                                    <option value="">

                                        Pilih Petugas

                                    </option>

                                    @foreach($petugas as $p)

                                    <option value="{{ $p->id }}">

                                        {{ $p->name }}

                                    </option>

                                    @endforeach

                                </select>

                            </div>

                            <div class="md:col-span-2">

                                <label class="font-semibold text-gray-700">

                                    Ganti Foto

                                </label>

                                <input

                                    type="file"

                                    name="foto"

                                    accept="image/*"

                                    class="mt-2 w-full rounded-xl border-gray-300">

                            </div>

                        </div>

                        <div class="bg-gray-50 px-8 py-5 flex justify-end gap-3">

                            <button

                                type="button"

                                onclick="tutupModalEdit()"

                                class="px-6 py-3 rounded-xl bg-gray-300 hover:bg-gray-400">

                                Batal

                            </button>

                            <button

                                type="submit"

                                class="px-6 py-3 rounded-xl bg-yellow-500 hover:bg-yellow-600 text-white font-bold shadow-lg">

                                💾 Update Laporan

                            </button>

                        </div>

                    </form>

                </div>

            </div>

            <!-- ===================== -->
            <!-- MODAL DELETE -->
            <!-- ===================== -->

            <div id="modalDelete"
                class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">

                <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden">

                    <div class="bg-red-600 p-6 text-center">

                        <div class="text-6xl">

                            🗑

                        </div>

                        <h2 class="text-2xl font-bold text-white mt-3">

                            Hapus Laporan

                        </h2>

                        <p class="text-red-100 mt-2">

                            Data yang dihapus tidak dapat dikembalikan.

                        </p>

                    </div>

                    <form id="formDelete" method="POST">

                        @csrf
                        @method('DELETE')

                        <div class="p-8 text-center">

                            <p class="text-gray-600">

                                Apakah Anda yakin ingin menghapus laporan ini?

                            </p>

                            <div class="flex justify-center gap-4 mt-8">

                                <button

                                    type="button"

                                    onclick="tutupDelete()"

                                    class="px-6 py-3 rounded-xl bg-gray-200 hover:bg-gray-300">

                                    Batal

                                </button>

                                <button

                                    type="submit"

                                    class="px-6 py-3 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold">

                                    Ya, Hapus

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

            <script>
                function editLaporan(
                    id,
                    judul,
                    lokasi,
                    kategori,
                    deskripsi,
                    status,
                    petugas
                ) {

                    document.getElementById('editJudul').value = judul;
                    document.getElementById('editLokasi').value = lokasi;
                    document.getElementById('editKategori').value = kategori;
                    document.getElementById('editDeskripsi').value = deskripsi;
                    document.getElementById('editStatus').value = status;
                    document.getElementById('editPetugas').value = petugas;

                    document.getElementById('formEdit').action = "/laporan/" + id;

                    document.getElementById('modalEdit').classList.remove('hidden');

                }

                function tutupModalEdit() {

                    document.getElementById('modalEdit').classList.add('hidden');

                }

                function hapusLaporan(id) {

                    document.getElementById('formDelete').action = "/laporan/" + id;

                    document.getElementById('modalDelete').classList.remove('hidden');

                }

                function tutupDelete() {

                    document.getElementById('modalDelete').classList.add('hidden');

                }

                // klik area hitam untuk menutup modal
                window.onclick = function(e) {

                    const tambah = document.getElementById('modalTambah');
                    const edit = document.getElementById('modalEdit');
                    const hapus = document.getElementById('modalDelete');

                    if (e.target === tambah)
                        tambah.classList.add('hidden');

                    if (e.target === edit)
                        edit.classList.add('hidden');

                    if (e.target === hapus)
                        hapus.classList.add('hidden');

                }
            </script>

            <style>
                @keyframes fadeScale {

                    0% {

                        opacity: 0;
                        transform: scale(.95);

                    }

                    100% {

                        opacity: 1;
                        transform: scale(1);

                    }

                }

                .animate-fade {

                    animation: fadeScale .25s ease;

                }
            </style>

        </div>

</x-app-layout>