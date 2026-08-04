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
                        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                            🛠 Kategori Kerusakan
                        </h2>
                        <p class="text-gray-500">
                            Kelola kategori yang digunakan saat membuat laporan.
                        </p>
                    </div>

                    <button
                        onclick="document.getElementById('modalTambah').classList.remove('hidden')"
                        class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow font-medium">
                        + Tambah Kategori
                    </button>

                </div>

                {{-- =========================
                     TABEL KATEGORI
                ========================= --}}
                <div class="overflow-x-auto p-2">
                    <div id="gridKategori"></div>
                </div>

                {{-- =========================
                     MODAL TAMBAH KATEGORI
                ========================= --}}
                <div id="modalTambah"
                    class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">
                    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-5 text-white">
                            <h2 class="text-2xl font-bold">➕ Tambah Kategori</h2>
                            <p class="text-blue-100 mt-1">Tambahkan kategori kerusakan baru.</p>
                        </div>
                        <form action="{{ route('kategori.store') }}" method="POST">
                            @csrf
                            <div class="p-6">
                                <label class="block mb-2 font-semibold text-gray-700">Nama Kategori</label>
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
                        <div class="bg-gradient-to-r from-yellow-500 to-orange-500 px-6 py-5 text-white">
                            <h2 class="text-2xl font-bold">✏ Edit Kategori</h2>
                            <p class="text-yellow-100 mt-1">Ubah nama kategori kerusakan.</p>
                        </div>
                        <form id="formEdit" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="p-6">
                                <label class="block mb-2 font-semibold text-gray-700">Nama Kategori</label>
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
                            <h2 class="mt-4 text-2xl font-bold">Hapus Kategori</h2>
                            <p class="text-red-100 mt-2">Data yang dihapus tidak dapat dikembalikan.</p>
                        </div>
                        <div class="p-6 text-center">
                            <p class="text-gray-600">Apakah Anda yakin ingin menghapus kategori ini?</p>
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

                    const kategoriData = @json($kategori);

                    document.addEventListener("DOMContentLoaded", function() {

                        $("#gridKategori").dxDataGrid({

                            dataSource: kategoriData,

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
                                            <div class="inline-flex items-center justify-center
                                                w-10 h-10 rounded-full
                                                bg-blue-100 text-blue-700 font-bold">
                                                ${String(nomor).padStart(2,'0')}
                                            </div>
                                        `);
                                    }
                                },

                                {
                                    dataField: "nama_kategori",
                                    caption: "🛠 Nama Kategori",

                                    cellTemplate: function(container, options) {
                                        $(container).html(`
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-lg bg-blue-50
                                                    flex items-center justify-center text-lg">
                                                    🛠
                                                </div>
                                                <div>
                                                    <div class="font-semibold">
                                                        ${options.data.nama_kategori}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        Kategori Kerusakan
                                                    </div>
                                                </div>
                                            </div>
                                        `);
                                    }
                                },

                                {
                                    caption: "⚙️ Aksi",
                                    width: 220,
                                    alignment: "center",

                                    cellTemplate: function(container, options) {
                                        const id = options.data.id;
                                        const nama = options.data.nama_kategori;

                                        $(container).html(`
                                            <div class="flex justify-center gap-2">
                                                <button
                                                    class="bg-yellow-500 hover:bg-yellow-600
                                                    text-white px-4 py-2 rounded-xl"
                                                    onclick="editKategori(${id},'${nama.replace(/'/g,"\\'")}')">
                                                    ✏ Edit
                                                </button>
                                                <button
                                                    class="bg-red-600 hover:bg-red-700
                                                    text-white px-4 py-2 rounded-xl"
                                                    onclick="hapusKategori(${id})">
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
                                fileName: "Data_Kategori"
                            },

                            loadPanel: {
                                enabled: true,
                                text: "Memuat data..."
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
                                const worksheet = workbook.addWorksheet("Kategori");

                                DevExpress.excelExporter.exportDataGrid({
                                    component: e.component,
                                    worksheet: worksheet
                                }).then(function() {
                                    workbook.xlsx.writeBuffer().then(function(buffer) {
                                        saveAs(
                                            new Blob([buffer], {
                                                type: "application/octet-stream"
                                            }),
                                            "DataKategori.xlsx"
                                        );
                                    });
                                });

                                e.cancel = true;
                            }
                        });

                    }); // menutup document.addEventListener
                </script>

            </div>

        </div>

    </div>

</x-app-layout>