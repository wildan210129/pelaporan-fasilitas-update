<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-bold text-gray-800">
                    📍 Data Lokasi
                </h2>

                <p class="text-gray-500 mt-1">
                    Kelola semua lokasi fasilitas sekolah
                </p>

            </div>

        </div>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Alert --}}
            @if(session('success'))

            <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-green-700 shadow-sm">

                <div class="flex items-center gap-3">

                    <div class="text-2xl">
                        ✅
                    </div>

                    <div>

                        <h3 class="font-semibold">
                            Berhasil
                        </h3>

                        <p>
                            {{ session('success') }}
                        </p>

                    </div>

                </div>

            </div>

            @endif

            <div class="bg-white rounded-2xl shadow-xl border border-gray-100">

                {{-- Header Card --}}
                <div class="p-6 border-b border-gray-100">

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                        <div>

                            <h3 class="text-xl font-bold text-gray-800">

                                📍 Daftar Lokasi

                            </h3>

                            <p class="text-gray-500 text-sm mt-1">

                                Seluruh lokasi fasilitas sekolah yang dapat dipilih ketika membuat laporan.

                            </p>

                        </div>

                        <button
                            onclick="document.getElementById('modalTambah').classList.remove('hidden')"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl shadow-lg font-semibold transition">

                            + Tambah Lokasi

                        </button>

                    </div>

                </div>

                {{-- Table --}}
                <div class="overflow-x-auto p-2">

                    <div id="gridLokasi"></div>

                </div>

                {{-- =========================
     MODAL TAMBAH LOKASI
========================= --}}

                <div id="modalTambah"
                    class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">

                    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden">

                        {{-- Header --}}
                        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-5 text-white">

                            <div class="flex items-center justify-between">

                                <div>

                                    <h2 class="text-xl font-bold">
                                        📍 Tambah Lokasi
                                    </h2>

                                    <p class="text-blue-100 text-sm mt-1">
                                        Tambahkan lokasi fasilitas sekolah.
                                    </p>

                                </div>

                                <button
                                    onclick="tutupModalTambah()"
                                    class="text-3xl hover:rotate-90 transition">

                                    &times;

                                </button>

                            </div>

                        </div>

                        {{-- Form --}}
                        <form
                            action="{{ route('lokasi.store') }}"
                            method="POST">

                            @csrf

                            <div class="p-6">

                                <label class="block font-semibold text-gray-700 mb-2">

                                    Nama Lokasi

                                </label>

                                <input
                                    type="text"
                                    name="nama_lokasi"
                                    placeholder="Contoh: Laboratorium Komputer"
                                    class="w-full rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    required>

                                <p class="text-sm text-gray-500 mt-2">

                                    Lokasi ini akan muncul pada saat siswa membuat laporan.

                                </p>

                            </div>

                            {{-- Footer --}}
                            <div class="bg-gray-50 px-6 py-4 flex justify-end gap-3">

                                <button
                                    type="button"
                                    onclick="tutupModalTambah()"
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
     MODAL EDIT LOKASI
========================= --}}

                <div id="modalEdit"
                    class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">

                    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden">

                        {{-- Header --}}
                        <div class="bg-gradient-to-r from-yellow-500 to-orange-500 px-6 py-5 text-white">

                            <div class="flex items-center justify-between">

                                <div>

                                    <h2 class="text-xl font-bold">
                                        ✏ Edit Lokasi
                                    </h2>

                                    <p class="text-yellow-100 text-sm mt-1">
                                        Perbarui nama lokasi fasilitas sekolah.
                                    </p>

                                </div>

                                <button
                                    type="button"
                                    onclick="tutupModalEdit()"
                                    class="text-3xl hover:rotate-90 transition">

                                    &times;

                                </button>

                            </div>

                        </div>

                        <form
                            id="formEdit"
                            method="POST">

                            @csrf
                            @method('PUT')

                            <div class="p-6">

                                <label class="block font-semibold text-gray-700 mb-2">

                                    Nama Lokasi

                                </label>

                                <input
                                    id="editNama"
                                    type="text"
                                    name="nama_lokasi"
                                    class="w-full rounded-xl border-gray-300 focus:ring-yellow-500 focus:border-yellow-500"
                                    required>

                                <p class="text-sm text-gray-500 mt-2">

                                    Pastikan nama lokasi sudah benar sebelum disimpan.

                                </p>

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
     MODAL HAPUS LOKASI
========================= --}}

                <div id="modalDelete"
                    class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">

                    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">

                        {{-- Header --}}
                        <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-5 text-white text-center">

                            <div class="w-20 h-20 mx-auto rounded-full bg-white/20 flex items-center justify-center text-5xl">

                                🗑

                            </div>

                            <h2 class="mt-4 text-2xl font-bold">

                                Hapus Lokasi

                            </h2>

                            <p class="text-red-100 mt-2">

                                Data yang dihapus tidak dapat dikembalikan.

                            </p>

                        </div>

                        {{-- Body --}}
                        <div class="p-6 text-center">

                            <p class="text-gray-600">

                                Apakah Anda yakin ingin menghapus lokasi ini?

                            </p>

                            <p class="text-sm text-gray-400 mt-2">

                                Tindakan ini bersifat permanen.

                            </p>

                        </div>

                        {{-- Footer --}}
                        <form id="formDelete" method="POST">

                            @csrf
                            @method('DELETE')

                            <div class="bg-gray-50 px-6 py-4 flex justify-center gap-3">

                                <button
                                    type="button"
                                    onclick="tutupDelete()"
                                    class="px-5 py-2 rounded-xl bg-gray-300 hover:bg-gray-400 transition">

                                    Batal

                                </button>

                                <button
                                    type="submit"
                                    class="px-5 py-2 rounded-xl bg-red-600 hover:bg-red-700 text-white shadow-lg transition">

                                    🗑 Ya, Hapus

                                </button>

                            </div>

                        </form>

                    </div>

                </div>
                <script>
                    function editLokasi(id, nama) {
                        document.getElementById('editNama').value = nama;
                        document.getElementById('formEdit').action = "/lokasi/" + id;
                        document.getElementById('modalEdit').classList.remove('hidden');
                    }

                    function tutupModalEdit() {
                        document.getElementById('modalEdit').classList.add('hidden');
                    }

                    function tutupModalTambah() {
                        document.getElementById('modalTambah').classList.add('hidden');
                    }

                    function hapusLokasi(id) {
                        document.getElementById('formDelete').action = "/lokasi/" + id;
                        document.getElementById('modalDelete').classList.remove('hidden');
                    }

                    function tutupDelete() {
                        document.getElementById('modalDelete').classList.add('hidden');
                    }

                    const lokasiData = @json($lokasi);

                    document.addEventListener("DOMContentLoaded", function() {

                        $("#gridLokasi").dxDataGrid({

                            elementAttr: {
                                id: "lokasiGrid"
                            },

                            dataSource: lokasiData,

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
                                                w-10 h-10 rounded-full bg-blue-100
                                                text-blue-700 font-bold">
                                                ${String(nomor).padStart(2,'0')}
                                            </div>
                                        `);

                                    }
                                },
                                {
                                    dataField: "nama_lokasi",
                                    caption: "📍 Nama Lokasi",

                                    cellTemplate: function(container, options) {

                                        $(container).html(`
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-lg bg-blue-50
                                                    flex items-center justify-center text-lg">
                                                    📍
                                                </div>
                                                <div>
                                                    <div class="font-semibold">
                                                        ${options.data.nama_lokasi}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        Lokasi Fasilitas Sekolah
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
                                        const nama = options.data.nama_lokasi;

                                        $(container).html(`
                                            <div class="flex justify-center gap-2">
                                                <button
                                                    class="bg-yellow-500 hover:bg-yellow-600
                                                    text-white px-4 py-2 rounded-xl"
                                                    onclick="editLokasi(${id},'${nama.replace(/'/g,"\\'")}')">
                                                    ✏ Edit
                                                </button>
                                                <button
                                                    class="bg-red-600 hover:bg-red-700
                                                    text-white px-4 py-2 rounded-xl"
                                                    onclick="hapusLokasi(${id})">
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
                                fileName: "Data_Lokasi",
                                allowExportSelectedData: true
                            },

                            loadPanel: {
                                enabled: true,
                                text: "Memuat data lokasi..."
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

                                const worksheet = workbook.addWorksheet('Lokasi');

                                DevExpress.excelExporter.exportDataGrid({
                                    component: e.component,
                                    worksheet: worksheet
                                }).then(function() {

                                    workbook.xlsx.writeBuffer().then(function(buffer) {

                                        saveAs(
                                            new Blob([buffer], {
                                                type: "application/octet-stream"
                                            }),
                                            "DataLokasi.xlsx"
                                        );

                                    });

                                });

                                e.cancel = true;
                            }

                        });

                    });
                </script>

</x-app-layout>