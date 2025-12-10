<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Profil Perusahaan - ElgroWacth Environmental Solutions</title>
    <style>
        /* PROFESSIONAL COMPANY PROFILE STYLES */
        :root {
            --primary-dark: #1a3c40;
            --primary: #2d5d5f;
            --primary-light: #4a8c8a;
            --accent: #ff914d;
            --light-bg: #f8f9fa;
            --white: #ffffff;
            --text-dark: #2c3e50;
            --text-light: #6c757d;
            --gradient-green: linear-gradient(135deg, #1a3c40 0%, #2d5d5f 100%);
            --gradient-accent: linear-gradient(135deg, #ff914d 0%, #ff6b35 100%);
            --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 16px 48px rgba(0, 0, 0, 0.15);
            --border-radius: 16px;
        }

        /* Company Profile Container */
        .company-profile {
            background: var(--white);
        }

        /* Hero Section */
        .company-hero {
            position: relative;
            background: linear-gradient(rgba(26, 60, 64, 0.85), rgba(26, 60, 64, 0.9)), 
                        url('/images/bg_b1a8a31387.webp');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 70vh;
            display: flex;
            align-items: center;
            color: var(--white);
            padding: 6rem 2rem;
            margin-bottom: 4rem;
        }

        .company-hero-content {
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        .company-hero .logo-display {
            width: 120px;
            height: 120px;
            background: var(--white);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-lg);
        }

        .company-hero .logo-display i {
            font-size: 3.5rem;
            color: var(--primary);
        }

        .company-hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            letter-spacing: -0.5px;
            line-height: 1.2;
        }

        .company-hero .tagline {
            font-size: 1.3rem;
            opacity: 0.9;
            margin-bottom: 3rem;
            max-width: 700px;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            margin-top: 3rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--border-radius);
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
        }

        .stat-number {
            font-size: 2.8rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #ffffff, #e0f7fa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stat-label {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            opacity: 0.8;
        }

        /* Modern Sections */
        .section-modern {
            max-width: 1200px;
            margin: 0 auto 5rem;
            padding: 0 2rem;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-title {
            font-size: 2.8rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--gradient-accent);
            border-radius: 2px;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: var(--text-light);
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* About Section */
        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .about-image {
            background: linear-gradient(135deg, var(--primary-light), var(--primary-dark));
            border-radius: var(--border-radius);
            height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .about-image:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('/images/bg_b1a8a31387.webp');
            background-size: cover;
            background-position: center;
            opacity: 0.3;
        }

        .about-image i {
            font-size: 8rem;
            color: rgba(255, 255, 255, 0.9);
            position: relative;
            z-index: 1;
        }

        .about-content h3 {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--primary-dark);
        }

        .about-content p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--text-dark);
            margin-bottom: 2rem;
        }

        /* Vision Mission Cards */
        .vm-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
            margin-top: 3rem;
        }

        .vm-card {
            background: var(--white);
            padding: 2.5rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-md);
            border-top: 4px solid var(--accent);
            transition: all 0.3s ease;
        }

        .vm-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }

        .vm-card i {
            font-size: 2.5rem;
            color: var(--accent);
            margin-bottom: 1.5rem;
        }

        .vm-card h4 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--primary-dark);
        }

        /* Services Section */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .service-card-modern {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 2.5rem;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .service-card-modern:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-light);
        }

        .service-icon-modern {
            width: 70px;
            height: 70px;
            background: var(--gradient-green);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
            color: var(--white);
        }

        .service-card-modern h4 {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--primary-dark);
        }

        /* Values Section */
        .values-section {
            background: var(--gradient-green);
            color: var(--white);
            padding: 5rem 2rem;
            border-radius: var(--border-radius);
            margin: 5rem auto;
            max-width: 1200px;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .value-card-modern {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--border-radius);
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .value-card-modern:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
        }

        .value-number {
            width: 50px;
            height: 50px;
            background: var(--accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-weight: 600;
            font-size: 1.2rem;
        }

        /* Team Section */
        .team-grid-modern {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .team-member-modern {
            background: var(--white);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
        }

        .team-member-modern:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }

        .member-header {
            height: 200px;
            background: var(--gradient-green);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .member-header:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('/images/bg_b1a8a31387.webp');
            background-size: cover;
            opacity: 0.1;
        }

        .member-header i {
            font-size: 4rem;
            color: var(--white);
            position: relative;
            z-index: 1;
        }

        .member-info {
            padding: 2rem;
        }

        .member-name {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--primary-dark);
        }

        .member-position {
            color: var(--accent);
            font-weight: 500;
            margin-bottom: 1rem;
        }

        /* Contact Section */
        .contact-section-modern {
            background: var(--light-bg);
            padding: 5rem 2rem;
            border-radius: var(--border-radius);
            margin: 5rem auto;
            max-width: 1200px;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
        }

        .contact-info-modern h3 {
            font-size: 2rem;
            margin-bottom: 2rem;
            color: var(--primary-dark);
        }

        .contact-item-modern {
            display: flex;
            align-items: flex-start;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .contact-icon-modern {
            width: 50px;
            height: 50px;
            background: var(--gradient-green);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 1.2rem;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .about-grid,
            .contact-grid {
                grid-template-columns: 1fr;
                gap: 3rem;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .vm-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .company-hero {
                min-height: 60vh;
                padding: 4rem 1.5rem;
            }
            
            .company-hero h1 {
                font-size: 2.5rem;
            }
            
            .section-title {
                font-size: 2.2rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .services-grid,
            .team-grid-modern,
            .values-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .company-hero h1 {
                font-size: 2rem;
            }
            
            .section-modern {
                padding: 0 1rem;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    @include('backend.bar.Navbar')

    <!-- Main Content -->
    <div class="content-container">
        <div class="content-box">
            <!-- UPDATE DILAKUKAN DIBAWAH SINI!!! -->
            <div class="company-profile">
                <!-- Hero Section with Background Image -->
                <section class="company-hero">
                    <div class="company-hero-content">
                        <div class="logo-display">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <h1>ElgroWacth Indonesia</h1>
                        <p class="tagline">
                            Memimpin transformasi digital dalam monitoring dan pelestarian lingkungan melalui teknologi inovatif dan kolaborasi strategis.
                        </p>
                        <div class="stats-grid">
                            <div class="stat-card">
                                <div class="stat-number" data-count="5247">0</div>
                                <div class="stat-label">Laporan Diverifikasi</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-number" data-count="89">0</div>
                                <div class="stat-label">Kota Terjangkau</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-number" data-count="98">0</div>
                                <div class="stat-label">% Kepuasan Pengguna</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-number" data-count="2018">0</div>
                                <div class="stat-label">Tahun Berdiri</div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- About Section -->
                <section class="section-modern">
                    <div class="section-header">
                        <h2 class="section-title">Tentang Kami</h2>
                        <p class="section-subtitle">
                            ElgroWacth merupakan solusi teknologi terdepan untuk monitoring dan pelaporan lingkungan di Indonesia.
                        </p>
                    </div>
                    <div class="about-grid">
                        <div class="about-image">
                            <i class="fas fa-seedling"></i>
                        </div>
                        <div class="about-content">
                            <h3>Inovasi untuk Lingkungan yang Lebih Baik</h3>
                            <p>Didirikan pada tahun 2018, ElgroWacth telah menjadi platform terpercaya yang menghubungkan masyarakat, pemerintah, dan pelaku usaha dalam upaya pelestarian lingkungan.</p>
                            <p>Dengan teknologi canggih dan pendekatan berbasis data, kami menyediakan sistem monitoring real-time yang memungkinkan deteksi dini dan penanganan cepat terhadap kerusakan lingkungan.</p>
                            <div class="vm-grid">
                                <div class="vm-card">
                                    <i class="fas fa-eye"></i>
                                    <h4>Visi</h4>
                                    <p>Menjadi platform digital terdepan dalam transformasi pengelolaan lingkungan berkelanjutan di Asia Tenggara.</p>
                                </div>
                                <div class="vm-card">
                                    <i class="fas fa-bullseye"></i>
                                    <h4>Misi</h4>
                                    <p>Menyediakan solusi teknologi inovatif yang memberdayakan semua stakeholder untuk menciptakan lingkungan yang sehat dan berkelanjutan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Services Section -->
                <section class="section-modern">
                    <div class="section-header">
                        <h2 class="section-title">Layanan Kami</h2>
                        <p class="section-subtitle">
                            Solusi komprehensif untuk semua kebutuhan monitoring dan pelaporan lingkungan.
                        </p>
                    </div>
                    <div class="services-grid">
                        <div class="service-card-modern">
                            <div class="service-icon-modern">
                                <i class="fas fa-satellite-dish"></i>
                            </div>
                            <h4>Monitoring Real-time</h4>
                            <p>Sistem pemantauan lingkungan 24/7 dengan teknologi IoT dan analisis data real-time.</p>
                        </div>
                        <div class="service-card-modern">
                            <div class="service-icon-modern">
                                <i class="fas fa-chart-network"></i>
                            </div>
                            <h4>Analisis Prediktif</h4>
                            <p>Analisis data berbasis AI untuk prediksi dan pencegahan kerusakan lingkungan.</p>
                        </div>
                        <div class="service-card-modern">
                            <div class="service-icon-modern">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <h4>Platform Pelaporan</h4>
                            <p>Sistem pelaporan terintegrasi dengan verifikasi multi-level dan tracking transparan.</p>
                        </div>
                        <div class="service-card-modern">
                            <div class="service-icon-modern">
                                <i class="fas fa-hands-helping"></i>
                            </div>
                            <h4>Konsultasi Strategis</h4>
                            <p>Konsultasi dan pendampingan untuk implementasi sistem pengelolaan lingkungan.</p>
                        </div>
                    </div>
                </section>

                <!-- Values Section -->
                <section class="values-section">
                    <div class="section-header">
                        <h2 class="section-title" style="color: white;">Nilai Perusahaan</h2>
                        <p class="section-subtitle" style="color: rgba(255,255,255,0.9);">
                            Prinsip yang mendasari setiap langkah dan keputusan kami.
                        </p>
                    </div>
                    <div class="values-grid">
                        <div class="value-card-modern">
                            <div class="value-number">01</div>
                            <h4>Integritas</h4>
                            <p>Transparansi dan akuntabilitas dalam setiap tindakan dan keputusan.</p>
                        </div>
                        <div class="value-card-modern">
                            <div class="value-number">02</div>
                            <h4>Inovasi</h4>
                            <p>Terus berinovasi untuk memberikan solusi teknologi terdepan.</p>
                        </div>
                        <div class="value-card-modern">
                            <div class="value-number">03</div>
                            <h4>Kolaborasi</h4>
                            <p>Bekerja sama dengan semua pihak untuk dampak yang lebih besar.</p>
                        </div>
                        <div class="value-card-modern">
                            <div class="value-number">04</div>
                            <h4>Keberlanjutan</h4>
                            <p>Fokus pada solusi jangka panjang yang berkelanjutan.</p>
                        </div>
                    </div>
                </section>

                <!-- Contact Section -->
                <section class="contact-section-modern">
                    <div class="section-header">
                        <h2 class="section-title">Hubungi Kami</h2>
                        <p class="section-subtitle">
                            Mari berkolaborasi untuk lingkungan yang lebih baik.
                        </p>
                    </div>
                    <div class="contact-grid">
                        <div class="contact-info-modern">
                            <h3>Informasi Kontak</h3>
                            <div class="contact-item-modern">
                                <div class="contact-icon-modern">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <h5>Alamat</h5>
                                    <p>GreenTech Tower, 12th Floor<br>Jl. Sudirman Kav. 52-53<br>Jakarta Selatan 12190</p>
                                </div>
                            </div>
                            <div class="contact-item-modern">
                                <div class="contact-icon-modern">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div>
                                    <h5>Telepon</h5>
                                    <p>+62 21 1234 5678<br>+62 811 2345 6789 (24/7 Hotline)</p>
                                </div>
                            </div>
                            <div class="contact-item-modern">
                                <div class="contact-icon-modern">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <h5>Email</h5>
                                    <p>info@ElgroWacth.id<br>partnership@ElgroWacth.id</p>
                                </div>
                            </div>
                        </div>
                        <div class="contact-form-modern">
                            <h3>Kirim Pesan</h3>
                            <form id="contactForm">
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Nama Lengkap" required>
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Email Perusahaan" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Perusahaan/Organisasi">
                                </div>
                                <div class="mb-3">
                                    <select class="form-select">
                                        <option selected>Tipe Kerjasama</option>
                                        <option>Partnership</option>
                                        <option>Consultation</option>
                                        <option>Technical Support</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" rows="4" placeholder="Pesan Anda" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100" style="background: var(--primary-dark); border: none; padding: 12px;">
                                    <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                                </button>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
            <!-- END UPDATE BAGIAN -->
        </div>
    </div>

    <!-- Footer -->
    @include('backend.bar.footer')

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animated counters
            const counters = document.querySelectorAll('.stat-number');
            
            counters.forEach(counter => {
                const updateCount = () => {
                    const target = parseInt(counter.getAttribute('data-count'));
                    const count = parseInt(counter.innerText);
                    const increment = target / 200;
                    
                    if (count < target) {
                        counter.innerText = Math.ceil(count + increment);
                        setTimeout(updateCount, 10);
                    } else {
                        counter.innerText = target;
                    }
                };
                
                // Start animation when element is in viewport
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            updateCount();
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.5 });
                
                observer.observe(counter);
            });

            // Form submission
            const contactForm = document.getElementById('contactForm');
            if (contactForm) {
                contactForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;
                    
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengirim...';
                    submitBtn.disabled = true;
                    
                    // Simulate API call
                    setTimeout(() => {
                        submitBtn.innerHTML = '<i class="fas fa-check me-2"></i>Terkirim!';
                        submitBtn.classList.remove('btn-primary');
                        submitBtn.classList.add('btn-success');
                        
                        // Reset after 2 seconds
                        setTimeout(() => {
                            contactForm.reset();
                            submitBtn.innerHTML = originalText;
                            submitBtn.disabled = false;
                            submitBtn.classList.remove('btn-success');
                            submitBtn.classList.add('btn-primary');
                        }, 2000);
                    }, 1500);
                });
            }

            // Hover animations for cards
            const cards = document.querySelectorAll('.service-card-modern, .vm-card, .team-member-modern');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transition = 'all 0.3s ease';
                });
            });

            // Parallax effect for hero section
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const hero = document.querySelector('.company-hero');
                if (hero) {
                    hero.style.backgroundPosition = `center ${scrolled * 0.5}px`;
                }
            });

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 100,
                            behavior: 'smooth'
                        });
                    }
                });
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