<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Perumahan</title>
</head>
<body>
    <h1>Daftar Perumahan</h1>
    <table border="1">
        <tr>
            <th>ID Perumahan</th>
            <th>Luas Perumahan</th>
            <th>Harga Perumahan</th>
        </tr>
        @foreach($perumahan as $p)
        <tr>
            <td>{{ $p->id_perumahan }}</td>
            <td>{{ $p->luas_perumahan }}</td>
            <td>{{ $p->harga_perumahan }}</td>
        </tr>
        @endforeach
    </table> 
</body>
</html>
