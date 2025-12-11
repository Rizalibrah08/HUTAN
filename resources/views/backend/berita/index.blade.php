<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Berita Lingkungan - Hutan</title>
    <style>
        /* BERITA PAGE STYLES */
        .berita-container {
            max-width: 1400px;
            margin: 3rem auto;
            padding: 0 2rem;
        }

        /* Header dengan tombol tambah berita */
        .berita-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid rgba(164, 190, 123, 0.2);
        }

        .berita-header h1 {
            font-size: 2rem;
            color: var(--dark-green);
            font-weight: 700;
            margin: 0;
        }

        /* Tombol Tambah Berita untuk Admin */
        .btn-tambah-berita {
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.8rem 1.5rem;
            background: linear-gradient(135deg, var(--green) 0%, var(--dark-green) 100%);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(95, 141, 78, 0.3);
        }

        .btn-tambah-berita:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(95, 141, 78, 0.4);
            background: linear-gradient(135deg, var(--dark-green) 0%, var(--green) 100%);
        }

        .btn-tambah-berita i {
            font-size: 1.1rem;
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

        /* Statistik info */
        .statistik-info {
            padding: 1rem 0;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.8rem 0;
            color: var(--dark-green);
        }

        .stat-item i {
            color: var(--green);
            font-size: 1.2rem;
            width: 24px;
        }

        /* Content Area - 75% */
        .berita-content {
            flex: 1;
        }

        /* No berita message */
        .no-berita {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }
        
        .no-berita-icon {
            font-size: 4rem;
            color: var(--sage);
            margin-bottom: 1.5rem;
        }
        
        .no-berita h3 {
            color: var(--dark-green);
            margin-bottom: 1rem;
        }
        
        .no-berita p {
            color: #666;
            margin-bottom: 2rem;
            font-size: 1.1rem;
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
            position: relative;
        }

        .article-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 35px rgba(95, 141, 78, 0.15);
        }

        /* Overlay action untuk admin */
        .article-actions {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            gap: 0.5rem;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 2;
        }

        .article-card:hover .article-actions {
            opacity: 1;
        }

        .action-btn {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
            color: var(--dark-green);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
            text-decoration: none;
        }

        .action-btn.edit:hover {
            background: var(--green);
            color: white;
        }

        .action-btn.delete:hover {
            background: #dc3545;
            color: white;
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

        .article-title a {
            color: inherit;
            text-decoration: none;
        }

        .article-title a:hover {
            color: var(--green);
        }

        .article-excerpt {
            font-size: 0.95rem;
            color: #666;
            line-height: 1.6;
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            min-height: 4.5em;
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
            
            .berita-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
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

                <div class="berita-container">
                    <!-- Header dengan tombol tambah berita untuk admin -->
                    <div class="berita-header">
                        <h1>Berita Terkini</h1>
                        
                        <!-- Tombol hanya muncul jika admin sudah login -->
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('berita.create') }}" class="btn-tambah-berita">
                                    <i class="fas fa-plus"></i>
                                    Tambah Berita
                                </a>
                            @endif
                        @endauth
                    </div>

                    <div class="berita-layout">
                        <!-- Sidebar - 25% -->
                        <aside class="berita-sidebar">
                            <div class="sidebar-card">
                                <h3 class="sidebar-title">Kategori</h3>
                                <ul class="sidebar-menu">
                                    <li><a href="{{ route('berita.index') }}" class="{{ !request('kategori') ? 'active' : '' }}">Semua Kategori</a></li>
                                    <li><a href="?kategori=Perubahan Iklim" class="{{ request('kategori') == 'Perubahan Iklim' ? 'active' : '' }}">Perubahan Iklim</a></li>
                                    <li><a href="?kategori=Konservasi" class="{{ request('kategori') == 'Konservasi' ? 'active' : '' }}">Konservasi</a></li>
                                    <li><a href="?kategori=Polusi" class="{{ request('kategori') == 'Polusi' ? 'active' : '' }}">Polusi</a></li>
                                    <li><a href="?kategori=Regulasi" class="{{ request('kategori') == 'Regulasi' ? 'active' : '' }}">Regulasi</a></li>
                                    <li><a href="?kategori=Teknologi Hijau" class="{{ request('kategori') == 'Teknologi Hijau' ? 'active' : '' }}">Teknologi Hijau</a></li>
                                    <li><a href="?kategori=Keanekaragaman Hayati" class="{{ request('kategori') == 'Keanekaragaman Hayati' ? 'active' : '' }}">Keanekaragaman Hayati</a></li>
                                </ul>
                            </div>
                            
                            <div class="sidebar-card">
                                <h3 class="sidebar-title">Statistik</h3>
                                <div class="statistik-info">
                                    <div class="stat-item">
                                        <i class="fas fa-newspaper"></i>
                                        <span>Total Berita: {{ $berita->total() }}</span>
                                    </div>
                                    <div class="stat-item">
                                        <i class="fas fa-eye"></i>
                                        <span>Total Dilihat: {{ number_format($totalViews ?? 0) }}</span>
                                    </div>
                                </div>
                            </div>
                        </aside>

                        <!-- Content Area - 75% -->
                        <main class="berita-content">
                            @if($berita->count() > 0)
                                <!-- Grid Articles - 3 columns -->
                                <div class="articles-grid">
                                    @foreach($berita as $item)
                                    <article class="article-card">
                                        <!-- Tombol edit/hapus hanya untuk admin -->
                                        @auth
                                            @if(auth()->user()->role === 'admin')
                                                <div class="article-actions">
                                                    <a href="{{ route('berita.edit', $item->id) }}" class="action-btn edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button class="action-btn delete" onclick="hapusBerita({{ $item->id }})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            @endif
                                        @endauth
                                        
                                        <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                                             alt="{{ $item->judul }}" 
                                             class="article-image">
                                        <div class="article-body">
                                            <span class="article-category">{{ $item->kategori }}</span>
                                            <h3 class="article-title">
                                                <a href="{{ route('berita.show', $item->id) }}">
                                                    {{ $item->judul }}
                                                </a>
                                            </h3>
                                            <p class="article-excerpt">{{ $item->excerpt }}</p>
                                            <div class="article-footer">
                                                <span class="article-date">
                                                    <i class="far fa-calendar"></i>
                                                    {{ $item->created_at->format('d M Y') }}
                                                </span>
                                                <span class="article-views">
                                                    <i class="far fa-eye"></i>
                                                    {{ number_format($item->views) }}
                                                </span>
                                            </div>
                                        </div>
                                    </article>
                                    @endforeach
                                </div>

                                <!-- Pagination -->
                                @if($berita->hasPages())
                                <div class="berita-pagination">
                                    @if($berita->onFirstPage())
                                        <span class="pagination-prev disabled">
                                            <i class="fas fa-chevron-left"></i>
                                            Sebelumnya
                                        </span>
                                    @else
                                        <a href="{{ $berita->previousPageUrl() }}" class="pagination-prev">
                                            <i class="fas fa-chevron-left"></i>
                                            Sebelumnya
                                        </a>
                                    @endif
                                    
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination-nav">
                                            @for($page = 1; $page <= $berita->lastPage(); $page++)
                                                <li class="page-item {{ $berita->currentPage() == $page ? 'active' : '' }}">
                                                    <a class="page-link" href="{{ $berita->url($page) }}">{{ $page }}</a>
                                                </li>
                                            @endfor
                                        </ul>
                                    </nav>
                                    
                                    @if($berita->hasMorePages())
                                        <a href="{{ $berita->nextPageUrl() }}" class="pagination-next">
                                            Berikutnya
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    @else
                                        <span class="pagination-next disabled">
                                            Berikutnya
                                            <i class="fas fa-chevron-right"></i>
                                        </span>
                                    @endif
                                </div>
                                @endif
                            @else
                                <!-- Jika tidak ada berita -->
                                <div class="no-berita">
                                    <div class="no-berita-icon">
                                        <i class="fas fa-newspaper"></i>
                                    </div>
                                    <h3>Belum Ada Berita</h3>
                                    <p>Belum ada berita yang dipublikasikan.</p>
                                    @auth
                                        @if(auth()->user()->role === 'admin')
                                            <a href="{{ route('berita.create') }}" class="btn-tambah-berita">
                                                <i class="fas fa-plus"></i>
                                                Tambah Berita Pertama
                                            </a>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                        </main>
                    </div>
                </div>
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

        // Hapus berita dengan konfirmasi
        function hapusBerita(id) {
            if (confirm('Apakah Anda yakin ingin menghapus berita ini?')) {
                fetch('/admin/berita/' + id, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        alert('Berita berhasil dihapus!');
                        window.location.reload();
                    } else {
                        alert('Gagal menghapus berita.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan.');
                });
            }
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            handleNavbarToggle();
            
            // Sidebar menu active state
            document.querySelectorAll('.sidebar-menu a').forEach(link => {
                link.addEventListener('click', function(e) {
                    document.querySelectorAll('.sidebar-menu a').forEach(item => {
                        item.classList.remove('active');
                    });
                    this.classList.add('active');
                });
            });
            
            // Hover effect artikel
            document.querySelectorAll('.article-card').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });

        window.addEventListener('scroll', handleNavbarToggle);
    </script>
</body>
</html>