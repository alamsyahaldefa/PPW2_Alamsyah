<!DOCTYPE html>
<html>
    <head>
        <title>Selamat Datang di Aplikasi Kami</title>
    </head>
    <body>
        <h3>{{ $data['subject'] }}</h3>
        <h4>{{ $data['body'] }}</h4>
        <p>Nama: {{ $data['user']->name }}</p>
        <p>Email: {{ $data['user']->email }}</p>
        <p>Terima kasih</p>
    </body>
</html>