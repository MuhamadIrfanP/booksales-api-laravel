<!DOCTYPE html>
<html>
<head>
    <title>Data Buku</title>
</head>
<body>
    <h1>Daftar Buku</h1>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Judul Buku</th>
            <th>Penulis</th>
            <th>Harga</th>
        </tr>

        @foreach ($books as $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author->name }}</td>
                <td>Rp{{ number_format($book->price, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </table>

    <p><a href="/authors">Lihat Data Penulis</a></p>
</body>
</html>