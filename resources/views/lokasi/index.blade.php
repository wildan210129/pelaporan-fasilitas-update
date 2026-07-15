<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Lokasi') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg p-6">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Daftar Lokasi</h3>
<button
    onclick="document.getElementById('modalTambah').classList.remove('hidden')"
    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
    + Tambah Lokasi
</button>
                </div>

                <table class="w-full border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2">No</th>
                            <th class="border px-4 py-2">Nama Lokasi</th>
                            <th class="border px-4 py-2">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($lokasi as $item)
                            <tr>
                                <td class="border px-4 py-2">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="border px-4 py-2">
                                    {{ $item->nama_lokasi }}
                                </td>

                                <td class="border px-4 py-2">

    <button
        onclick="editLokasi('{{ $item->id }}', '{{ $item->nama_lokasi }}')"
        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
        Edit
    </button>

    <form action="{{ route('lokasi.destroy', $item->id) }}"
          method="POST"
          class="inline">
        @csrf
        @method('DELETE')

        <button
    type="button"
    onclick="hapusLokasi('{{ $item->id }}')"
    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
    Hapus
</button>
    </form>

</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center border py-4">
                                    Belum ada data lokasi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>

        </div>
    </div>
    <!-- Modal Tambah Lokasi -->
<div id="modalTambah"
    class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

    <div class="bg-white rounded-lg shadow-lg w-full max-w-md">

        <div class="flex justify-between items-center border-b px-6 py-4">
            <h2 class="text-lg font-bold">Tambah Lokasi</h2>

            <button
                onclick="document.getElementById('modalTambah').classList.add('hidden')"
                class="text-gray-500 text-2xl">
                &times;
            </button>
        </div>

        <form action="{{ route('lokasi.store') }}" method="POST">
            @csrf

            <div class="p-6">

                <label class="block mb-2 font-semibold">
                    Nama Lokasi
                </label>

                <input
                    type="text"
                    name="nama_lokasi"
                    class="w-full border rounded-lg px-3 py-2"
                    placeholder="Masukkan nama lokasi"
                    required>

            </div>

            <div class="flex justify-end gap-2 px-6 py-4 border-t">

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
<!-- Modal Edit -->
<div id="modalEdit"
    class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

    <div class="bg-white rounded-lg shadow-lg w-full max-w-md">

        <div class="flex justify-between items-center border-b px-6 py-4">
            <h2 class="text-lg font-bold">Edit Lokasi</h2>

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
                    Nama Lokasi
                </label>

                <input
                    type="text"
                    id="editNamaLokasi"
                    name="nama_lokasi"
                    class="w-full border rounded-lg px-3 py-2"
                    required>

            </div>

            <div class="flex justify-end gap-2 px-6 py-4 border-t">

                <button
                    type="button"
                    onclick="tutupModalEdit()"
                    class="bg-gray-500 text-white px-4 py-2 rounded">
                    Batal
                </button>

                <button
                    type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded">
                    Update
                </button>

            </div>

        </form>

    </div>

</div>

<!-- Modal Hapus -->
<div id="modalDelete"
    class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

    <div class="bg-white rounded-xl shadow-xl w-full max-w-md">

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
                Hapus Lokasi
            </h2>

            <p class="text-gray-600 mt-2">
                Apakah Anda yakin ingin menghapus data ini?
            </p>

            <form id="formDelete" method="POST" class="mt-6">
                @csrf
                @method('DELETE')

                <div class="flex justify-center gap-3">

                    <button
                        type="button"
                        onclick="tutupDelete()"
                        class="px-5 py-2 rounded-lg bg-gray-300 hover:bg-gray-400">
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="px-5 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white">
                        Ya, Hapus
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
<script>
function editLokasi(id, nama)
{
    document.getElementById('editNamaLokasi').value = nama;
    document.getElementById('formEdit').action = "/lokasi/" + id;

    document.getElementById('modalEdit').classList.remove('hidden');
}

function tutupModalEdit()
{
    document.getElementById('modalEdit').classList.add('hidden');
}
</script>

<script>

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

