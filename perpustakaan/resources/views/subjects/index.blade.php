<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Subjects</title>
</head>
<body>
    <h1>Daftar Subjects</h1>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Subject</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($subjects as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
