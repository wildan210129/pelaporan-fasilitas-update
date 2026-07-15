<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pelaporan Kerusakan Fasilitas Sekolah</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800">

    <!-- =================== NAVBAR =================== -->

    <nav class="bg-white shadow-md fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            <div>
                <h1 class="text-2xl font-bold text-blue-700">
                    Sistem Pelaporan
                </h1>

                <p class="text-sm text-gray-500">
                    Kerusakan Fasilitas Sekolah
                </p>
            </div>

            <div class="space-x-3">

                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition">
                        Dashboard
                    </a>
                @else

                    <a href="{{ route('login') }}"
                        class="text-gray-700 hover:text-blue-600 font-medium">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition">
                        Register
                    </a>

                @endauth

            </div>

        </div>
    </nav>

    <!-- =================== HERO =================== -->

    <section
        class="min-h-screen bg-gradient-to-br from-blue-700 via-blue-600 to-sky-500 flex items-center">

        <div
            class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">

            <!-- KIRI -->

            <div class="text-white">

                <span
                    class="bg-white/20 px-4 py-2 rounded-full text-sm">
                    Website Resmi
                </span>

                <h1
                    class="text-5xl md:text-6xl font-bold leading-tight mt-6">

                    Sistem Pelaporan

                    <br>

                    Kerusakan

                    <span class="text-yellow-300">
                        Fasilitas Sekolah
                    </span>

                </h1>

                <p
                    class="mt-8 text-lg text-blue-100 leading-8">

                    Website ini membantu siswa, guru, dan warga sekolah
                    dalam melaporkan kerusakan fasilitas sekolah secara
                    cepat, mudah, dan transparan sehingga proses
                    perbaikan dapat dilakukan dengan lebih efektif.

                </p>

                <div class="mt-10 flex flex-wrap gap-4">

                    <a href="{{ route('login') }}"
                        class="bg-white text-blue-700 hover:bg-gray-100 font-semibold px-8 py-4 rounded-xl transition">

                        Login

                    </a>

                    <a href="{{ route('register') }}"
                        class="border-2 border-white hover:bg-white hover:text-blue-700 px-8 py-4 rounded-xl transition">

                        Register

                    </a>

                </div>

            </div>

            <!-- KANAN -->

            <div class="flex justify-center">

                <div
                    class="bg-white rounded-3xl shadow-2xl p-10 w-full max-w-md">

                    <div
                        class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto">

                        <span class="text-5xl">
                            🏫
                        </span>

                    </div>

                    <h2
                        class="text-2xl font-bold text-center mt-6 text-blue-700">

                        Laporkan Kerusakan

                    </h2>

                    <p
                        class="text-gray-600 text-center mt-4">

                        Laporkan kerusakan ruang kelas,
                        meja, kursi, toilet, laboratorium,
                        maupun fasilitas sekolah lainnya
                        dengan mudah melalui website ini.

                    </p>

                    <div
                        class="mt-8 space-y-4">

                        <div
                            class="bg-blue-50 rounded-xl p-4">

                            📋 Mudah Membuat Laporan

                        </div>

                        <div
                            class="bg-blue-50 rounded-xl p-4">

                            📷 Upload Foto Kerusakan

                        </div>

                        <div
                            class="bg-blue-50 rounded-xl p-4">

                            📊 Pantau Status Perbaikan

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- =================== FITUR =================== -->

<section class="py-24 bg-white">

    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-4xl font-bold text-center text-blue-700">
            Mengapa Menggunakan Sistem Ini?
        </h2>

        <p class="text-center text-gray-500 mt-4 mb-14">
            Sistem dibuat untuk mempermudah pelaporan kerusakan fasilitas sekolah.
        </p>

        <div class="grid md:grid-cols-4 gap-8">

            <div class="bg-blue-50 rounded-2xl p-8 text-center shadow hover:shadow-xl transition">
                <div class="text-5xl mb-5">⚡</div>
                <h3 class="font-bold text-xl mb-3">Cepat</h3>
                <p class="text-gray-600">
                    Pelaporan dapat dilakukan kapan saja secara online.
                </p>
            </div>

            <div class="bg-blue-50 rounded-2xl p-8 text-center shadow hover:shadow-xl transition">
                <div class="text-5xl mb-5">📷</div>
                <h3 class="font-bold text-xl mb-3">Upload Foto</h3>
                <p class="text-gray-600">
                    Bukti kerusakan dapat langsung dilampirkan.
                </p>
            </div>

            <div class="bg-blue-50 rounded-2xl p-8 text-center shadow hover:shadow-xl transition">
                <div class="text-5xl mb-5">📍</div>
                <h3 class="font-bold text-xl mb-3">Lokasi</h3>
                <p class="text-gray-600">
                    Menentukan lokasi kerusakan menjadi lebih mudah.
                </p>
            </div>

            <div class="bg-blue-50 rounded-2xl p-8 text-center shadow hover:shadow-xl transition">
                <div class="text-5xl mb-5">📊</div>
                <h3 class="font-bold text-xl mb-3">Monitoring</h3>
                <p class="text-gray-600">
                    Status perbaikan dapat dipantau secara realtime.
                </p>
            </div>

        </div>

    </div>

</section>

<!-- =================== ALUR =================== -->

<section class="py-24 bg-gray-100">

    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-4xl font-bold text-center text-blue-700">
            Alur Pelaporan
        </h2>

        <p class="text-center text-gray-500 mt-4 mb-16">
            Proses pelaporan yang sederhana dan mudah dipahami.
        </p>

        <div class="grid md:grid-cols-4 gap-8 text-center">

            <div class="bg-white rounded-2xl shadow p-8">
                <div class="text-6xl">👤</div>
                <h3 class="font-bold mt-5">1. Login</h3>
                <p class="mt-3 text-gray-600">
                    Masuk menggunakan akun yang telah tersedia.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow p-8">
                <div class="text-6xl">📝</div>
                <h3 class="font-bold mt-5">2. Buat Laporan</h3>
                <p class="mt-3 text-gray-600">
                    Isi data kerusakan dan upload foto.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow p-8">
                <div class="text-6xl">🛠️</div>
                <h3 class="font-bold mt-5">3. Diproses</h3>
                <p class="mt-3 text-gray-600">
                    Admin memverifikasi laporan yang masuk.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow p-8">
                <div class="text-6xl">✅</div>
                <h3 class="font-bold mt-5">4. Selesai</h3>
                <p class="mt-3 text-gray-600">
                    Status berubah menjadi selesai setelah diperbaiki.
                </p>
            </div>

        </div>

    </div>

</section>