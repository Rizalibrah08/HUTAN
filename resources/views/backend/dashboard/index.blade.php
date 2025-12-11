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
                    <h2>#JAGALINGKUNGANKITA</h2>
                </div>

                <!-- News Slider Section -->
                <div class="home-news-section">
                    <div class="home-news-header">
                        <h2>Berita Terkini</h2>
                        <a href="/berita" class="btn-more">Lihat Semua Berita</a>
                    </div>

                    <div class="slider-news-grid">
                        <button class="slider-nav prev" id="prevBtn">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="slider-nav next" id="nextBtn">
                            <i class="fas fa-chevron-right"></i>
                        </button>

                        <div class="slider-news-wrapper" id="newsSlider">
                            <!-- CARD 1 -->
                            <div class="slider-news-card">
                                <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Berita 1">
                                <div class="slider-news-body">
                                    <span class="slider-news-tag">Siaran Pers</span>
                                    <h3 class="slider-news-title">
                                        Gajah Dukung Pemulihan Pasca Banjir di Pidie Jaya, Aceh.
                                    </h3>
                                    <div class="slider-news-footer">
                                        <span>09 Des 2025</span>
                                        <span class="slider-views">
                                            <i class="far fa-eye"></i> 365
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- CARD 2 -->
                            <div class="slider-news-card">
                                <img src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Berita 2">
                                <div class="slider-news-body">
                                    <span class="slider-news-tag">Siaran Pers</span>
                                    <h3 class="slider-news-title">
                                        Tanggapan atas Temuan Kayu di Wilayah Lampung
                                    </h3>
                                    <div class="slider-news-footer">
                                        <span>09 Des 2025</span>
                                        <span class="slider-views">
                                            <i class="far fa-eye"></i> 104
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- CARD 3 -->
                            <div class="slider-news-card">
                                <img src="https://images.unsplash.com/photo-1425913397330-cf8af2ff40a1?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Berita 3">
                                <div class="slider-news-body">
                                    <span class="slider-news-tag">Siaran Pers</span>
                                    <h3 class="slider-news-title">
                                        Gajah Terlatih Diterjunkan Dukung Pemulihan Pasca Banjir
                                    </h3>
                                    <div class="slider-news-footer">
                                        <span>08 Des 2025</span>
                                        <span class="slider-views">
                                            <i class="far fa-eye"></i> 178
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- CARD 4 -->
                            <div class="slider-news-card">
                                <img src="https://images.unsplash.com/photo-1501854140801-50d01698950b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Berita 4">
                                <div class="slider-news-body">
                                    <span class="slider-news-tag">Siaran Pers</span>
                                    <h3 class="slider-news-title">
                                        Menhut Raja Antoni: Mu'alimin Harus Tetap Jadi Benteng Ilmu
                                    </h3>
                                    <div class="slider-news-footer">
                                        <span>07 Des 2025</span>
                                        <span class="slider-views">
                                            <i class="far fa-eye"></i> 119
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- CARD 5 -->
                            <div class="slider-news-card">
                                <img src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Berita 5">
                                <div class="slider-news-body">
                                    <span class="slider-news-tag">Konservasi</span>
                                    <h3 class="slider-news-title">
                                        Program Reboisasi Sukses Tanam 10.000 Pohon di Jawa Barat
                                    </h3>
                                    <div class="slider-news-footer">
                                        <span>06 Des 2025</span>
                                        <span class="slider-views">
                                            <i class="far fa-eye"></i> 245
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Laporan Section -->
                <div class="lapor-section">
                    <div class="lapor-header">
                        <h2>Pengaduan Online Rakyat</h2>
                    </div>

                    <div class="lapor-konten">    
                        <div class="lapor-gambar">
                            <img src="{{ asset('images/40d1cf47b52f5d465e5acaeba6ad9fc9.jpg') }}" alt="Lapor Pak">
                        </div>

                        <div class="lapor-ajak">
                            <div class="box-lapor-text">
                                <p>
                                    Sampaikan keluhan dan laporan Anda mengenai kerusakan lingkungan 
                                    dengan mudah dan cepat. Sistem kami akan memproses laporan Anda 
                                    dan menindaklanjuti dengan pihak berwenang terkait. 
                                    Bersama kita jaga kelestarian lingkungan untuk generasi mendatang.
                                </p>
                                <p class="text-muted">
                                    <i class="fas fa-shield-alt me-2"></i>
                                    Laporan Anda akan dijaga kerahasiaannya
                                </p>
                            </div>
                            <div class="btn-lapor">
                                <a href="/lapor" class="btn-lapor-btn">
                                    <i class="fas fa-bullhorn me-2"></i>
                                    Lapor Pak!
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
            @endif
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
        const cards = document.querySelectorAll('.slider-news-card');

        if (newsSlider && cards.length > 0) {
            const cardWidth = cards[0].offsetWidth + 32; // width + gap
            
            prevBtn.addEventListener('click', () => {
                newsSlider.scrollBy({
                    left: -cardWidth,
                    behavior: 'smooth'
                });
            });

            nextBtn.addEventListener('click', () => {
                newsSlider.scrollBy({
                    left: cardWidth,
                    behavior: 'smooth'
                });
            });

            // Auto-hide buttons when at edges
            const updateNavButtons = () => {
                const scrollLeft = newsSlider.scrollLeft;
                const scrollWidth = newsSlider.scrollWidth;
                const clientWidth = newsSlider.clientWidth;
                
                prevBtn.style.opacity = scrollLeft <= 10 ? '0.5' : '0.9';
                nextBtn.style.opacity = scrollLeft + clientWidth >= scrollWidth - 10 ? '0.5' : '0.9';
            };

            newsSlider.addEventListener('scroll', updateNavButtons);
            updateNavButtons();
        }

        // Card click functionality
        document.querySelectorAll('.slider-news-card').forEach(card => {
            card.addEventListener('click', function() {
                // Add visual feedback
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
                
                // Here you can add navigation to article detail
                // window.location.href = '/artikel/1';
            });
            
            card.addEventListener('mouseenter', function() {
                this.style.zIndex = '5';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.zIndex = '1';
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
            handleNavbarToggle();
        });

        window.addEventListener('scroll', handleNavbarToggle);
        window.addEventListener('resize', handleNavbarToggle);
    </script>
</body>
</html>