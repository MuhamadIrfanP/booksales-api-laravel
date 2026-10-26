<!DOCTYPE html>
<html>
<head>
    <title>Data Penulis</title>
</head>
<body>
    <h1>Daftar Penulis</h1>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Nama Penulis</th>
            <th>Jumlah Buku</th>
        </tr>

        @foreach ($authors as $author)
            <tr>
                <td>{{ $author->id }}</td>
                <td>{{ $author->name }}</td>
                <td>{{ $author->books->count() }}</td>
            </tr>
        @endforeach
    </table>

    <p><a href="/books">Lihat Data Buku</a></p>
</body>
</html>