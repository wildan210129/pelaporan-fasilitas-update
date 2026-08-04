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

                    <button
                        onclick="document.getElementById('modalTambah').classList.remove('hidden')"
                        class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow font-medium">

                        + Tambah User

                    </button>

                </div>
                {{-- =========================
     TABEL USER
========================= --}}

                <div class="overflow-x-auto p-2">

                    <div id="gridUser"></div>

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
                                        id="roleTambah"
                                        name="role"
                                        class="select2 w-full"
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
                                        class="select2 w-full">

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

                    const userData = @json($users);

                    document.addEventListener("DOMContentLoaded", function() {

                        $("#gridUser").dxDataGrid({

                            elementAttr: {
                                id: "userGrid"
                            },

                            dataSource: userData,

                            showBorders: false,
                            showColumnLines: false,
                            showRowLines: true,
                            hoverStateEnabled: true,
                            columnAutoWidth: true,

                            columns: [

                                {
                                    caption: "🔢 No",
                                    width: 90,
                                    alignment: "center",

                                    cellTemplate: function(container, options) {

                                        const nomor =
                                            options.component.pageIndex() *
                                            options.component.pageSize() +
                                            options.rowIndex + 1;

                                        $(container).html(`
                        <div class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 text-blue-700 font-bold">
                            ${String(nomor).padStart(2,'0')}
                        </div>
                    `);

                                    }

                                },

                                {
                                    caption: "👤 Informasi User",

                                    cellTemplate: function(container, options) {

                                        $(container).html(`
                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center text-lg">
                                👤
                            </div>

                            <div>

                                <div class="font-semibold text-gray-800">
                                    ${options.data.name}
                                </div>

                                <div class="text-sm text-gray-500">
                                    ${options.data.email}
                                </div>

                            </div>

                        </div>
                    `);

                                    }

                                },

                                {
                                    dataField: "role",
                                    caption: "🏷 Role",
                                    alignment: "center",

                                    cellTemplate: function(container, options) {

                                        let warna = "bg-green-100 text-green-700";

                                        if (options.data.role == "admin") {
                                            warna = "bg-red-100 text-red-700";
                                        }

                                        if (options.data.role == "petugas") {
                                            warna = "bg-blue-100 text-blue-700";
                                        }

                                        $(container).html(`
                        <span class="px-3 py-1 rounded-full text-sm font-semibold ${warna}">
                            ${options.data.role}
                        </span>
                    `);

                                    }

                                },

                                {
                                    caption: "⚙️ Aksi",
                                    width: 240,
                                    alignment: "center",

                                    cellTemplate: function(container, options) {

                                        const id = options.data.id;
                                        const nama = options.data.name.replace(/'/g, "\\'");
                                        const email = options.data.email.replace(/'/g, "\\'");
                                        const role = options.data.role;

                                        $(container).html(`
                        <div class="flex justify-center gap-2">

                            <button
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-xl"
                                onclick="editUser(${id},'${nama}','${email}','${role}')">

                                ✏ Edit

                            </button>

                            <button
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl"
                                onclick="hapusUser(${id})">

                                🗑 Hapus

                            </button>

                        </div>
                    `);

                                    }

                                }

                            ],

                            searchPanel: {
                                visible: true,
                                width: 300,
                                placeholder: "Search..."
                            },

                            filterRow: {
                                visible: true
                            },

                            headerFilter: {
                                visible: true
                            },

                            sorting: {
                                mode: "multiple"
                            },

                            paging: {
                                pageSize: 10
                            },

                            pager: {
                                visible: true,
                                showPageSizeSelector: true,
                                allowedPageSizes: [10, 20, 50],
                                showNavigationButtons: true,
                                showInfo: true
                            },

                            export: {
                                enabled: true,
                                fileName: "Data_User",
                                allowExportSelectedData: true
                            },

                            loadPanel: {
                                enabled: true,
                                text: "Memuat data user..."
                            },

                            onCellPrepared: function(e) {
                                if (e.rowType === "header") {
                                    e.cellElement.css({
                                        "background": "linear-gradient(to right, #2563eb, #1d4ed8)",
                                        "color": "#ffffff",
                                        "font-weight": "600",
                                        "border-color": "#1d4ed8"
                                    });
                                    e.cellElement.find(".dx-header-filter, .dx-sort, .dx-sort-indicator, svg, .dx-icon")
                                        .css("color", "#ffffff");
                                }
                            },

                            onExporting: function(e) {

                                const workbook = new ExcelJS.Workbook();
                                const worksheet = workbook.addWorksheet("User");

                                DevExpress.excelExporter.exportDataGrid({
                                    component: e.component,
                                    worksheet: worksheet
                                }).then(function() {

                                    workbook.xlsx.writeBuffer().then(function(buffer) {

                                        saveAs(
                                            new Blob([buffer], {
                                                type: "application/octet-stream"
                                            }),
                                            "Data_User.xlsx"
                                        );

                                    });

                                });

                                e.cancel = true;

                            }

                        });

                    });
                </script>

            </div>

        </div>

    </div>

</x-app-layout>