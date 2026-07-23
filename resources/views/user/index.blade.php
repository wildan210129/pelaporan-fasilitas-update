<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>

                <h2 class="text-2xl md:text-3xl font-bold text-gray-800">

                    👥 Data User

                </h2>

                <p class="text-gray-500 mt-1">

                    Kelola seluruh akun pengguna aplikasi.

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

                            Daftar User

                        </h2>

                        <p class="text-gray-500">

                            Kelola seluruh akun pengguna sistem.

                        </p>

                    </div>

                    <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">

                        <div class="relative w-full">

                            <input
                                id="searchUser"
                                type="text"
                                placeholder="Cari user..."
                                class="w-full pl-10 pr-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 absolute left-3 top-2.5 text-gray-400"
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

                        <button
                            onclick="document.getElementById('modalTambah').classList.remove('hidden')"
                            class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow">

                            + Tambah User

                        </button>

                    </div>

                </div>
                {{-- =========================
     TABEL USER
========================= --}}

                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="bg-gray-100 text-gray-700">

                            <tr>

                                <th class="px-6 py-4 text-center w-24">
                                    No
                                </th>

                                <th class="px-6 py-4 text-left">
                                    Informasi User
                                </th>

                                <th class="px-6 py-4 text-center">
                                    Role
                                </th>

                                <th class="px-6 py-4 text-center w-52">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        <tbody id="tableUser">

                            @forelse($users as $item)

                            <tr class="border-b hover:bg-blue-50 transition duration-200">

                                <td class="px-6 py-4 text-center">

                                    <div class="inline-flex items-center justify-center
                            w-9 h-9 md:w-10 md:h-10 rounded-full
                            bg-blue-100 text-blue-700 font-bold">

                                        {{ str_pad($loop->iteration,2,'0',STR_PAD_LEFT) }}

                                    </div>

                                </td>

                                <td class="px-6 py-4">

                                    <div class="flex items-center gap-3">

                                        <div class="w-12 h-12 rounded-full bg-blue-100
                                flex items-center justify-center text-xl">

                                            👤

                                        </div>

                                        <div>

                                            <h3 class="font-semibold text-gray-800">

                                                {{ $item->name }}

                                            </h3>

                                            <p class="text-sm text-gray-500">

                                                {{ $item->email }}

                                            </p>

                                        </div>

                                    </div>

                                </td>

                                <td class="px-6 py-4 text-center">

                                    @if($item->role == 'admin')

                                    <span class="px-3 py-1 rounded-full
                                 bg-red-100 text-red-700
                                 text-sm font-semibold">

                                        Admin

                                    </span>

                                    @elseif($item->role == 'petugas')

                                    <span class="px-3 py-1 rounded-full
                                 bg-blue-100 text-blue-700
                                 text-sm font-semibold">

                                        Petugas

                                    </span>

                                    @else

                                    <span class="px-3 py-1 rounded-full
                                 bg-green-100 text-green-700
                                 text-sm font-semibold">

                                        Siswa

                                    </span>

                                    @endif

                                </td>

                                <td class="px-6 py-4">

                                    <div class="flex flex-col sm:flex-row justify-center gap-2">

                                        <button
                                            onclick="editUser(
                            '{{ $item->id }}',
                            '{{ $item->name }}',
                            '{{ $item->email }}',
                            '{{ $item->role }}'
                        )"
                                            class="bg-yellow-500 hover:bg-yellow-600
                               text-white px-3 py-2 text-sm md:px-4 md:text-base rounded-lg shadow">

                                            ✏ Edit

                                        </button>

                                        <button
                                            onclick="hapusUser('{{ $item->id }}')"
                                            class="bg-red-600 hover:bg-red-700
                               text-white px-3 py-2 text-sm md:px-4 md:text-base rounded-lg shadow">

                                            🗑 Hapus

                                        </button>

                                    </div>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="4" class="py-16 text-center">

                                    <div class="flex flex-col items-center">

                                        <div class="text-6xl">

                                            👥

                                        </div>

                                        <h3 class="mt-4 text-xl font-bold text-gray-700">

                                            Belum Ada User

                                        </h3>

                                        <p class="text-gray-500">

                                            Silakan tambahkan user baru.

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
     MODAL TAMBAH USER
========================= --}}

    <div id="modalTambah"
        class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">

        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-xl overflow-hidden">

            {{-- Header --}}
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-5 text-white">

                <h2 class="text-2xl font-bold">

                    👤 Tambah User

                </h2>

                <p class="text-blue-100 mt-1">

                    Tambahkan akun pengguna baru ke dalam sistem.

                </p>

            </div>

            <form action="{{ route('user.store') }}" method="POST">

                @csrf

                <div class="p-6 space-y-5">

                    {{-- Nama --}}
                    <div>

                        <label class="block mb-2 font-semibold text-gray-700">

                            Nama Lengkap

                        </label>

                        <input
                            type="text"
                            name="name"
                            class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan nama lengkap"
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

                    {{-- Role --}}
                    <div>

                        <label class="block mb-2 font-semibold text-gray-700">

                            Role

                        </label>

                        <select
                            name="role"
                            class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>

                            <option value="">-- Pilih Role --</option>

                            <option value="admin">

                                Admin

                            </option>

                            <option value="petugas">

                                Petugas

                            </option>

                            <option value="siswa">

                                Siswa

                            </option>

                        </select>

                    </div>

                </div>

                {{-- Footer --}}
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
     MODAL EDIT USER
========================= --}}

    <div id="modalEdit"
        class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 p-4 overflow-y-scroll">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-xl max-h-[90vh] overflow-y-scroll">
            {{-- Header --}}
            <div class="bg-gradient-to-r from-yellow-500 to-orange-500 px-6 py-5 text-white flex-shrink-0">

                <h2 class="text-2xl font-bold">
                    ✏ Edit User
                </h2>

                <p class="text-yellow-100 mt-1">
                    Perbarui informasi pengguna.
                </p>

            </div>

            <form id="formEdit" method="POST" class="flex flex-col flex-1">

                @csrf
                @method('PUT')

                {{-- Isi Form --}}
                <div class="flex-1 overflow-y-auto p-6 space-y-5">

                    {{-- Nama --}}
                    <div>
                        <label class="block mb-2 font-semibold text-gray-700">
                            Nama Lengkap
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
                            class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                            placeholder="Kosongkan jika tidak diubah">

                        <p class="text-xs text-gray-500 mt-1">
                            Biarkan kosong jika password tidak ingin diganti.
                        </p>
                    </div>

                    {{-- Role --}}
                    <div>
                        <label class="block mb-2 font-semibold text-gray-700">
                            Role
                        </label>

                        <select
                            id="editRole"
                            name="role"
                            class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">

                            <option value="admin">Admin</option>
                            <option value="petugas">Petugas</option>
                            <option value="siswa">Siswa</option>

                        </select>
                    </div>

                </div>

                {{-- Footer --}}
                <div class="bg-gray-50 px-6 py-4 flex justify-end gap-3 flex-shrink-0">

                    <button
                        type="button"
                        onclick="tutupModalEdit()"
                        class="px-5 py-2 rounded-xl bg-gray-300 hover:bg-gray-400">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="px-5 py-2 rounded-xl bg-yellow-500 hover:bg-yellow-600 text-white shadow-lg">

                        ✏ Update

                    </button>

                </div>

            </form>

        </div>

    </div>
    {{-- =========================
     MODAL HAPUS USER
========================= --}}

    <div id="modalDelete"
        class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">

        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">

            <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-5 text-white text-center">

                <div class="w-20 h-20 mx-auto rounded-full bg-white/20 flex items-center justify-center text-5xl">

                    🗑

                </div>

                <h2 class="mt-4 text-2xl font-bold">

                    Hapus User

                </h2>

                <p class="text-red-100 mt-2">

                    User yang dihapus tidak dapat dikembalikan.

                </p>

            </div>

            <div class="p-6 text-center">

                <p class="text-gray-600">

                    Apakah Anda yakin ingin menghapus user ini?

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
        // =======================
        // SEARCH USER
        // =======================

        document.getElementById("searchUser").addEventListener("keyup", function() {

            let value = this.value.toLowerCase();

            let rows = document.querySelectorAll("#tableUser tr");

            rows.forEach(function(row) {

                row.style.display = row.innerText.toLowerCase().includes(value) ?
                    "" :
                    "none";

            });

        });

        // =======================
        // EDIT USER
        // =======================

        function editUser(id, nama, email, role) {
            document.getElementById("editNama").value = nama;

            document.getElementById("editEmail").value = email;

            document.getElementById("editRole").value = role;

            document.getElementById("formEdit").action = "/user/" + id;

            document.getElementById("modalEdit").classList.remove("hidden");
        }

        function tutupModalEdit() {
            document.getElementById("modalEdit").classList.add("hidden");
        }

        // =======================
        // DELETE USER
        // =======================

        function hapusUser(id) {
            document.getElementById("formDelete").action = "/user/" + id;

            document.getElementById("modalDelete").classList.remove("hidden");
        }

        function tutupDelete() {
            document.getElementById("modalDelete").classList.add("hidden");
        }
    </script>

</x-app-layout>