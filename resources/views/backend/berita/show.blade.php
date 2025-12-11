<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>{{ $berita->judul }} - Berita Lingkungan</title>
    <style>
        /* DETAIL BERITA PAGE STYLES */
        .detail-container {
            max-width: 1200px;
            margin: 3rem auto;
            padding: 0 2rem;
        }

        /* Breadcrumb */
        .breadcrumb {
            background: rgba(164, 190, 123, 0.1);
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
        }

        .breadcrumb a {
            color: var(--green);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .breadcrumb a:hover {
            color: var(--dark-green);
            text-decoration: underline;
        }

        .breadcrumb i {
            margin: 0 0.8rem;
            color: var(--sage);
        }

        /* Article Header */
        .article-header {
            margin-bottom: 2.5rem;
            text-align: center;
        }

        .article-meta {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1.5rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #666;
            font-size: 0.95rem;
        }

        .meta-item i {
            color: var(--green);
        }

        .article-category {
            display: inline-block;
            background: var(--sage);
            color: white;
            padding: 0.5rem 1.2rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .article-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--dark-green);
            line-height: 1.3;
            margin-bottom: 1.5rem;
        }

        .article-excerpt {
            font-size: 1.1rem;
            color: #666;
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto 2rem;
        }

        /* Article Image */
        .article-featured-image {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            border-radius: 16px;
            margin-bottom: 2.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        /* Article Content */
        .article-content-wrapper {
            display: flex;
            gap: 3rem;
            margin-top: 3rem;
        }

        .article-content {
            flex: 1;
            min-width: 0;
        }

        .article-sidebar {
            flex: 0 0 300px;
        }

        /* Content Styles */
        .article-body {
            background: white;
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(229, 217, 182, 0.3);
            line-height: 1.8;
            color: #444;
        }

        .article-body h2 {
            font-size: 1.6rem;
            color: var(--dark-green);
            margin: 2rem 0 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid rgba(164, 190, 123, 0.3);
        }

        .article-body h3 {
            font-size: 1.3rem;
            color: var(--green);
            margin: 1.5rem 0 1rem;
        }

        .article-body p {
            margin-bottom: 1.5rem;
            font-size: 1.05rem;
        }

        .article-body ul, .article-body ol {
            margin-bottom: 1.5rem;
            padding-left: 1.5rem;
        }

        .article-body li {
            margin-bottom: 0.5rem;
        }

        .article-body blockquote {
            border-left: 4px solid var(--sage);
            padding-left: 1.5rem;
            margin: 2rem 0;
            font-style: italic;
            color: #666;
            background: rgba(164, 190, 123, 0.05);
            padding: 1.5rem;
            border-radius: 8px;
        }

        .article-body img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin: 1.5rem 0;
        }

        /* Sidebar */
        .sidebar-card {
            background: white;
            border-radius: 16px;
            padding: 1.8rem;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
            border: 1px solid rgba(229, 217, 182, 0.3);
        }

        .sidebar-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark-green);
            margin-bottom: 1.2rem;
            padding-bottom: 0.8rem;
            border-bottom: 2px solid var(--sage);
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .sidebar-title i {
            color: var(--green);
        }

        /* Author Info */
        .author-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 0;
        }

        .author-avatar {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--cream), var(--sage));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--dark-green);
        }

        .author-details h4 {
            margin: 0 0 0.3rem;
            color: var(--dark-green);
            font-size: 1.1rem;
        }

        .author-details p {
            margin: 0;
            color: #666;
            font-size: 0.9rem;
        }

        /* Related Articles */
        .related-article {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
        }

        .related-article:last-child {
            border-bottom: none;
        }

        .related-article:hover {
            background: rgba(164, 190, 123, 0.05);
            border-radius: 8px;
            padding: 1rem;
            margin: 0 -1rem;
        }

        .related-image {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }

        .related-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--dark-green);
            line-height: 1.4;
            margin: 0;
        }

        /* Article Stats */
        .article-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem;
            background: rgba(164, 190, 123, 0.05);
            border-radius: 12px;
            margin-top: 2rem;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            display: block;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark-green);
        }

        .stat-label {
            font-size: 0.85rem;
            color: #666;
        }

        /* Share Buttons */
        .share-buttons {
            display: flex;
            gap: 0.8rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .share-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .share-facebook {
            background: #1877F2;
            color: white;
        }

        .share-twitter {
            background: #1DA1F2;
            color: white;
        }

        .share-whatsapp {
            background: #25D366;
            color: white;
        }

        .share-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            text-decoration: none;
            font-size: 0.95rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--green) 0%, var(--dark-green) 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(95, 141, 78, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(95, 141, 78, 0.4);
            background: linear-gradient(135deg, var(--dark-green) 0%, var(--green) 100%);
        }

        .btn-secondary {
            background: white;
            color: var(--dark-green);
            border: 2px solid rgba(164, 190, 123, 0.3);
        }

        .btn-secondary:hover {
            background: rgba(164, 190, 123, 0.1);
            border-color: var(--sage);
            transform: translateY(-3px);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .article-content-wrapper {
                flex-direction: column;
            }
            
            .article-sidebar {
                flex: none;
                width: 100%;
            }
            
            .article-title {
                font-size: 1.8rem;
            }
        }

        @media (max-width: 768px) {
            .detail-container {
                padding: 0 1.5rem;
            }
            
            .article-header {
                text-align: left;
            }
            
            .article-meta {
                justify-content: flex-start;
            }
            
            .article-body {
                padding: 1.8rem;
            }
            
            .article-title {
                font-size: 1.6rem;
            }
        }

        @media (max-width: 480px) {
            .detail-container {
                padding: 0 1rem;
            }
            
            .article-body {
                padding: 1.5rem;
            }
            
            .article-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.8rem;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }

        /* Additional */
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
                    <h2>DETAIL BERITA</h2>
                </div>

                <div class="detail-container">
                    <!-- Breadcrumb -->
                    <div class="breadcrumb">
                        <a href="{{ route('berita.index') }}"><i class="fas fa-home"></i> Beranda</a>
                        <i class="fas fa-chevron-right"></i>
                        <a href="{{ route('berita.index') }}">Berita</a>
                        <i class="fas fa-chevron-right"></i>
                        <span>{{ $berita->kategori }}</span>
                        <i class="fas fa-chevron-right"></i>
                        <span>{{ $berita->judul }}</span>
                    </div>

                    <!-- Article Header -->
                    <div class="article-header">
                        <div class="article-meta">
                            <span class="meta-item">
                                <i class="far fa-calendar"></i>
                                {{ $berita->created_at->translatedFormat('d F Y') }}
                            </span>
                            <span class="meta-item">
                                <i class="far fa-clock"></i>
                                {{ $berita->created_at->format('H:i') }} WIB
                            </span>
                            <span class="meta-item">
                                <i class="far fa-eye"></i>
                                {{ number_format($berita->views) }} dilihat
                            </span>
                            <span class="meta-item">
                                <i class="fas fa-user-edit"></i>
                                {{ $berita->user->name ?? 'Admin' }}
                            </span>
                        </div>

                        <span class="article-category">{{ $berita->kategori }}</span>
                        <h1 class="article-title">{{ $berita->judul }}</h1>
                        <p class="article-excerpt">{{ $berita->excerpt }}</p>
                    </div>

                    <!-- Featured Image -->
                    <img src="{{ Storage::url($berita->gambar) }}" 
                         alt="{{ $berita->judul }}" 
                         class="article-featured-image"
                         onerror="this.src='https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80'">

                    <!-- Content Wrapper -->
                    <div class="article-content-wrapper">
                        <!-- Main Content -->
                        <div class="article-content">
                            <!-- Article Body -->
                            <div class="article-body">
                                {!! $berita->konten !!}
                            </div>

                            <!-- Article Stats -->
                            <div class="article-stats">
                                <div class="stat-item">
                                    <span class="stat-number">{{ number_format($berita->views) }}</span>
                                    <span class="stat-label">Dilihat</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-number">{{ $berita->created_at->format('d/m/Y') }}</span>
                                    <span class="stat-label">Dipublikasi</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-number">{{ $berita->kategori }}</span>
                                    <span class="stat-label">Kategori</span>
                                </div>
                            </div>

                            <!-- Share Buttons -->
                            <div class="share-buttons">
                                <span style="color: var(--dark-green); font-weight: 600; margin-right: 1rem;">Bagikan:</span>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" 
                                   target="_blank" 
                                   class="share-btn share-facebook">
                                    <i class="fab fa-facebook-f"></i> Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ urlencode($berita->judul) }}" 
                                   target="_blank" 
                                   class="share-btn share-twitter">
                                    <i class="fab fa-twitter"></i> Twitter
                                </a>
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' ' . url()->current()) }}" 
                                   target="_blank" 
                                   class="share-btn share-whatsapp">
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </a>
                            </div>

                            <!-- Action Buttons -->
                            <div class="action-buttons">
                                <a href="{{ route('berita.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali ke Berita
                                </a>
                                
                                @auth
                                    @if(auth()->user()->role === 'admin')
                                        <a href="{{ route('berita.edit', $berita->id) }}" class="btn btn-primary">
                                            <i class="fas fa-edit"></i> Edit Berita
                                        </a>
                                    @endif
                                @endauth
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <aside class="article-sidebar">
                            <!-- Author Info -->
                            <div class="sidebar-card">
                                <h3 class="sidebar-title">
                                    <i class="fas fa-user-edit"></i> Penulis
                                </h3>
                                <div class="author-info">
                                    <div class="author-avatar">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="author-details">
                                        <h4>{{ $berita->user->name ?? 'Administrator' }}</h4>
                                        <p>Reporter Lingkungan</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Related Articles -->
                            <div class="sidebar-card">
                                <h3 class="sidebar-title">
                                    <i class="fas fa-newspaper"></i> Berita Terkait
                                </h3>
                                @php
                                    $relatedBerita = App\Models\Berita::where('kategori', $berita->kategori)
                                        ->where('id', '!=', $berita->id)
                                        ->latest()
                                        ->take(3)
                                        ->get();
                                @endphp
                                
                                @if($relatedBerita->count() > 0)
                                    @foreach($relatedBerita as $related)
                                        <a href="{{ route('berita.show', $related->id) }}" class="related-article">
                                            <img src="{{ Storage::url($related->gambar) }}" 
                                                 alt="{{ $related->judul }}" 
                                                 class="related-image"
                                                 onerror="this.src='https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80'">
                                            <div>
                                                <h4 class="related-title">{{ $related->judul }}</h4>
                                                <small style="color: #666;">{{ $related->created_at->format('d M Y') }}</small>
                                            </div>
                                        </a>
                                    @endforeach
                                @else
                                    <p style="color: #666; font-style: italic; text-align: center; padding: 1rem 0;">
                                        Belum ada berita terkait
                                    </p>
                                @endif
                            </div>

                            <!-- Category Info -->
                            <div class="sidebar-card">
                                <h3 class="sidebar-title">
                                    <i class="fas fa-folder"></i> Kategori
                                </h3>
                                <div style="padding: 0.5rem 0;">
                                    <a href="{{ route('berita.index') }}?kategori={{ $berita->kategori }}" 
                                       style="display: block; padding: 0.8rem; background: rgba(164, 190, 123, 0.1); border-radius: 8px; color: var(--dark-green); text-decoration: none; font-weight: 500; margin-bottom: 0.5rem;">
                                        <i class="fas fa-tag"></i> {{ $berita->kategori }}
                                    </a>
                                    <p style="color: #666; font-size: 0.9rem; margin-top: 1rem;">
                                        Kategori ini berisi berita-berita tentang {{ strtolower($berita->kategori) }}.
                                    </p>
                                </div>
                            </div>
                        </aside>
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

        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            handleNavbarToggle();
            
            // Format konten HTML jika perlu
            const articleBody = document.querySelector('.article-body');
            if (articleBody) {
                // Pastikan gambar responsif
                articleBody.querySelectorAll('img').forEach(img => {
                    img.style.maxWidth = '100%';
                    img.style.height = 'auto';
                    img.style.borderRadius = '8px';
                    img.style.margin = '1rem 0';
                });
                
                // Tambahkan styling untuk tabel jika ada
                articleBody.querySelectorAll('table').forEach(table => {
                    table.style.width = '100%';
                    table.style.borderCollapse = 'collapse';
                    table.style.margin = '1rem 0';
                });
                
                articleBody.querySelectorAll('td, th').forEach(cell => {
                    cell.style.border = '1px solid #ddd';
                    cell.style.padding = '8px';
                });
            }
        });

        window.addEventListener('scroll', handleNavbarToggle);

        // Copy URL to clipboard
        function copyToClipboard() {
            const url = window.location.href;
            navigator.clipboard.writeText(url).then(() => {
                alert('URL berita berhasil disalin!');
            });
        }
    </script>
</body>
</html>