<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            Data Petugas
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">

            <div class="bg-white shadow rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex justify-between items-center mb-4">

                    <h2 class="text-xl font-bold">
                        Data Petugas
                    </h2>

                    <button
                        onclick="document.getElementById('modalTambah').classList.remove('hidden')"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">

                        + Tambah Petugas

                    </button>

                </div>

                <table class="w-full border">

                    <thead class="bg-gray-100">

                        <tr>

                            <th class="border p-2">No</th>
                            <th class="border p-2">Nama</th>
                            <th class="border p-2">Email</th>
                            <th class="border p-2">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($petugas as $item)

                        <tr>

                            <td class="border p-2 text-center">
                                {{ $loop->iteration }}
                            </td>

                            <td class="border p-2">
                                {{ $item->name }}
                            </td>

                            <td class="border p-2">
                                {{ $item->email }}
                            </td>

                            <td class="border p-2 text-center">

                                <button
                                    onclick="editPetugas(
                                        '{{ $item->id }}',
                                        '{{ $item->name }}',
                                        '{{ $item->email }}'
                                    )"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">

                                    Edit

                                </button>

                                <button
                                    onclick="hapusPetugas('{{ $item->id }}')"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">

                                    Hapus

                                </button>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="4" class="border p-4 text-center text-gray-500">

                                Belum ada data petugas.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

    {{-- ================= MODAL TAMBAH ================= --}}

    <div id="modalTambah"
        class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

        <div class="bg-white rounded-lg w-full max-w-lg p-6">

            <h2 class="text-xl font-bold mb-4">

                Tambah Petugas

            </h2>

            <form action="{{ route('petugas.store') }}" method="POST">

                @csrf

                <div class="mb-4">

                    <label>Nama</label>

                    <input
                        type="text"
                        name="name"
                        class="w-full border rounded p-2"
                        required>

                </div>

                <div class="mb-4">

                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        class="w-full border rounded p-2"
                        required>

                </div>

                <div class="mb-4">

                    <label>Password</label>

                    <input
                        type="password"
                        name="password"
                        class="w-full border rounded p-2"
                        required>

                </div>

                <div class="flex justify-end gap-2">

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

    {{-- ================= MODAL EDIT ================= --}}

    <div id="modalEdit"
        class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

        <div class="bg-white rounded-lg w-full max-w-lg p-6">

            <h2 class="text-xl font-bold mb-4">

                Edit Petugas

            </h2>

            <form id="formEdit" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-4">

                    <label>Nama</label>

                    <input
                        type="text"
                        id="editNama"
                        name="name"
                        class="w-full border rounded p-2"
                        required>

                </div>

                <div class="mb-4">

                    <label>Email</label>

                    <input
                        type="email"
                        id="editEmail"
                        name="email"
                        class="w-full border rounded p-2"
                        required>

                </div>

                <div class="mb-4">

                    <label>Password Baru (Opsional)</label>

                    <input
                        type="password"
                        name="password"
                        class="w-full border rounded p-2">

                </div>

                <div class="flex justify-end gap-2">

                    <button
                        type="button"
                        onclick="tutupEdit()"
                        class="bg-gray-500 text-white px-4 py-2 rounded">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="bg-yellow-500 text-white px-4 py-2 rounded">

                        Update

                    </button>

                </div>

            </form>

        </div>

    </div>

    {{-- ================= MODAL DELETE ================= --}}

    <div id="modalDelete"
        class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

        <div class="bg-white rounded-lg p-6 w-full max-w-md">

            <h2 class="text-xl font-bold mb-3">

                Hapus Petugas

            </h2>

            <p>

                Apakah Anda yakin ingin menghapus petugas ini?

            </p>

            <form id="formDelete" method="POST">

                @csrf
                @method('DELETE')

                <div class="flex justify-end gap-2 mt-4">

                    <button
                        type="button"
                        onclick="tutupDelete()"
                        class="bg-gray-500 text-white px-4 py-2 rounded">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="bg-red-600 text-white px-4 py-2 rounded">

                        Hapus

                    </button>

                </div>

            </form>

        </div>

    </div>

    <script>

        function editPetugas(id, nama, email)
        {
            document.getElementById('editNama').value = nama;
            document.getElementById('editEmail').value = email;

            document.getElementById('formEdit').action = "/petugas/" + id;

            document.getElementById('modalEdit').classList.remove('hidden');
        }

        function tutupEdit()
        {
            document.getElementById('modalEdit').classList.add('hidden');
        }

        function hapusPetugas(id)
        {
            document.getElementById('formDelete').action = "/petugas/" + id;

            document.getElementById('modalDelete').classList.remove('hidden');
        }

        function tutupDelete()
        {
            document.getElementById('modalDelete').classList.add('hidden');
        }

    </script>

</x-app-layout>