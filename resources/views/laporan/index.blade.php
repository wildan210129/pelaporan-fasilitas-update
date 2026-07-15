<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Laporan Kerusakan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 rounded-lg bg-green-100 border border-green-300 text-green-700 px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg p-6">

                <div class="flex justify-between items-center mb-6">

                    <h3 class="text-xl font-bold">
                        Daftar Laporan Kerusakan
                    </h3>

                   @if(auth()->user()->role == 'siswa')

                <button
                 onclick="document.getElementById('modalTambah').classList.remove('hidden')"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">

                + Tambah Laporan

                </button>

                @endif

                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full border border-gray-300">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="border px-4 py-3">No</th>

                                <th class="border px-4 py-3">Judul</th>

                                <th class="border px-4 py-3">Lokasi</th>

                                <th class="border px-4 py-3">Kategori</th>

                                <th class="border px-4 py-3">Deskripsi</th>

                                <th class="border px-4 py-3">Status</th>

                                <th class="border px-4 py-3">Foto</th>

                                <th class="border px-4 py-3">Aksi</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($laporan as $item)

                                <tr>

                                    <td class="border px-4 py-3 text-center">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="border px-4 py-3">
                                        {{ $item->judul }}
                                    </td>

                                    <td class="border px-4 py-3">
                                        {{ $item->lokasi->nama_lokasi }}
                                    </td>

                                    <td class="border px-4 py-3">
                                        {{ $item->kategori->nama_kategori }}
                                    </td>

                                    <td class="border px-4 py-3">
                                        {{ $item->deskripsi }}
                                    </td>

                                    <td class="border px-4 py-3 text-center">

                                        @if($item->status == 'Menunggu')

                                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                                Menunggu
                                            </span>

                                        @elseif($item->status == 'Diproses')

                                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                                Diproses
                                            </span>

                                        @else

                                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                                Selesai
                                            </span>

                                        @endif

                                    </td>

                                    <td class="border px-4 py-3 text-center">

                                        @if($item->foto)

                                            <img
                                                src="{{ asset('storage/'.$item->foto) }}"
                                                class="w-16 h-16 object-cover rounded mx-auto">

                                        @else

                                            -

                                        @endif

                                    </td>

                                   <td class="border px-4 py-3 text-center space-x-2">

                                 @if(auth()->user()->role == 'admin')

                                 <a
                                    href="{{ route('laporan.show', $item->id) }}"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">

                                    Detail

                                </a>

                                 <button
                                  onclick="editLaporan(
                                    '{{ $item->id }}',
                                     '{{ $item->judul }}',
                                     '{{ $item->lokasi_id }}',
                                    '{{ $item->kategori_kerusakan_id }}',
                                     `{{ $item->deskripsi }}`,
                                     '{{ $item->status }}'
                                    )"
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">

                                      Edit

                                     </button>

                                    <button
                                     onclick="hapusLaporan('{{ $item->id }}')"
                                     class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">

                                     Hapus

                                    </button>

                                    @else

                                    <span class="text-gray-500 text-sm">
                                      Tidak ada aksi
                                    </span>

                                     @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="8" class="border px-4 py-6 text-center text-gray-500">
                                        Belum ada laporan.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </div>

    {{-- Modal Tambah akan ditempel di sini --}}
    <!-- Modal Tambah -->
<div id="modalTambah"
    class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

    <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl">

        <div class="flex justify-between items-center border-b px-6 py-4">
            <h2 class="text-xl font-bold">
                Tambah Laporan Kerusakan
            </h2>

            <button
                type="button"
                onclick="document.getElementById('modalTambah').classList.add('hidden')"
                class="text-2xl text-gray-500 hover:text-gray-700">
                &times;
            </button>
        </div>

        <form action="{{ route('laporan.store') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            <div class="p-6 grid grid-cols-2 gap-4">

                <div class="col-span-2">
                    <label class="block mb-2 font-semibold">
                        Judul Kerusakan
                    </label>

                    <input
                        type="text"
                        name="judul"
                        class="w-full border rounded-lg px-3 py-2"
                        placeholder="Masukkan judul kerusakan"
                        required>
                </div>

                <div>
                    <label class="block mb-2 font-semibold">
                        Lokasi
                    </label>

                    <select
                        name="lokasi_id"
                        class="w-full border rounded-lg px-3 py-2"
                        required>

                        <option value="">-- Pilih Lokasi --</option>

                        @foreach($lokasi as $l)
                            <option value="{{ $l->id }}">
                                {{ $l->nama_lokasi }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div>
                    <label class="block mb-2 font-semibold">
                        Kategori
                    </label>

                    <select
                        name="kategori_kerusakan_id"
                        class="w-full border rounded-lg px-3 py-2"
                        required>

                        <option value="">-- Pilih Kategori --</option>

                        @foreach($kategori as $k)
                            <option value="{{ $k->id }}">
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="col-span-2">
                    <label class="block mb-2 font-semibold">
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi"
                        rows="4"
                        class="w-full border rounded-lg px-3 py-2"
                        placeholder="Jelaskan kerusakan..."
                        required></textarea>
                </div>

                <div class="col-span-2">
                    <label class="block mb-2 font-semibold">
                        Upload Foto
                    </label>

                    <input
                        type="file"
                        name="foto"
                        accept="image/*"
                        class="w-full border rounded-lg px-3 py-2">
                </div>

            </div>

            <div class="flex justify-end gap-2 border-t px-6 py-4">

                <button
                    type="button"
                    onclick="document.getElementById('modalTambah').classList.add('hidden')"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">

                    Batal

                </button>

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">

                    Simpan

                </button>

            </div>

        </form>

    </div>

</div>
    {{-- Modal Edit akan ditempel di sini --}}
    <!-- Modal Edit -->
<div id="modalEdit"
    class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

    <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl">

        <div class="flex justify-between items-center border-b px-6 py-4">
            <h2 class="text-xl font-bold">
                Edit Laporan Kerusakan
            </h2>

            <button
                type="button"
                onclick="tutupModalEdit()"
                class="text-2xl text-gray-500 hover:text-gray-700">
                &times;
            </button>
        </div>

        <form id="formEdit"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="p-6 grid grid-cols-2 gap-4">

                <div class="col-span-2">
                    <label class="block mb-2 font-semibold">
                        Judul Kerusakan
                    </label>

                    <input
                        type="text"
                        id="editJudul"
                        name="judul"
                        class="w-full border rounded-lg px-3 py-2"
                        required>
                </div>

                <div>
                    <label class="block mb-2 font-semibold">
                        Lokasi
                    </label>

                    <select
                        id="editLokasi"
                        name="lokasi_id"
                        class="w-full border rounded-lg px-3 py-2">

                        @foreach($lokasi as $l)
                            <option value="{{ $l->id }}">
                                {{ $l->nama_lokasi }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div>
                    <label class="block mb-2 font-semibold">
                        Kategori
                    </label>

                    <select
                        id="editKategori"
                        name="kategori_kerusakan_id"
                        class="w-full border rounded-lg px-3 py-2">

                        @foreach($kategori as $k)
                            <option value="{{ $k->id }}">
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="col-span-2">
                    <label class="block mb-2 font-semibold">
                        Deskripsi
                    </label>

                    <textarea
                        id="editDeskripsi"
                        name="deskripsi"
                        rows="4"
                        class="w-full border rounded-lg px-3 py-2"
                        required></textarea>
                </div>

                <div class="col-span-2">
                <label class="block mb-2 font-semibold">
                  Status
                 </label>

                    <select
                  id="editStatus"
                 name="status"
                 class="w-full border rounded-lg px-3 py-2">

                <option value="Menunggu">Menunggu</option>
                <option value="Diproses">Diproses</option>
                <option value="Selesai">Selesai</option>

                 </select>
                </div>

                <div class="col-span-2">
                    <label class="block mb-2 font-semibold">
                        Ganti Foto (Opsional)
                    </label>

                    <input
                        type="file"
                        name="foto"
                        accept="image/*"
                        class="w-full border rounded-lg px-3 py-2">
                </div>

            </div>

            <div class="flex justify-end gap-2 border-t px-6 py-4">

                <button
                    type="button"
                    onclick="tutupModalEdit()"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">

                    Batal

                </button>

                <button
                    type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">

                    Update

                </button>

            </div>

        </form>

    </div>

</div>
    {{-- Modal Delete akan ditempel di sini --}}
    <!-- Modal Delete -->
<div id="modalDelete"
    class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

    <div class="bg-white rounded-xl shadow-lg w-full max-w-md">

        <div class="p-6 text-center">

            <div class="mx-auto flex items-center justify-center w-16 h-16 rounded-full bg-red-100">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-8 h-8 text-red-600"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>

                </svg>

            </div>

            <h2 class="mt-4 text-xl font-bold">
                Hapus Laporan
            </h2>

            <p class="mt-2 text-gray-600">
                Apakah Anda yakin ingin menghapus laporan ini?
            </p>

            <form id="formDelete" method="POST">

                @csrf
                @method('DELETE')

                <div class="flex justify-center gap-3 mt-6">

                    <button
                        type="button"
                        onclick="tutupDelete()"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded">

                        Ya, Hapus

                    </button>

                </div>

            </form>

        </div>

    </div>
    <script>

function editLaporan(id, judul, lokasi, kategori, deskripsi, status)
{
    document.getElementById('editJudul').value = judul;
    document.getElementById('editLokasi').value = lokasi;
    document.getElementById('editKategori').value = kategori;
    document.getElementById('editDeskripsi').value = deskripsi;
    document.getElementById('editStatus').value = status;

    document.getElementById('formEdit').action = "/laporan/" + id;

    document.getElementById('modalEdit').classList.remove('hidden');
}

function tutupModalEdit()
{
    document.getElementById('modalEdit').classList.add('hidden');
}

function hapusLaporan(id)
{
    document.getElementById('formDelete').action = "/laporan/" + id;

    document.getElementById('modalDelete').classList.remove('hidden');
}

function tutupDelete()
{
    document.getElementById('modalDelete').classList.add('hidden');
}

</script>

</div>

</x-app-layout>