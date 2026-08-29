<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
</head>

<body style="font-family: Arial, sans-serif; color: #333;">
    <h2>Penugasan Laporan Kerusakan</h2>

    <p>Halo <strong>{{ $laporan->petugas->name }}</strong>,</p>

    <p>Anda ditugaskan untuk menangani laporan kerusakan berikut:</p>

    <table style="border-collapse: collapse; width: 100%;">
        <tr>
            <td style="padding: 4px 8px;"><strong>Judul</strong></td>
            <td style="padding: 4px 8px;">: {{ $laporan->judul }}</td>
        </tr>
        <tr>
            <td style="padding: 4px 8px;"><strong>Lokasi</strong></td>
            <td style="padding: 4px 8px;">: {{ $laporan->lokasi->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td style="padding: 4px 8px;"><strong>Kategori</strong></td>
            <td style="padding: 4px 8px;">: {{ $laporan->kategori->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td style="padding: 4px 8px;"><strong>Status</strong></td>
            <td style="padding: 4px 8px;">: {{ $laporan->status }}</td>
        </tr>
        <tr>
            <td style="padding: 4px 8px; vertical-align: top;"><strong>Deskripsi</strong></td>
            <td style="padding: 4px 8px;">: {{ $laporan->deskripsi }}</td>
        </tr>
    </table>

    <p style="margin-top: 16px;">Silakan segera tindak lanjuti laporan ini melalui sistem.</p>

    <p>Terima kasih.</p>
</body>

</html>