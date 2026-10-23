<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Genre - Book Sales</title>
</head>
<body>
    <h1>Book Sales</h1>
    <h2>Daftar Genre Buku</h2>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Nama Genre</th>
        </tr>

        @foreach ($genres as $genre)
            <tr>
                <td>{{ $genre['id'] }}</td>
                <td>{{ $genre['name'] }}</td>
            </tr>
        @endforeach
    </table>

    <p>
        <a href="{{ route('authors.index') }}">Lihat Data Author</a>
    </p>
</body>
</html>