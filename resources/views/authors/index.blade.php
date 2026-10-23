<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Author - Book Sales</title>
</head>
<body>
    <h1>Book Sales</h1>
    <h2>Daftar Author Buku</h2>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Nama Author</th>
        </tr>

        @foreach ($authors as $author)
            <tr>
                <td>{{ $author['id'] }}</td>
                <td>{{ $author['name'] }}</td>
            </tr>
        @endforeach
    </table>

    <br>
    <a href="{{ route('genres.index') }}">Lihat Data Genre</a>
</body>
</html>