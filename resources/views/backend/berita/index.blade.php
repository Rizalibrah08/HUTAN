<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>@yield('title', 'Dashboard') - Hutan</title>
    <style>
        /* BERITA PAGE STYLES */
        .berita-container {
            max-width: 1400px;
            margin: 3rem auto;
            padding: 0 2rem;
        }

        /* Two Column Layout */
        .berita-layout {
            display: flex;
            gap: 3rem;
            margin-top: 3rem;
        }

        /* Sidebar - 25% */
        .berita-sidebar {
            flex: 0 0 25%;
            min-width: 300px;
        }

        .sidebar-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
            border: 1px solid rgba(229, 217, 182, 0.3);
        }

        .sidebar-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--dark-green);
            margin-bottom: 1.5rem;
            padding-bottom: 0.8rem;
            border-bottom: 2px solid var(--sage);
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            margin-bottom: 1rem;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-decoration: none;
            color: var(--dark-green);
            padding: 0.8rem 1rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            background: rgba(164, 190, 123, 0.05);
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: var(--sage);
            color: white;
            transform: translateX(5px);
        }

        .sidebar-menu i {
            font-size: 0.9rem;
        }

        /* Content Area - 75% */
        .berita-content {
            flex: 1;
        }

        /* Grid Articles - 3 columns */
        .articles-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-bottom: 3rem;
        }

        /* Article Card */
        .article-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .article-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 35px rgba(95, 141, 78, 0.15);
        }

        .article-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }

        .article-body {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .article-category {
            display: inline-block;
            background: var(--sage);
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
            align-self: flex-start;
        }

        .article-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-green);
            margin-bottom: 1rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            min-height: 4.2em;
        }

        .article-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            margin-top: auto;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            font-size: 0.85rem;
            color: #666;
        }

        .article-date {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .article-date i {
            color: var(--green);
        }

        .article-views {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .article-views i {
            color: var(--green);
        }

        /* Pagination */
        .berita-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            margin-top: 3rem;
        }

        .pagination-nav {
            display: flex;
            gap: 0.5rem;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .page-item {
            margin: 0 0.2rem;
        }

        .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border: 1px solid rgba(164, 190, 123, 0.3);
            border-radius: 10px;
            background: white;
            color: var(--dark-green);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .page-link:hover {
            background: rgba(164, 190, 123, 0.1);
            border-color: var(--sage);
        }

        .page-item.active .page-link {
            background: var(--green);
            color: white;
            border-color: var(--green);
        }

        .page-item.disabled .page-link {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .pagination-prev,
        .pagination-next {
            padding: 0.8rem 1.5rem;
            background: white;
            border: 1px solid rgba(164, 190, 123, 0.3);
            border-radius: 10px;
            color: var(--dark-green);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pagination-prev:hover,
        .pagination-next:hover {
            background: rgba(164, 190, 123, 0.1);
            border-color: var(--sage);
        }

        .pagination-prev.disabled,
        .pagination-next.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .articles-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }
        }

        @media (max-width: 992px) {
            .berita-layout {
                flex-direction: column;
                gap: 2rem;
            }
            
            .berita-sidebar {
                flex: none;
                width: 100%;
                min-width: auto;
            }
            
            .berita-content {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .berita-container {
                padding: 0 1.5rem;
            }
            
            .articles-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            
            .article-image {
                height: 180px;
            }
        }

        @media (max-width: 480px) {
            .berita-container {
                padding: 0 1rem;
            }
            
            .sidebar-card {
                padding: 1.5rem;
            }
            
            .article-body {
                padding: 1.2rem;
            }
            
            .pagination-prev,
            .pagination-next {
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
            }
            
            .page-link {
                width: 35px;
                height: 35px;
                font-size: 0.9rem;
            }
        }

        /* Additional Styles */
        .news-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .gambar h2 {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    @include('backend.bar.Navbar')

    <!-- Main Content -->
    <div class="content-container">
        <div class="content-box">
            <div>
                <div class="gambar">
                    <h2>BERITA</h2>
                </div>

                <!-- UPDATE CODE DIBAWAH INI -->
                <div class="berita-container">
                    <div class="berita-layout">
                        <!-- Sidebar - 25% -->
                        <aside class="berita-sidebar">
                            <div class="sidebar-card">
                                <h3 class="sidebar-title">Kategori</h3>
                                <ul class="sidebar-menu">
                                    <li><a href="#" class="active">Semua Kategori</a></li>
                                    <li><a href="#">Perubahan Iklim</a></li>
                                    <li><a href="#">Konservasi</a></li>
                                    <li><a href="#">Polusi</a></li>
                                    <li><a href="#">Regulasi</a></li>
                                    <li><a href="#">Teknologi Hijau</a></li>
                                    <li><a href="#">Keanekaragaman Hayati</a></li>
                                </ul>
                            </div>
                            
                            <div class="sidebar-card">
                                <h3 class="sidebar-title">Menu</h3>
                                <ul class="sidebar-menu">
                                    <li><a href="#" class="active">
                                        <span>Artikel Terbaru</span>
                                        <i class="fas fa-chevron-right"></i>
                                    </a></li>
                                    <li><a href="#">
                                        <span>Paling Banyak Dilihat</span>
                                        <i class="fas fa-chevron-right"></i>
                                    </a></li>
                                    <li><a href="#">
                                        <span>Artikel Terpopuler</span>
                                        <i class="fas fa-chevron-right"></i>
                                    </a></li>
                                    <li><a href="#">
                                        <span>Editor's Pick</span>
                                        <i class="fas fa-chevron-right"></i>
                                    </a></li>
                                </ul>
                            </div>
                        </aside>

                        <!-- Content Area - 75% -->
                        <main class="berita-content">
                            <!-- Grid Articles - 3 columns -->
                            <div class="articles-grid">
                                <!-- Article 1 -->
                                <article class="article-card">
                                    <img src="https://images.unsplash.com/photo-1611273426858-450d8e3c9fce?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Forest Conservation" class="article-image">
                                    <div class="article-body">
                                        <span class="article-category">Konservasi</span>
                                        <h3 class="article-title">Program Reforestasi Berhasil Tanam 1 Juta Pohon di Kalimantan</h3>
                                        <div class="article-footer">
                                            <span class="article-date">
                                                <i class="far fa-calendar"></i>
                                                15 Jan 2024
                                            </span>
                                            <span class="article-views">
                                                <i class="far fa-eye"></i>
                                                2.4K
                                            </span>
                                        </div>
                                    </div>
                                </article>

                                <!-- Article 2 -->
                                <article class="article-card">
                                    <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Climate Change" class="article-image">
                                    <div class="article-body">
                                        <span class="article-category">Perubahan Iklim</span>
                                        <h3 class="article-title">Riset Terbaru: Dampak Perubahan Iklim Terhadap Ekosistem Pesisir Indonesia</h3>
                                        <div class="article-footer">
                                            <span class="article-date">
                                                <i class="far fa-calendar"></i>
                                                12 Jan 2024
                                            </span>
                                            <span class="article-views">
                                                <i class="far fa-eye"></i>
                                                3.1K
                                            </span>
                                        </div>
                                    </div>
                                </article>

                                <!-- Article 3 -->
                                <article class="article-card">
                                    <img src="https://images.unsplash.com/photo-1589652043056-ba1a2c4830a5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Pollution" class="article-image">
                                    <div class="article-body">
                                        <span class="article-category">Polusi</span>
                                        <h3 class="article-title">Inovasi Teknologi Pengolahan Sampah Plastik di Kota Metropolitan</h3>
                                        <div class="article-footer">
                                            <span class="article-date">
                                                <i class="far fa-calendar"></i>
                                                10 Jan 2024
                                            </span>
                                            <span class="article-views">
                                                <i class="far fa-eye"></i>
                                                1.8K
                                            </span>
                                        </div>
                                    </div>
                                </article>

                                <!-- Article 4 -->
                                <article class="article-card">
                                    <img src="https://images.unsplash.com/photo-1532094349884-543bc11b234d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Green Technology" class="article-image">
                                    <div class="article-body">
                                        <span class="article-category">Teknologi Hijau</span>
                                        <h3 class="article-title">Startup Lokal Kembangkan Teknologi Drone untuk Pemantauan Hutan</h3>
                                        <div class="article-footer">
                                            <span class="article-date">
                                                <i class="far fa-calendar"></i>
                                                8 Jan 2024
                                            </span>
                                            <span class="article-views">
                                                <i class="far fa-eye"></i>
                                                2.7K
                                            </span>
                                        </div>
                                    </div>
                                </article>

                                <!-- Article 5 -->
                                <article class="article-card">
                                    <img src="https://images.unsplash.com/photo-1418065460487-3e41a6c84dc5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Biodiversity" class="article-image">
                                    <div class="article-body">
                                        <span class="article-category">Keanekaragaman Hayati</span>
                                        <h3 class="article-title">Penemuan Spesies Baru di Hutan Papua: Harapan untuk Konservasi</h3>
                                        <div class="article-footer">
                                            <span class="article-date">
                                                <i class="far fa-calendar"></i>
                                                5 Jan 2024
                                            </span>
                                            <span class="article-views">
                                                <i class="far fa-eye"></i>
                                                4.2K
                                            </span>
                                        </div>
                                    </div>
                                </article>

                                <!-- Article 6 -->
                                <article class="article-card">
                                    <img src="https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Regulation" class="article-image">
                                    <div class="article-body">
                                        <span class="article-category">Regulasi</span>
                                        <h3 class="article-title">Pemerintah Terbitkan Regulasi Baru untuk Pengelolaan Limbah B3</h3>
                                        <div class="article-footer">
                                            <span class="article-date">
                                                <i class="far fa-calendar"></i>
                                                3 Jan 2024
                                            </span>
                                            <span class="article-views">
                                                <i class="far fa-eye"></i>
                                                3.5K
                                            </span>
                                        </div>
                                    </div>
                                </article>
                            </div>

                            <!-- Pagination -->
                            <div class="berita-pagination">
                                <a href="#" class="pagination-prev">
                                    <i class="fas fa-chevron-left"></i>
                                    Sebelumnya
                                </a>
                                
                                <nav aria-label="Page navigation">
                                    <ul class="pagination-nav">
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                                    </ul>
                                </nav>
                                
                                <a href="#" class="pagination-next">
                                    Berikutnya
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </main>
                    </div>
                </div>
                <!-- END UPDATE CODE -->
                
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('backend.bar.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
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
            
            // Add active class to sidebar menu items on click
            document.querySelectorAll('.sidebar-menu a').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.querySelectorAll('.sidebar-menu a').forEach(item => {
                        item.classList.remove('active');
                    });
                    this.classList.add('active');
                });
            });
            
            // Add hover effect to article cards
            document.querySelectorAll('.article-card').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });

        window.addEventListener('scroll', () => {
            handleNavbarToggle();
        });
    </script>
</body>
</html>