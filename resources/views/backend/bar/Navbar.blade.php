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
            <div class="search">
                <input type="text" placeholder="Cari sesuatu...">
            </div>
            
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
                            {{-- <a href="/admin/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard Admin</a> --}}
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
        display: none; /* AWALNYA DISEMBUNYIKAN */
        z-index: 1000;
        margin-top: 10px;
        border: 1px solid rgba(164, 190, 123, 0.3);
    }

    .dropdown-menu.show {
        display: block; /* TAMPILKAN KETIKA ACTIVE */
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
</style>

<script>
    // FUNGSI SEDERHANA YANG PASTI BEKERJA
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
</script>