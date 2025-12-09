<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>@yield('title', 'Dashboard') - Hutan</title>
</head>
<body>
    <!-- Navbar -->
    @include('backend.bar.Navbar')

    <!-- Main Content -->
    <div class="content-container">
        <div class="content-box">
            @yield('content')
            @if(!trim($__env->yieldContent('content')))
                <h1>🌿 Selamat Datang! 🍃</h1>
                <p>Website ini menggunakan palette warna natural dari Color Hunt yang terdiri dari warna-warna earthy dan calming. Palette ini memberikan kesan alami, segar, dan harmonis dengan tema lingkungan.</p>
                <p style="margin-top: 1.5rem; font-weight: 600;">
                    Warna yang digunakan: <span style="color: #E5D9B6;">#E5D9B6</span> (Cream), 
                    <span style="color: #A4BE7B;">#A4BE7B</span> (Sage), 
                    <span style="color: #5F8D4E;">#5F8D4E</span> (Green), 
                    <span style="color: #285430;">#285430</span> (Dark Green)
                </p>
            @endif
        </div>
    </div>

    <!-- Footer -->
    @include('backend.bar.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
