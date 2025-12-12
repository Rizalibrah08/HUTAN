<div class="nav-container nav-transparent">
    <div class="nav">
        <div class="col1">
            <a href="/">
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Crect width='100' height='100' rx='10' fill='%23285430'/%3E%3Ctext x='50%25' y='50%25' font-size='35' font-weight='bold' text-anchor='middle' dy='.3em' fill='white' font-family='Arial'%3EL%3C/text%3E%3C/svg%3E" alt="Logo">
            </a>
            <a href="/dashboard">Beranda</a>
            <a href="/profile">Profile</a>
            <a href="/berita">Berita</a>
            <a href="/lapor">Laporpak</a>
        </div>
        <div class="col2">
            <!-- Search Form -->
            <form action="{{ route('berita.search') }}" method="GET" class="search-form" id="searchForm">
                <div class="search">
                    <input type="text" 
                           name="q" 
                           id="searchInput"
                           placeholder="Cari berita..." 
                           value="{{ request('q') }}"
                           autocomplete="off">
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <!-- Search Results Dropdown -->
                <div class="search-results" id="searchResults"></div>
            </form>
            
            @auth
                <div class="profile-dropdown">
                    <button class="profile-btn" onclick="toggleDropdown()">
                        <i class="fas fa-user-circle"></i>
                    </button>
                    <div class="dropdown-menu" id="profileMenu">
                        <div class="user-info">
                            <div class="user-name">{{ auth()->user()->name }}</div>
                            <div class="user-role">
                                @if(auth()->user()->role === 'admin')
                                    <i class="fas fa-shield-alt me-1"></i> Administrator
                                @else
                                    <i class="fas fa-user me-1"></i> Pengguna
                                @endif
                            </div>
                        </div>
                        
                        @if(auth()->user()->role === 'admin')
                            <a href="/admin/berita"><i class="fas fa-newspaper"></i> Kelola Berita</a>
                            <a href="/admin/laporan"><i class="fas fa-file-alt"></i> Kelola Laporan</a>
                            <div class="dropdown-divider"></div>
                        @endif
                        
                        <form action="/logout" method="POST" class="logout-form">
                            @csrf
                            <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
                        </form>
                    </div>
                </div>
            @else
                {{-- <div class="login">
                    <a href="/login">Login</a>
                </div> --}}
            @endauth
        </div>
    </div>
</div>

<style>
    /* SEARCH STYLES */
    .search-form {
        position: relative;
        width: 500px;
    }

    .search {
        position: relative;
        display: flex;
        align-items: center;
    }

    .search input {
        width: 100%;
        padding: 0.8rem 3rem 0.8rem 1.2rem;
        border: 2px solid var(--sage);
        border-radius: 35px;
        background-color: rgba(255, 255, 255, 0.9);
        font-size: 1rem;
        transition: all 0.3s ease;
        color: var(--dark-green);
        font-weight: 500;
    }

    .search input:focus {
        outline: none;
        border-color: var(--green);
        background-color: rgba(255, 255, 255, 1);
        box-shadow: 0 0 0 4px rgba(164, 190, 123, 0.3);
    }

    .search input::placeholder {
        color: var(--green);
        opacity: 0.7;
    }

    .search-btn {
        position: absolute;
        right: 10px;
        background: none;
        border: none;
        color: var(--green);
        font-size: 1.1rem;
        cursor: pointer;
        padding: 0.5rem;
        transition: all 0.3s ease;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .search-btn:hover {
        background: rgba(164, 190, 123, 0.2);
        color: var(--dark-green);
        transform: scale(1.1);
    }

    /* Search Results Dropdown */
    .search-results {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border-radius: 16px;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
        margin-top: 10px;
        max-height: 400px;
        overflow-y: auto;
        display: none;
        z-index: 1001;
        border: 1px solid rgba(164, 190, 123, 0.3);
        /* FIX: Force black text and proper colors */
        color: #333 !important;
    }

    .search-results.show {
        display: block;
    }

    .search-result-item {
        padding: 1rem 1.2rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        gap: 1rem;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
        /* FIX: Force dark green color */
        color: var(--dark-green) !important;
    }

    .search-result-item:hover {
        background: rgba(164, 190, 123, 0.08);
        padding-left: 1.5rem;
    }

    .search-result-item:last-child {
        border-bottom: none;
    }

    .search-result-image {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .search-result-content {
        flex: 1;
        min-width: 0;
    }

    .search-result-title {
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 0.3rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        /* FIX: Force dark green color */
        color: var(--dark-green) !important;
    }

    .search-result-category {
        display: inline-block;
        background: var(--cream);
        color: var(--dark-green);
        padding: 0.2rem 0.6rem;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
        /* FIX: Force dark green color */
        color: var(--dark-green) !important;
    }

    .search-result-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        font-size: 0.8rem;
        /* FIX: Force gray color */
        color: #666 !important;
    }

    .search-result-meta span {
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .search-loading {
        padding: 2rem;
        text-align: center;
        /* FIX: Force green color */
        color: var(--green) !important;
    }

    .search-loading i {
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .search-no-results {
        padding: 2rem;
        text-align: center;
        /* FIX: Force gray color */
        color: #666 !important;
    }

    .search-view-all {
        padding: 1rem 1.2rem;
        text-align: center;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
    }

    .search-view-all a {
        /* FIX: Force green color */
        color: var(--green) !important;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .search-view-all a:hover {
        /* FIX: Force dark green on hover */
        color: var(--dark-green) !important;
    }

    /* FIX: Override untuk semua text dalam search results */
    .search-results,
    .search-results * {
        color: #333 !important;
    }

    /* FIX: Highlight tetap berwarna dark green */
    .highlight {
        background: linear-gradient(120deg, rgba(164, 190, 123, 0.3) 0%, rgba(95, 141, 78, 0.3) 100%);
        padding: 0 2px;
        border-radius: 3px;
        font-weight: 600;
        /* FIX: Force dark green for highlight */
        color: var(--dark-green) !important;
    }

    /* PROFILE DROPDOWN */
    .profile-dropdown {
        position: relative;
        margin-left: 15px;
    }

    .profile-btn {
        background: none;
        border: none;
        cursor: pointer;
        padding: 8px;
        border-radius: 50%;
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .profile-btn i {
        font-size: 1.8rem;
        color: var(--dark-green);
    }

    .dropdown-menu {
        position: absolute;
        top: 100%;
        right: 0;
        background: white;
        min-width: 220px;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        display: none;
        z-index: 1000;
        margin-top: 10px;
        border: 1px solid rgba(164, 190, 123, 0.3);
    }

    .dropdown-menu.show {
        display: block;
    }

    .dropdown-menu a, 
    .dropdown-menu button {
        display: block;
        padding: 10px 15px;
        text-decoration: none;
        color: var(--dark-green);
        width: 100%;
        text-align: left;
        background: none;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .dropdown-menu a:hover,
    .dropdown-menu button:hover {
        background: rgba(164, 190, 123, 0.1);
    }

    .logout-form button {
        color: #dc3545;
    }

    /* UNTUK NAVBAR TRANSPARAN */
    .nav-container.nav-transparent .profile-btn i {
        color: white;
    }

    .nav-container.nav-transparent .login a {
        background: rgba(255,255,255,0.1);
        color: white;
        border: 1px solid rgba(255,255,255,0.2);
    }

    /* Adjust search for transparent navbar */
    .nav-container.nav-transparent .search input {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.3);
        color: white;
    }

    .nav-container.nav-transparent .search input::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    .nav-container.nav-transparent .search-btn {
        color: rgba(255, 255, 255, 0.8);
    }

    .nav-container.nav-transparent .search input:focus {
        background: rgba(255, 255, 255, 0.25);
        border-color: white;
        box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.1);
    }

    /* FIX: Search results harus tetap hitam meski navbar transparan */
    .nav-container.nav-transparent .search-results,
    .nav-container.nav-transparent .search-results * {
        color: #333 !important;
    }

    .nav-container.nav-transparent .search-result-item {
        color: var(--dark-green) !important;
    }

    .nav-container.nav-transparent .search-result-title {
        color: var(--dark-green) !important;
    }

    .nav-container.nav-transparent .search-result-category {
        color: var(--dark-green) !important;
    }

    .nav-container.nav-transparent .search-result-meta {
        color: #666 !important;
    }

    .nav-container.nav-transparent .highlight {
        color: var(--dark-green) !important;
    }

    /* Responsive Design */
    @media (max-width: 1100px) {
        .search-form {
            width: 400px;
        }
    }

    @media (max-width: 900px) {
        .search-form {
            width: 100%;
            max-width: 500px;
        }
        
        .nav .col2 {
            flex-direction: column;
            gap: 1.5rem;
            width: 100%;
        }
        
        .profile-dropdown {
            margin-left: 0;
        }
    }

    @media (max-width: 600px) {
        .search-form {
            width: 100%;
        }
        
        .search input {
            padding: 0.7rem 2.8rem 0.7rem 1rem;
        }
        
        .search-btn {
            right: 8px;
        }
        
        .search-results {
            position: fixed;
            top: 130px;
            left: 15px;
            right: 15px;
            max-height: 60vh;
        }
    }
</style>

<script>
    // Search functionality with debounce
    let searchTimeout;
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');
    const searchForm = document.getElementById('searchForm');

    if (searchInput && searchResults) {
        // Real-time search on input
        searchInput.addEventListener('input', function(e) {
            const query = e.target.value.trim();
            
            // Clear previous timeout
            clearTimeout(searchTimeout);
            
            if (query.length >= 2) {
                // Show loading
                searchResults.innerHTML = `
                    <div class="search-loading">
                        <i class="fas fa-spinner fa-spin"></i>
                        <p>Mencari berita...</p>
                    </div>
                `;
                searchResults.classList.add('show');
                
                // Debounce search request
                searchTimeout = setTimeout(() => {
                    performSearch(query);
                }, 300); // 300ms delay
            } else if (query.length === 0) {
                searchResults.classList.remove('show');
            }
        });

        // Focus management
        searchInput.addEventListener('focus', function() {
            if (this.value.trim().length >= 2) {
                searchResults.classList.add('show');
            }
        });

        // Click outside to close results
        document.addEventListener('click', function(event) {
            if (!searchForm.contains(event.target)) {
                searchResults.classList.remove('show');
            }
        });

        // Keyboard navigation
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                searchResults.classList.remove('show');
                this.blur();
            } else if (e.key === 'ArrowDown') {
                e.preventDefault();
                const firstResult = searchResults.querySelector('.search-result-item');
                if (firstResult) firstResult.focus();
            }
        });

        // Perform AJAX search - FIX URL
        function performSearch(query) {
            fetch(`/berita/search/suggest?q=${encodeURIComponent(query)}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success && data.berita && data.berita.length > 0) {
                        renderSearchResults(data.berita, query);
                    } else if (!data.success) {
                        searchResults.innerHTML = `
                            <div class="search-no-results">
                                <i class="fas fa-exclamation-triangle"></i>
                                <p>${data.message || 'Terjadi kesalahan saat mencari'}</p>
                            </div>
                        `;
                    } else {
                        searchResults.innerHTML = `
                            <div class="search-no-results">
                                <i class="far fa-file-alt"></i>
                                <p>Tidak ditemukan berita dengan kata kunci: <strong>"${query}"</strong></p>
                            </div>
                        `;
                    }
                })
                .catch(error => {
                    console.error('Search error:', error);
                    searchResults.innerHTML = `
                        <div class="search-no-results">
                            <i class="fas fa-exclamation-triangle"></i>
                            <p>Terjadi kesalahan saat mencari</p>
                            <small class="text-muted">Coba refresh halaman atau coba lagi nanti</small>
                        </div>
                    `;
                });
        }

        // Render search results - FIX: Gunakan gambar yang benar
        function renderSearchResults(beritaList, query) {
            let html = '';
            
            beritaList.forEach(berita => {
                // Highlight search term in title
                const title = highlightText(berita.judul, query);
                const date = new Date(berita.created_at).toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                });
                
                // FIX: Gunakan gambar yang benar dari response atau buat URL
                let imageUrl = '';
                
                if (berita.gambar_url) {
                    // Jika response sudah menyertakan gambar_url lengkap
                    imageUrl = berita.gambar_url;
                } else if (berita.gambar) {
                    // Jika hanya ada path gambar
                    // Cek apakah sudah ada domain atau masih relative path
                    if (berita.gambar.startsWith('http')) {
                        imageUrl = berita.gambar;
                    } else {
                        imageUrl = `/storage/${berita.gambar}`;
                    }
                } else {
                    // Fallback placeholder berdasarkan kategori
                    const placeholders = {
                        'Konservasi': 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09',
                        'Perubahan Iklim': 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e',
                        'Polusi': 'https://images.unsplash.com/photo-1425913397330-cf8af2ff40a1',
                        'Regulasi': 'https://images.unsplash.com/photo-1501854140801-50d01698950b',
                        'Teknologi Hijau': 'https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05',
                        'default': 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09'
                    };
                    
                    const placeholder = placeholders[berita.kategori] || placeholders['default'];
                    imageUrl = `${placeholder}?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80`;
                }
                
                html += `
                    <a href="/berita/${berita.id}" class="search-result-item">
                        <img src="${imageUrl}" 
                             alt="${berita.judul}" 
                             class="search-result-image"
                             onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80'">
                        <div class="search-result-content">
                            <div class="search-result-category">${berita.kategori}</div>
                            <div class="search-result-title">${title}</div>
                            <div class="search-result-meta">
                                <span><i class="far fa-calendar"></i> ${date}</span>
                                <span><i class="far fa-eye"></i> ${berita.views || 0}</span>
                            </div>
                        </div>
                    </a>
                `;
            });

            // Add view all link
            html += `
                <div class="search-view-all">
                    <a href="/berita?q=${encodeURIComponent(query)}">
                        <i class="fas fa-list"></i>
                        Lihat semua hasil untuk "${query}"
                    </a>
                </div>
            `;

            searchResults.innerHTML = html;
        }

        // Highlight search term in text
        function highlightText(text, query) {
            if (!query) return text;
            
            const regex = new RegExp(`(${query})`, 'gi');
            return text.replace(regex, '<span class="highlight">$1</span>');
        }
    }

    // FUNGSI PROFILE DROPDOWN
    function toggleDropdown() {
        const menu = document.getElementById('profileMenu');
        if (menu.style.display === 'block') {
            menu.style.display = 'none';
        } else {
            menu.style.display = 'block';
        }
    }

    // Tutup dropdown kalau klik di luar
    document.addEventListener('click', function(event) {
        const menu = document.getElementById('profileMenu');
        const button = document.querySelector('.profile-btn');
        
        if (menu && button) {
            if (!menu.contains(event.target) && !button.contains(event.target)) {
                menu.style.display = 'none';
            }
        }
    });

    // Highlight text CSS (dalam script karena kecil)
    const style = document.createElement('style');
    style.textContent = `
        /* Loading animation */
        .fa-spinner {
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* EXTRA FIX: Force proper colors for all search result elements */
        #searchResults {
            color: #333 !important;
        }
        
        #searchResults * {
            color: inherit !important;
        }
        
        #searchResults .search-result-title {
            color: var(--dark-green) !important;
        }
        
        #searchResults .search-result-category {
            color: var(--dark-green) !important;
        }
        
        #searchResults .search-result-meta {
            color: #666 !important;
        }
        
        #searchResults .highlight {
            color: var(--dark-green) !important;
        }
        
        /* Override for transparent navbar */
        .nav-container.nav-transparent #searchResults,
        .nav-container.nav-transparent #searchResults * {
            color: #333 !important;
        }
    `;
    document.head.appendChild(style);
</script>