<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manajemen User
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <div class="flex justify-between items-center mb-6">

                    <h2 class="text-2xl font-bold">
                        Data User
                    </h2>

                    <button
                    onclick="document.getElementById('modalTambah').classList.remove('hidden')"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">

                    + Tambah User

                </button>

                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full border">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="border px-4 py-3">No</th>

                                <th class="border px-4 py-3">Nama</th>

                                <th class="border px-4 py-3">Email</th>

                                <th class="border px-4 py-3">Role</th>

                                <th class="border px-4 py-3">Aksi</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($users as $user)

                                <tr>

                                    <td class="border px-4 py-3 text-center">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="border px-4 py-3">
                                        {{ $user->name }}
                                    </td>

                                    <td class="border px-4 py-3">
                                        {{ $user->email }}
                                    </td>

                                    <td class="border px-4 py-3 text-center">

                                        @if($user->role == 'admin')

                                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">
                                                Admin
                                            </span>

                                        @elseif($user->role == 'petugas')

                                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full">
                                                Petugas
                                            </span>

                                        @else

                                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
                                                Siswa
                                            </span>

                                        @endif

                                    </td>

                                    <td class="border px-4 py-3 text-center">

                                    <button
                                    onclick="editUser(
                                        '{{ $user->id }}',
                                        '{{ $user->name }}',
                                        '{{ $user->email }}',
                                        '{{ $user->role }}'
                                         )"
                                         class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">

                                         Edit

                                        </button>

                                        <button
                                            onclick="hapusUser('{{ $user->id }}')"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">

                                            Hapus

                                        </button>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5"
                                        class="border py-6 text-center">

                                        Belum ada user.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </div>
    <!-- Modal Tambah User -->
<div id="modalTambah"
    class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

    <div class="bg-white rounded-lg shadow-lg w-full max-w-xl">

        <div class="flex justify-between items-center border-b px-6 py-4">

            <h2 class="text-xl font-bold">
                Tambah User
            </h2>

            <button
                onclick="document.getElementById('modalTambah').classList.add('hidden')"
                class="text-2xl text-gray-500 hover:text-gray-700">

                &times;

            </button>

        </div>

        <form
            action="{{ route('user.store') }}"
            method="POST">

            @csrf

            <div class="p-6 space-y-4">

                <div>

                    <label class="font-semibold">
                        Nama
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="w-full border rounded-lg px-3 py-2"
                        required>

                </div>

                <div>

                    <label class="font-semibold">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="w-full border rounded-lg px-3 py-2"
                        required>

                </div>

                <div>

                    <label class="font-semibold">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="w-full border rounded-lg px-3 py-2"
                        required>

                </div>

                <div>

                    <label class="font-semibold">
                        Role
                    </label>

                    <select
                        name="role"
                        class="w-full border rounded-lg px-3 py-2">

                        <option value="admin">Admin</option>

                        <option value="petugas">Petugas</option>

                        <option value="siswa">Siswa</option>

                    </select>

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
<!-- Modal Edit User -->
<div id="modalEdit"
    class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

    <div class="bg-white rounded-lg shadow-lg w-full max-w-xl">

        <div class="flex justify-between items-center border-b px-6 py-4">

            <h2 class="text-xl font-bold">
                Edit User
            </h2>

            <button
                onclick="tutupModalEdit()"
                class="text-2xl text-gray-500 hover:text-gray-700">

                &times;

            </button>

        </div>

        <form
            id="formEdit"
            method="POST">

            @csrf
            @method('PUT')

            <div class="p-6 space-y-4">

                <div>
                    <label>Nama</label>

                    <input
                        id="editName"
                        type="text"
                        name="name"
                        class="w-full border rounded-lg px-3 py-2"
                        required>
                </div>

                <div>
                    <label>Email</label>

                    <input
                        id="editEmail"
                        type="email"
                        name="email"
                        class="w-full border rounded-lg px-3 py-2"
                        required>
                </div>

                <div>
                    <label>Password Baru (Opsional)</label>

                    <input
                        type="password"
                        name="password"
                        class="w-full border rounded-lg px-3 py-2">
                </div>

                <div>

                    <label>Role</label>

                    <select
                        id="editRole"
                        name="role"
                        class="w-full border rounded-lg px-3 py-2">

                        <option value="admin">Admin</option>
                        <option value="petugas">Petugas</option>
                        <option value="siswa">Siswa</option>

                    </select>

                </div>

            </div>

            <div class="flex justify-end gap-2 border-t px-6 py-4">

                <button
                    type="button"
                    onclick="tutupModalEdit()"
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
<!-- Modal Delete User -->
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
                Hapus User
            </h2>

            <p class="mt-2 text-gray-600">
                Yakin ingin menghapus user ini?
            </p>

            <form id="formDelete" method="POST">

                @csrf
                @method('DELETE')

                <div class="flex justify-center gap-3 mt-6">

                    <button
                        type="button"
                        onclick="tutupDelete()"
                        class="bg-gray-500 text-white px-5 py-2 rounded">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="bg-red-600 text-white px-5 py-2 rounded">

                        Ya, Hapus

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script>

function editUser(id, name, email, role)
{
    document.getElementById('editName').value = name;
    document.getElementById('editEmail').value = email;
    document.getElementById('editRole').value = role;

    document.getElementById('formEdit').action = "/user/" + id;

    document.getElementById('modalEdit').classList.remove('hidden');
}

function tutupModalEdit()
{
    document.getElementById('modalEdit').classList.add('hidden');
}

function hapusUser(id)
{
    document.getElementById('formDelete').action = "/user/" + id;

    document.getElementById('modalDelete').classList.remove('hidden');
}

function tutupDelete()
{
    document.getElementById('modalDelete').classList.add('hidden');
}
</script>

</x-app-layout>