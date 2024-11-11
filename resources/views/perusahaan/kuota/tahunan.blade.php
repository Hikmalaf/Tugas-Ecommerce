<!-- resources/views/kuota/tahunan.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kuota Tahunan</title>
</head>
<body>
    <h1>Data Kuota Tahunan</h1>

    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Perusahaan</th>
                <th>Tahun</th>
                <th>Nomor Penetapan</th>
                <th>Tanggal Penetapan</th>
                <th>Status</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($annualQuotas as $index => $quota)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $quota->perusahaan->nama_perusahaan ?? '-' }}</td> <!-- Nama perusahaan -->
                    <td>{{ $quota->tahun }}</td>
                    <td>{{ $quota->nomor_penetapan }}</td>
                    <td>{{ $quota->tanggal_penetapan }}</td>
                    <td>{{ $quota->status }}</td>
                    <td>{{ $quota->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
