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
            <div class="mb-6 rounded-2xl border border-green-300 bg-green-100 px-5 py-4 text-green-700 shadow-sm">
                {{ session('success') }}
            </div>
            @endif

            {{-- ==========================================
                 SATU CARD BESAR: HEADER + TOOLBAR + TABLE
            ========================================== --}}
            <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-xl">

                {{-- HEADER CARD --}}
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5 border-b p-5 md:p-6">

                    <div>
                        <h2 class="text-xl md:text-2xl font-bold text-gray-800">
                            Daftar Petugas
                        </h2>
                        <p class="mt-1 text-sm text-gray-500">
                            Kelola seluruh petugas sekolah.
                        </p>
                    </div>

                    <button
                        type="button"
                        onclick="bukaTambah()"
                        class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-lg transition">
                        <span class="text-lg leading-none">+</span> Tambah Petugas
                    </button>

                </div>

                {{-- TABLE (masih di dalam card yang sama, tidak terpisah) --}}
                <div class="overflow-x-auto">
                    <div class="p-6">
                        <div id="gridPetugas"></div>
                    </div>
                </div>

            </div>

            {{-- =========================
                 MODAL TAMBAH PETUGAS
            ========================= --}}
            <div id="modalTambah"
                class="hidden fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto">

                <div class="bg-white w-full max-w-2xl max-h-[90vh] rounded-3xl shadow-2xl flex flex-col overflow-hidden">

                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 md:px-8 py-6 text-white">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center text-3xl">
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

                    <form action="{{ route('petugas.store') }}" method="POST" class="flex flex-col flex-1">
                        @csrf

                        <div class="flex-1 overflow-y-auto p-6 md:p-8 space-y-6">
                            <div>
                                <label class="block mb-2 font-semibold text-gray-700">Nama Petugas</label>
                                <input type="text" name="name"
                                    class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Masukkan nama petugas" required>
                            </div>

                            <div>
                                <label class="block mb-2 font-semibold text-gray-700">Email</label>
                                <input type="email" name="email"
                                    class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="contoh@email.com" required>
                            </div>

                            <div>
                                <label class="block mb-2 font-semibold text-gray-700">Password</label>
                                <input type="password" name="password"
                                    class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Masukkan password" required>
                            </div>
                        </div>

                        <div class="bg-gray-50 border-t px-6 py-4 flex flex-col-reverse sm:flex-row justify-end gap-3">
                            <button type="button" onclick="tutupTambah()"
                                class="w-full sm:w-auto px-6 py-3 rounded-xl bg-gray-300 hover:bg-gray-400 transition">
                                Batal
                            </button>
                            <button type="submit"
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

                <div class="bg-white w-full max-w-2xl max-h-[90vh] rounded-3xl shadow-2xl flex flex-col overflow-hidden">

                    <div class="bg-gradient-to-r from-yellow-500 to-orange-500 px-6 md:px-8 py-6 text-white">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center text-3xl">
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

                    <form id="formEdit" method="POST" class="flex flex-col flex-1">
                        @csrf
                        @method('PUT')

                        <div class="flex-1 overflow-y-auto p-6 md:p-8 space-y-6">
                            <div>
                                <label class="block mb-2 font-semibold text-gray-700">Nama Petugas</label>
                                <input type="text" id="editNama" name="name"
                                    class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                                    required>
                            </div>

                            <div>
                                <label class="block mb-2 font-semibold text-gray-700">Email</label>
                                <input type="email" id="editEmail" name="email"
                                    class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                                    required>
                            </div>

                            <div>
                                <label class="block mb-2 font-semibold text-gray-700">Password Baru</label>
                                <input type="password" name="password"
                                    placeholder="Kosongkan jika tidak diubah"
                                    class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                                <p class="mt-2 text-sm text-gray-500">
                                    Biarkan kosong jika password tidak ingin diganti.
                                </p>
                            </div>
                        </div>

                        <div class="bg-gray-50 border-t px-6 py-4 flex flex-col-reverse sm:flex-row justify-end gap-3">
                            <button type="button" onclick="tutupModalEdit()"
                                class="w-full sm:w-auto px-6 py-3 rounded-xl bg-gray-300 hover:bg-gray-400 transition">
                                Batal
                            </button>
                            <button type="submit"
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

                <div class="bg-white w-full max-w-md rounded-3xl shadow-2xl overflow-hidden">

                    <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-6 text-center text-white">
                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-white/20 text-5xl">
                            🗑
                        </div>
                        <h2 class="mt-5 text-2xl font-bold">
                            Hapus Petugas
                        </h2>
                        <p class="mt-2 text-red-100">
                            Data petugas yang dihapus tidak dapat dikembalikan.
                        </p>
                    </div>

                    <div class="px-6 py-8 text-center">
                        <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-red-100 text-3xl">
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

                        <div class="bg-gray-50 border-t px-6 py-5 flex flex-col-reverse sm:flex-row justify-center gap-3">
                            <button type="button" onclick="tutupDelete()"
                                class="w-full sm:w-auto px-6 py-3 rounded-xl bg-gray-300 hover:bg-gray-400 transition">
                                Batal
                            </button>
                            <button type="submit"
                                class="w-full sm:w-auto px-6 py-3 rounded-xl bg-red-600 hover:bg-red-700 text-white shadow-lg transition">
                                🗑 Ya, Hapus
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <script>
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

                document.addEventListener("DOMContentLoaded", function() {

                    const petugasData = @json($petugas);

                    $("#gridPetugas").dxDataGrid({
                        dataSource: petugasData,

                        showBorders: false,
                        showColumnLines: false,
                        showRowLines: true,
                        hoverStateEnabled: true,
                        columnAutoWidth: true,

                        columns: [{
                                caption: "🔢 No",
                                width: 90,
                                alignment: "center",
                                cellTemplate(container, options) {
                                    const nomor =
                                        options.component.pageIndex() *
                                        options.component.pageSize() +
                                        options.rowIndex + 1;

                                    $(container).html(`
                                        <div class="inline-flex items-center justify-center
                                            w-10 h-10 rounded-full bg-blue-100
                                            text-blue-700 font-bold">
                                            ${String(nomor).padStart(2,'0')}
                                        </div>
                                    `);
                                }
                            },
                            {
                                caption: "👤 Informasi Petugas",
                                dataField: "name",
                                cellTemplate(container, options) {
                                    $(container).html(`
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-lg bg-blue-50
                                                flex items-center justify-center text-lg">
                                                🛠
                                            </div>
                                            <div>
                                                <div class="font-semibold">
                                                    ${options.data.name}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    Petugas Sarpras
                                                </div>
                                            </div>
                                        </div>
                                    `);
                                }
                            },
                            {
                                dataField: "email",
                                caption: "📧 Email"
                            },
                            {
                                caption: "⚙️ Aksi",
                                width: 220,
                                alignment: "center",
                                cellTemplate(container, options) {
                                    const id = options.data.id;
                                    const nama = options.data.name;
                                    const email = options.data.email;

                                    $(container).html(`
                                        <div class="flex justify-center gap-2">
                                            <button
                                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-xl"
                                                onclick="editPetugas(${id},'${nama.replace(/'/g,"\\'")}','${email}')">
                                                ✏ Edit
                                            </button>
                                            <button
                                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl"
                                                onclick="hapusPetugas(${id})">
                                                🗑 Hapus
                                            </button>
                                        </div>
                                    `);
                                }
                            }
                        ],

                        searchPanel: {
                            visible: true,
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
                            fileName: "Data_Petugas"
                        },

                        loadPanel: {
                            enabled: true,
                            text: "Memuat data petugas..."
                        },

                        // Export dan Search sama-sama di kanan (after) agar berjejer rapat
                        toolbar: {
                            items: [{
                                    name: "exportButton",
                                    location: "after"
                                },
                                {
                                    name: "searchPanel",
                                    location: "after"
                                }
                            ]
                        },

                        onToolbarPreparing: function(e) {
                            e.toolbarOptions.items.forEach(function(item) {
                                if (item.name === "exportButton") {
                                    item.options.icon = "exportxlsx";
                                }
                            });
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
                            const worksheet = workbook.addWorksheet("Petugas");

                            DevExpress.excelExporter.exportDataGrid({
                                component: e.component,
                                worksheet: worksheet
                            }).then(function() {
                                workbook.xlsx.writeBuffer().then(function(buffer) {
                                    saveAs(
                                        new Blob([buffer], {
                                            type: "application/octet-stream"
                                        }),
                                        "DataPetugas.xlsx"
                                    );
                                });
                            });

                            e.cancel = true;
                        }

                    });

                });
            </script>

            <style>
                .dx-toolbar {
                    padding: 15px;
                }

                /* Rapatkan icon Export & Search agar tidak terpisah jauh */
                .dx-toolbar-after {
                    display: flex !important;
                    align-items: center;
                    gap: 6px !important;
                }

                .dx-toolbar-after .dx-toolbar-item {
                    margin-left: 0 !important;
                }

                .dx-datagrid-search-panel {
                    width: 260px !important;
                    margin-left: 0 !important;
                }

                .dx-datagrid-search-panel .dx-texteditor {
                    border-radius: 14px;
                }

                .dx-button {
                    border-radius: 12px !important;
                }
            </style>

        </div>
    </div>
</x-app-layout>