<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SI-SKANSA') &mdash; Sistem Informasi Akademik</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
</head>
<body>
    <header>
        <a href="{{ route('siswa.index') }}">Siswa</a>
        <a href="{{ route('orangtua.index') }}">Orang Tua</a>
        <a href="{{ route('guru.index') }}">Guru</a>
        {{-- <a href="{{ route('orangtua.index') }}">Orang Tua</a> --}}
    </header>
    <!-- Isi Halaman -->
    <main class="main">
        @yield('content')
    </main>
    <!-- Footer -->
    <footer class="footer">
        <p>&copy; {{ date('Y') }} <strong>SI-SKANSA</strong> &mdash; Sistem Informasi SKANSA&bull; Dibuat untuk Kemudahan Pengelolaan Data</p>
    </footer>
</body>
</html>