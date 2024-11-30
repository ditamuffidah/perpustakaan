<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengarang</title>
</head>
<body>
    <h1>Daftar Pengarang</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pengarang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengarangs as $pengarang)
                <tr>
                    <td>{{ $pengarang->id }}</td>
                    <td>{{ $pengarang->nama_pengarang }}</td>
                    <td>
                        <!-- Tambahkan link untuk edit atau delete jika perlu -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
