<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>id</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Tgl. Terbit</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data_buku as $buku)
             <tr>
                <td>{{ $buku->id }}</td>
                <td>{{ $buku->judul }}</td>
                <td>{{ $buku->penulis }}</td>
                <td>{{ "Rp ".number_format($buku->harga, 2, ',', '.') }}</td>
                <td>{{ date('d/m/Y', strtotime($buku->tgl_terbit))}}</td>
            </tr>
        @endforeach
    </tbody>

    <p align="rigth"><a href="{{ route('buku.create')}}"> Tambah Buku</a></p>
    
    <td>
        <form action="{{ route('buku.destroy', $buku->id }}" method="post">
            @csrf
            <button onClick="return confirm('Yakin mau dihapus?')">Hapus</button>
        </form>
    </td>

    <table>
    <thead>
        <tr>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Tahun Terbit</th>
            <th>Aksi</th> 
        </tr>
    </thead>
    <tbody>
        @foreach ($bukus as $buku)
        <tr>
            <td>{{ $buku->judul }}</td>
            <td>{{ $buku->pengarang }}</td>
            <td>{{ $buku->tahun_terbit }}</td>
            <td>
                <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-primary">Update</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<form method="post" action="{{ route('buku.update', $buku->id) }}">
    @csrf
    @method('PUT') 
    <div>
        Judul <input type="text" name="judul" value="{{ $buku->judul }}">
    </div>
    <div>
        <button type="submit">Simpan Perubahan</button>
    </div>
</form>


</table>
    <p>Jumlah Total Buku: {{ $totalBuku }}</p>
    <p>Jumlah Total Harga Semua Buku: {{ $totalHarga }}</p>
</body>
</html>
