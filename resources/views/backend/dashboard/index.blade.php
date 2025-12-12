<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>@yield('title', 'Dashboard') - Hutan</title>
    @php
        use Illuminate\Support\Str;
    @endphp
    <style>
        /* Tambahan styling untuk card lihat lainnya */
        .lihat-lainnya-card {
            background: linear-gradient(135deg, var(--green) 0%, var(--dark-green) 100%);
            border: none;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 2rem 1.5rem;
            cursor: pointer;
            transition: all 0.4s ease;
        }
        
        .lihat-lainnya-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(95, 141, 78, 0.3);
            background: linear-gradient(135deg, var(--dark-green) 0%, var(--green) 100%);
        }
        
        .lihat-lainnya-icon {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            opacity: 0.9;
        }
        
        .lihat-lainnya-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 0.8rem;
        }
        
        .lihat-lainnya-text {
            font-size: 1rem;
            opacity: 0.9;
            margin-bottom: 1.5rem;
            line-height: 1.5;
        }
        
        .lihat-lainnya-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.8rem 1.8rem;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(5px);
        }
        
        .lihat-lainnya-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-3px);
            border-color: rgba(255, 255, 255, 0.5);
        }
        
        .lihat-lainnya-stats {
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            width: 100%;
            font-size: 0.9rem;
            opacity: 0.8;
        }
    </style>
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
                        <a href="{{ route('berita.index') }}" class="btn-more">
                            <i class="fas fa-list me-2"></i>
                            Lihat Semua Berita
                        </a>
                    </div>

                    <div class="slider-news-grid">
                        <button class="slider-nav prev" id="prevBtn">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="slider-nav next" id="nextBtn">
                            <i class="fas fa-chevron-right"></i>
                        </button>

                        <div class="slider-news-wrapper" id="newsSlider">
                            <!-- Looping data berita dari database (4 berita) -->
                            @forelse($beritaTerkini as $berita)
                            <div class="slider-news-card">
                                <img src="{{ $berita->gambar_url }}" alt="{{ $berita->judul }}">
                                <div class="slider-news-body">
                                    <span class="slider-news-tag">{{ $berita->kategori }}</span>
                                    <h3 class="slider-news-title">
                                        {{ Str::limit($berita->judul, 70) }}
                                    </h3>
                                    <div class="slider-news-footer">
                                        <span>{{ $berita->created_at->format('d M Y') }}</span>
                                        <span class="slider-views">
                                            <i class="far fa-eye"></i> {{ number_format($berita->views) }}
                                        </span>
                                    </div>
                                </div>
                                <!-- Link untuk redirect ke detail berita -->
                                <a href="{{ route('berita.show', $berita->id) }}" class="stretched-link"></a>
                            </div>
                            @empty
                            <!-- Jika tidak ada berita, tampilkan placeholder -->
                            <div class="slider-news-card">
                                <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Berita 1">
                                <div class="slider-news-body">
                                    <span class="slider-news-tag">Informasi</span>
                                    <h3 class="slider-news-title">
                                        Belum ada berita tersedia
                                    </h3>
                                    <div class="slider-news-footer">
                                        <span>{{ now()->format('d M Y') }}</span>
                                        <span class="slider-views">
                                            <i class="far fa-eye"></i> 0
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endforelse

                            <!-- Card "Lihat Lainnya" -->
                            <div class="slider-news-card lihat-lainnya-card">
                                <div class="lihat-lainnya-icon">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                                <h3 class="lihat-lainnya-title">Lihat Berita Lainnya</h3>
                                <p class="lihat-lainnya-text">
                                    Jelajahi semua berita terkini tentang lingkungan dan konservasi
                                </p>
                                <a href="{{ route('berita.index') }}" class="lihat-lainnya-btn">
                                    <span>Jelajahi</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                                @if($totalBerita > 4)
                                <div class="lihat-lainnya-stats">
                                    Masih ada {{ $totalBerita - count($beritaTerkini) }} berita lainnya
                                </div>
                                @endif
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
    // News Slider Functionality dengan Auto-Slide cepat
    const newsSlider = document.getElementById('newsSlider');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const cards = document.querySelectorAll('.slider-news-card');
    
    // Variabel untuk auto-slide
    let autoSlideInterval;
    let isAutoSliding = true;
    let currentSlide = 0;
    const totalSlides = cards.length;
    const cardWidth = cards[0] ? cards[0].offsetWidth + 32 : 352; // width + gap
    const visibleSlides = 3; // Jumlah slide yang terlihat
    
    if (newsSlider && cards.length > 0) {
        // Fungsi untuk slide ke posisi tertentu
        function slideTo(position) {
            newsSlider.scrollTo({
                left: position * cardWidth,
                behavior: 'smooth'
            });
            currentSlide = position;
            updateNavButtons();
            updateIndicators();
        }
        
        // Fungsi untuk slide berikutnya
        function slideNext() {
            if (currentSlide < totalSlides - visibleSlides) {
                slideTo(currentSlide + 1);
            } else {
                // Kembali ke slide pertama
                slideTo(0);
            }
        }
        
        // Fungsi untuk slide sebelumnya
        function slidePrev() {
            if (currentSlide > 0) {
                slideTo(currentSlide - 1);
            } else {
                // Pergi ke slide terakhir yang memungkinkan
                slideTo(totalSlides - visibleSlides);
            }
        }
        
        // Event listeners untuk tombol navigasi
        prevBtn.addEventListener('click', (e) => {
            e.preventDefault();
            slidePrev();
            resetAutoSlide();
        });
        
        nextBtn.addEventListener('click', (e) => {
            e.preventDefault();
            slideNext();
            resetAutoSlide();
        });
        
        // Auto-hide buttons when at edges
        function updateNavButtons() {
            if (!prevBtn || !nextBtn) return;
            
            const maxSlide = totalSlides - visibleSlides;
            
            prevBtn.style.opacity = currentSlide === 0 ? '0.3' : '0.8';
            prevBtn.style.pointerEvents = currentSlide === 0 ? 'none' : 'auto';
            
            nextBtn.style.opacity = currentSlide >= maxSlide ? '0.3' : '0.8';
            nextBtn.style.pointerEvents = currentSlide >= maxSlide ? 'none' : 'auto';
        }
        
        // Update indicators - hanya 3 indicators
        function updateIndicators() {
            const indicators = document.querySelectorAll('.slider-indicator');
            const maxGroups = Math.max(1, totalSlides - visibleSlides + 1);
            const currentGroup = Math.floor(currentSlide / visibleSlides);
            
            indicators.forEach((indicator, index) => {
                if (index === currentGroup) {
                    indicator.classList.add('active');
                } else {
                    indicator.classList.remove('active');
                }
            });
        }
        
        // Detect slide saat scroll manual
        newsSlider.addEventListener('scroll', () => {
            const scrollPosition = newsSlider.scrollLeft;
            currentSlide = Math.round(scrollPosition / cardWidth);
            updateNavButtons();
            updateIndicators();
            resetAutoSlide();
        });
        
        // Fungsi untuk reset auto-slide timer
        function resetAutoSlide() {
            if (autoSlideInterval) {
                clearInterval(autoSlideInterval);
            }
            if (isAutoSliding) {
                startAutoSlide();
            }
        }
        
        // Start auto-slide - LEBIH CEPAT (2.5 detik)
        function startAutoSlide() {
            autoSlideInterval = setInterval(() => {
                slideNext();
            }, 2500); // Geser setiap 2.5 detik (lebih cepat!)
        }
        
        // Pause auto-slide saat hover
        newsSlider.addEventListener('mouseenter', () => {
            isAutoSliding = false;
            if (autoSlideInterval) {
                clearInterval(autoSlideInterval);
            }
        });
        
        // Resume auto-slide saat mouse leave
        newsSlider.addEventListener('mouseleave', () => {
            isAutoSliding = true;
            startAutoSlide();
        });
        
        // Pause auto-slide saat touch/swipe (mobile)
        newsSlider.addEventListener('touchstart', () => {
            isAutoSliding = false;
            if (autoSlideInterval) {
                clearInterval(autoSlideInterval);
            }
        });
        
        // Resume setelah 3 detik dari touch
        newsSlider.addEventListener('touchend', () => {
            setTimeout(() => {
                isAutoSliding = true;
                startAutoSlide();
            }, 3000);
        });
        
        // Tambah indicators dots - MAKSIMAL 3
        function createIndicators() {
            const sliderGrid = newsSlider.closest('.slider-news-grid');
            
            // Hapus indicators lama jika ada
            const oldIndicators = sliderGrid.querySelector('.slider-indicators');
            if (oldIndicators) {
                oldIndicators.remove();
            }
            
            const indicatorsContainer = document.createElement('div');
            indicatorsContainer.className = 'slider-indicators';
            
            // Hitung jumlah kelompok (maksimal 3)
            const maxGroups = Math.min(3, Math.max(1, totalSlides - visibleSlides + 1));
            
            for (let i = 0; i < maxGroups; i++) {
                const indicator = document.createElement('div');
                indicator.className = `slider-indicator ${i === 0 ? 'active' : ''}`;
                indicator.dataset.group = i;
                
                indicator.addEventListener('click', () => {
                    const targetSlide = i * visibleSlides;
                    slideTo(targetSlide);
                    resetAutoSlide();
                });
                
                indicatorsContainer.appendChild(indicator);
            }
            
            sliderGrid.appendChild(indicatorsContainer);
        }
        
        // Tambah fitur drag/swipe untuk mobile
        let isDragging = false;
        let startPos = 0;
        let currentTranslate = 0;
        let prevTranslate = 0;
        
        newsSlider.addEventListener('mousedown', dragStart);
        newsSlider.addEventListener('touchstart', dragStart);
        
        newsSlider.addEventListener('mousemove', drag);
        newsSlider.addEventListener('touchmove', drag);
        
        newsSlider.addEventListener('mouseup', dragEnd);
        newsSlider.addEventListener('mouseleave', dragEnd);
        newsSlider.addEventListener('touchend', dragEnd);
        
        function dragStart(e) {
            if (e.type === 'touchstart') {
                startPos = e.touches[0].clientX;
            } else {
                startPos = e.clientX;
                e.preventDefault();
            }
            
            isDragging = true;
            resetAutoSlide();
        }
        
        function drag(e) {
            if (!isDragging) return;
            
            let currentPos = 0;
            if (e.type === 'touchmove') {
                currentPos = e.touches[0].clientX;
            } else {
                currentPos = e.clientX;
            }
            
            const diff = currentPos - startPos;
            
            // Geser slider berdasarkan drag
            if (Math.abs(diff) > 10) { // Dead zone 10px
                newsSlider.scrollLeft = prevTranslate - diff;
            }
        }
        
        function dragEnd() {
            isDragging = false;
            
            // Snap to nearest slide
            const scrollPosition = newsSlider.scrollLeft;
            currentSlide = Math.round(scrollPosition / cardWidth);
            
            // Pastikan tidak melebihi batas
            const maxSlide = totalSlides - visibleSlides;
            if (currentSlide < 0) currentSlide = 0;
            if (currentSlide > maxSlide) currentSlide = maxSlide;
            
            slideTo(currentSlide);
        }
        
        // Initialize
        updateNavButtons();
        createIndicators();
        
        // Mulai auto-slide setelah 1 detik
        setTimeout(() => {
            startAutoSlide();
        }, 1000);
    }
    
    // Card click functionality
    document.getElementById('newsSlider')?.addEventListener('click', function(e) {
        if (isDragging) return; // Jangan trigger click saat drag
        
        const card = e.target.closest('.slider-news-card');
        if (card && !card.classList.contains('lihat-lainnya-card')) {
            const link = card.querySelector('.stretched-link');
            if (link && !e.target.closest('.slider-nav') && !e.target.closest('.slider-indicator')) {
                // Add visual feedback
                card.style.transform = 'translateY(-10px) scale(1.02)';
                setTimeout(() => {
                    window.location.href = link.getAttribute('href');
                }, 300);
            }
        }
    });
    
    // Hover effects untuk card berita biasa
    document.querySelectorAll('.slider-news-card:not(.lihat-lainnya-card)').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.zIndex = '15';
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
        
        // Adaptive card width based on screen size
        function updateCardWidth() {
            if (cards.length > 0) {
                const newCardWidth = cards[0].offsetWidth + 32;
                cardWidth = newCardWidth;
            }
        }
        
        window.addEventListener('resize', updateCardWidth);
    });

    window.addEventListener('scroll', handleNavbarToggle);
</script>
</body>
</html>