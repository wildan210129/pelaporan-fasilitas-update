<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>Data Laporan Kerusakan</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
        }

        .header p {
            margin-top: 5px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th {
            background-color: #2563eb;
            color: white;
            padding: 8px;
            border: 1px solid #ccc;
        }

        td {
            padding: 7px;
            border: 1px solid #ccc;
            vertical-align: top;
        }

        .center {
            text-align: center;
        }

        .footer {
            margin-top: 20px;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>

<body>

    <div class="header">

        <h1>DATA LAPORAN KERUSAKAN</h1>

        <p>
            Sistem Pelaporan Kerusakan Fasilitas Sekolah
        </p>

        <p>
            Dicetak pada: {{ now()->format('d F Y H:i') }}
        </p>

    </div>

    <table>

        <thead>

            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Lokasi</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Pelapor</th>
                <th>Petugas</th>
                <th>Tanggal</th>
            </tr>

        </thead>

        <tbody>

            @forelse($laporan as $item)

            <tr>

                <td class="center">
                    {{ $loop->iteration }}
                </td>

                <td>
                    {{ $item->judul }}
                </td>

                <td>
                    {{ $item->deskripsi }}
                </td>

                <td>
                    {{ $item->lokasi->nama_lokasi ?? '-' }}
                </td>

                <td>
                    {{ $item->kategori->nama_kategori ?? '-' }}
                </td>

                <td>
                    {{ $item->status }}
                </td>

                <td>
                    {{ $item->user->name ?? '-' }}
                </td>

                <td>
                    {{ $item->petugas->name ?? '-' }}
                </td>

                <td>
                    {{ $item->created_at
                        ? $item->created_at->format('d-m-Y H:i')
                        : '-' }}
                </td>

            </tr>

            @empty

            <tr>
                <td colspan="9" class="center">
                    Belum ada data laporan.
                </td>
            </tr>

            @endforelse

        </tbody>

    </table>

    <div class="footer">
        Total laporan: {{ $laporan->count() }}
    </div>

</body>

</html>