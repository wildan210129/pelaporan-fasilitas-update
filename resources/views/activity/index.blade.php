<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">
                📜 Log Activity
            </h2>

            <p class="text-gray-500 mt-1">
                Riwayat seluruh aktivitas yang dilakukan pengguna.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow-lg border border-gray-200">

                <div class="p-6 border-b">
                    <h2 class="text-2xl font-bold">
                        Daftar Aktivitas
                    </h2>

                    <p class="text-gray-500">
                        Semua aktivitas pengguna tersimpan di sini.
                    </p>
                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="px-6 py-4 text-center">
                                    No
                                </th>

                                <th class="px-6 py-4">
                                    User
                                </th>

                                <th class="px-6 py-4">
                                    Aktivitas
                                </th>

                                <th class="px-6 py-4">
                                    Modul
                                </th>

                                <th class="px-6 py-4">
                                    Waktu
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($logs as $log)
                            <tr class="border-b hover:bg-blue-50 transition">
                                <td class="px-6 py-4 text-center">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $log->user->name ?? '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $log->aktivitas }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $log->modul }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $log->created_at->format('d M Y H:i') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-gray-500">
                                    Belum ada aktivitas.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>

                </div>

                <div class="p-6 border-t border-gray-200">
                    {{ $logs->links() }}
                </div>

            </div>

        </div>
    </div>

</x-app-layout>