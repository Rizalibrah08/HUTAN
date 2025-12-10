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
            <div>
                <div class="gambar">
                    {{-- <img src="{{ asset('images/bg_b1a8a31387.webp') }}" alt="Dashboard Forest" class="img-fluid"> --}}
                    <h2>#JAGALINGKUNGANKITA</h2>
                </div>

                {{-- Placeholder for berita section --}}
                <div class="news-section">
                <div class="news-header">
                    <h2>Berita Terkini</h2>
                    <a href="#" class="btn-more">Berita Lainnya</a>
                </div>

                <div class="news-grid">
                    <button class="slider-nav prev" id="prevBtn">❮</button>
                    <button class="slider-nav next" id="nextBtn">❯</button>

                    <div class="news-grid-wrapper" id="newsSlider">
                        <!-- CARD 1 -->
                        <div class="news-card">
                            <img src="https://via.placeholder.com/350x200?text=Berita+1" alt="Berita 1">
                            <div class="news-body">
                                <p class="news-tag">Siaran Pers</p>
                                <h3 class="news-title">
                                    Gajah Dukung Pemulihan Pasca Banjir di Pidie Jaya, Aceh.
                                </h3>

                                <div class="news-footer">
                                    <span>Selasa, 09 Des 2025</span>
                                    <span class="views">👁️ 365</span>
                                </div>
                            </div>
                        </div>

                        <!-- CARD 2 -->
                        <div class="news-card">
                            <img src="https://via.placeholder.com/350x200?text=Berita+2" alt="Berita 2">
                            <div class="news-body">
                                <p class="news-tag">Siaran Pers</p>
                                <h3 class="news-title">
                                    Tanggapan atas Temuan Kayu di Wilayah Lampung
                                </h3>

                                <div class="news-footer">
                                    <span>Selasa, 09 Des 2025</span>
                                    <span class="views">👁️ 104</span>
                                </div>
                            </div>
                        </div>

                        <!-- CARD 3 -->
                        <div class="news-card">
                            <img src="https://via.placeholder.com/350x200?text=Berita+3" alt="Berita 3">
                            <div class="news-body">
                                <p class="news-tag">Siaran Pers</p>
                                <h3 class="news-title">
                                    Gajah Terlatih Diterjunkan Dukung Pemulihan Pasca Banjir
                                </h3>

                                <div class="news-footer">
                                    <span>Senin, 08 Des 2025</span>
                                    <span class="views">👁️ 178</span>
                                </div>
                            </div>
                        </div>

                        <!-- CARD 3 -->
                        <div class="news-card">
                            <img src="https://via.placeholder.com/350x200?text=Berita+4" alt="Berita 4">
                            <div class="news-body">
                                <p class="news-tag">Siaran Pers</p>
                                <h3 class="news-title">
                                    Menhut Raja Antoni: Mu'alimin Harus Tetap Jadi Benteng Ilmu
                                </h3>

                                <div class="news-footer">
                                    <span>Minggu, 07 Des 2025</span>
                                    <span class="views">👁️ 119</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

                {{-- Placeholder for layanan section --}}

            <div class="news-section">
                <div class="news-header">
                    <h2>Pengaduan Online Rakyat</h2>
                </div>

                <div class="lapor-konten">    
                    {{-- gambar --}}
                    <div class="lapor-gambar">
                        <img src="{{ asset('images/40d1cf47b52f5d465e5acaeba6ad9fc9.jpg') }}" alt="">
                    </div>

                    <div class="lapor-ajak">
                        {{-- text --}}
                        <div class="box-lapor-text">
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsum suscipit eum quas nisi numquam similique eius, vel inventore enim natus praesentium et, reprehenderit sunt itaque dolores officia non fuga. Fugit.</p>
                        </div>
                        {{-- lapor --}}
                        <div class="btn-lapor">
                            <a href="/laporpak" class="btn btn-danger ">Lapor Pak!</a>

                        </div>
                    </div>
                </div>
            </div>

                {{-- Placeholder for info section --}}
                
                {{-- Placeholder for kalender section --}}
                
            @endif
        </div>
    </div>
    </div>
    

    <!-- Footer -->
    @include('backend.bar.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // News Slider Functionality
        const newsSlider = document.getElementById('newsSlider');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        // Scroll amount per click (350px card + 32px gap)
        const scrollAmount = 382;

        prevBtn.addEventListener('click', () => {
            newsSlider.scrollBy({
                left: -scrollAmount,
                behavior: 'smooth'
            });
        });

        nextBtn.addEventListener('click', () => {
            newsSlider.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        });
        
        // Navbar transparency toggle
        function handleNavbarToggle() {
            const navContainer = document.querySelector('.nav-container');
            const hero = document.querySelector('.gambar');
            if (!navContainer) return;

            const threshold = hero ? (hero.offsetHeight - 100) : 80;
            if (window.scrollY > threshold) {
                navContainer.classList.remove('nav-transparent');
                navContainer.classList.add('nav-solid');
            } else {
                navContainer.classList.remove('nav-solid');
                navContainer.classList.add('nav-transparent');
            }
        }

        // Initialize and bind
        document.addEventListener('DOMContentLoaded', () => {
            // set initial state
            handleNavbarToggle();
        });

        window.addEventListener('scroll', () => {
            handleNavbarToggle();
        });
    </script>
</body>
</html>
