<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Kategori Kerusakan
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg p-6">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">
                        Daftar Kategori Kerusakan
                    </h3>

                    <button
                        onclick="document.getElementById('modalTambah').classList.remove('hidden')"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        + Tambah Kategori
                    </button>
                </div>

                <table class="w-full border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2">No</th>
                            <th class="border px-4 py-2">Nama Kategori</th>
                            <th class="border px-4 py-2">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($kategori as $item)
                            <tr>
                                <td class="border px-4 py-2">{{ $loop->iteration }}</td>

                                <td class="border px-4 py-2">
                                    {{ $item->nama_kategori }}
                                </td>

                                <td class="border px-4 py-2">

                                    <button
                                        onclick="editKategori('{{ $item->id }}','{{ $item->nama_kategori }}')"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                                        Edit
                                    </button>

                                    <button
                                        onclick="hapusKategori('{{ $item->id }}')"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                        Hapus
                                    </button>

                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4">
                                    Belum ada data kategori.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>

        </div>
    </div>

    {{-- Modal Tambah --}}
    <div id="modalTambah"
    class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

    <div class="bg-white rounded-lg shadow-lg w-full max-w-md">

        <div class="flex justify-between items-center border-b px-6 py-4">
            <h2 class="text-lg font-bold">Tambah Kategori</h2>

            <button
                onclick="document.getElementById('modalTambah').classList.add('hidden')"
                class="text-gray-500 text-2xl">
                &times;
            </button>
        </div>

        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf

            <div class="p-6">
                <label class="block mb-2 font-semibold">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    name="nama_kategori"
                    class="w-full border rounded-lg px-3 py-2"
                    required>
            </div>

            <div class="flex justify-end gap-2 px-6 py-4 border-t">
                <button
                    type="button"
                    onclick="document.getElementById('modalTambah').classList.add('hidden')"
                    class="bg-gray-500 text-white px-4 py-2 rounded">
                    Batal
                </button>

                <button
                    type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded">
                    Simpan
                </button>
            </div>

        </form>

    </div>

</div>
    {{-- Modal Edit --}}
    <!-- Modal Edit -->
<div id="modalEdit"
    class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

    <div class="bg-white rounded-lg shadow-lg w-full max-w-md">

        <div class="flex justify-between items-center border-b px-6 py-4">
            <h2 class="text-lg font-bold">Edit Kategori</h2>

            <button
                type="button"
                onclick="tutupModalEdit()"
                class="text-2xl text-gray-500">
                &times;
            </button>
        </div>

        <form id="formEdit" method="POST">
            @csrf
            @method('PUT')

            <div class="p-6">

                <label class="block mb-2 font-semibold">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    id="editNamaKategori"
                    name="nama_kategori"
                    class="w-full border rounded-lg px-3 py-2"
                    required>

            </div>

            <div class="flex justify-end gap-2 px-6 py-4 border-t">

                <button
                    type="button"
                    onclick="tutupModalEdit()"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    Batal
                </button>

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Update
                </button>

            </div>

        </form>

    </div>

</div>

    {{-- Modal Delete --}}
    <!-- Modal Hapus -->
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
                Hapus Kategori
            </h2>

            <p class="text-gray-600 mt-2">
                Apakah Anda yakin ingin menghapus kategori ini?
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

function editKategori(id, nama)
{
    document.getElementById('editNamaKategori').value = nama;
    document.getElementById('formEdit').action = "/kategori/" + id;

    document.getElementById('modalEdit').classList.remove('hidden');
}

function tutupModalEdit()
{
    document.getElementById('modalEdit').classList.add('hidden');
}

function hapusKategori(id)
{
    document.getElementById('formDelete').action = "/kategori/" + id;

    document.getElementById('modalDelete').classList.remove('hidden');
}

function tutupDelete()
{
    document.getElementById('modalDelete').classList.add('hidden');
}

</script>
</div>

</x-app-layout>