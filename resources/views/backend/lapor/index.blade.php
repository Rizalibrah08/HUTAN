<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Form Pengaduan - Layanan Publik</title>
    <style>
        /* ===== FORM PENGADUAN STYLES ===== */
        .form-pengaduan-container {
            max-width: 1400px;
            margin: 3rem auto;
            padding: 0 2rem;
        }

        .form-pengaduan-layout {
            display: flex;
            gap: 3rem;
            margin-top: 3rem;
        }

        /* Sidebar - 25% */
        .form-sidebar {
            flex: 0 0 25%;
            min-width: 280px;
        }

        .form-sidebar-card {
            background: white;
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(229, 217, 182, 0.3);
            position: sticky;
            top: 120px;
        }

        .form-sidebar-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--cream);
        }

        .form-menu-item {
            display: block;
            width: 100%;
            padding: 1.2rem 1.5rem;
            background: transparent;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-green);
            text-align: left;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
            position: relative;
            overflow: hidden;
        }

        .form-menu-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(164, 190, 123, 0.1), transparent);
            transition: left 0.6s ease;
        }

        .form-menu-item:hover::before {
            left: 100%;
        }

        .form-menu-item:hover {
            background: rgba(164, 190, 123, 0.08);
            transform: translateX(5px);
        }

        .form-menu-item.active {
            background: rgba(164, 190, 123, 0.15);
            color: var(--dark-green);
            box-shadow: 0 4px 15px rgba(164, 190, 123, 0.1);
        }

        .form-menu-item.active::after {
            content: '';
            position: absolute;
            right: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            width: 8px;
            height: 8px;
            background: var(--green);
            border-radius: 50%;
        }

        /* Form Content - 75% */
        .form-content {
            flex: 1;
        }

        .form-header {
            margin-bottom: 2.5rem;
        }

        .form-title {
            font-size: 2.8rem;
            font-weight: 700;
            color: var(--dark-green);
            margin-bottom: 0.8rem;
            line-height: 1.2;
        }

        .form-subtitle {
            font-size: 1.2rem;
            color: var(--text-medium);
            line-height: 1.6;
            max-width: 800px;
        }

        /* Form Card */
        .form-card {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 8px 35px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(229, 217, 182, 0.2);
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 2.5rem;
        }

        .form-label {
            display: block;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-green);
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-label.required::after {
            content: '*';
            color: #e74c3c;
            margin-left: 0.2rem;
        }

        .form-control-custom {
            width: 100%;
            padding: 1.2rem 1.5rem;
            font-size: 1.1rem;
            font-family: inherit;
            color: var(--dark-green);
            background: white;
            border: 2px solid rgba(164, 190, 123, 0.3);
            border-radius: 12px;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-control-custom:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 4px rgba(164, 190, 123, 0.15);
            transform: translateY(-2px);
        }

        .form-control-custom::placeholder {
            color: var(--text-light);
            opacity: 0.7;
        }

        textarea.form-control-custom {
            min-height: 180px;
            resize: vertical;
            line-height: 1.6;
        }

        select.form-control-custom {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%235F8D4E' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1.5rem center;
            background-size: 16px;
            padding-right: 3.5rem;
        }

        /* File Upload */
        .file-upload-wrapper {
            position: relative;
            border: 2px dashed rgba(164, 190, 123, 0.4);
            border-radius: 12px;
            padding: 3rem 2rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .file-upload-wrapper:hover {
            border-color: var(--sage);
            background: rgba(164, 190, 123, 0.03);
        }

        .file-upload-wrapper.dragover {
            border-color: var(--green);
            background: rgba(164, 190, 123, 0.08);
        }

        .file-upload-icon {
            font-size: 3rem;
            color: var(--sage);
            margin-bottom: 1.5rem;
        }

        .file-upload-text {
            font-size: 1.1rem;
            color: var(--text-medium);
            margin-bottom: 0.5rem;
        }

        .file-upload-hint {
            font-size: 0.9rem;
            color: var(--text-light);
            margin-bottom: 1.5rem;
        }

        .file-upload-btn {
            display: inline-block;
            padding: 0.8rem 2rem;
            background: rgba(164, 190, 123, 0.1);
            color: var(--green);
            border: 2px solid var(--sage);
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-upload-btn:hover {
            background: var(--sage);
            color: white;
        }

        .file-input {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }

        .file-list {
            margin-top: 1.5rem;
            display: none;
        }

        .file-list.show {
            display: block;
        }

        .file-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(164, 190, 123, 0.05);
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 0.8rem;
        }

        .file-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .file-icon {
            color: var(--green);
            font-size: 1.2rem;
        }

        .file-name {
            color: var(--dark-green);
            font-weight: 500;
        }

        .file-size {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .file-remove {
            color: #e74c3c;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.2rem;
            padding: 0.3rem;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .file-remove:hover {
            background: rgba(231, 76, 60, 0.1);
        }

        /* Submit Button */
        .form-submit {
            text-align: center;
            margin-top: 3rem;
            padding-top: 3rem;
            border-top: 2px solid rgba(164, 190, 123, 0.1);
        }

        .submit-btn {
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            padding: 1.3rem 3.5rem;
            background: linear-gradient(135deg, var(--green) 0%, var(--dark-green) 100%);
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(95, 141, 78, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(95, 141, 78, 0.4);
            background: linear-gradient(135deg, var(--dark-green) 0%, var(--green) 100%);
        }

        .submit-btn:active {
            transform: translateY(-2px);
        }

        /* Form Info */
        .form-info {
            background: linear-gradient(135deg, rgba(229, 217, 182, 0.05) 0%, rgba(164, 190, 123, 0.05) 100%);
            border-radius: 12px;
            padding: 2rem;
            margin-top: 2.5rem;
            border-left: 4px solid var(--sage);
        }

        .form-info-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-green);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .form-info-title i {
            color: var(--green);
        }

        .form-info-text {
            color: var(--text-medium);
            line-height: 1.6;
            font-size: 1rem;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .form-pengaduan-layout {
                flex-direction: column;
                gap: 2rem;
            }
            
            .form-sidebar {
                flex: none;
                width: 100%;
                min-width: auto;
            }
            
            .form-sidebar-card {
                position: static;
                top: auto;
            }
        }

        @media (max-width: 768px) {
            .form-pengaduan-container {
                padding: 0 1.5rem;
            }
            
            .form-title {
                font-size: 2.2rem;
            }
            
            .form-card {
                padding: 2rem;
            }
            
            .form-group {
                margin-bottom: 2rem;
            }
            
            .form-control-custom {
                padding: 1rem 1.2rem;
                font-size: 1rem;
            }
            
            .submit-btn {
                padding: 1.2rem 2.5rem;
                font-size: 1.1rem;
            }
            
            .file-upload-wrapper {
                padding: 2rem 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .form-pengaduan-container {
                padding: 0 1rem;
            }
            
            .form-title {
                font-size: 1.8rem;
            }
            
            .form-subtitle {
                font-size: 1.1rem;
            }
            
            .form-card {
                padding: 1.5rem;
                border-radius: 16px;
            }
            
            .form-label {
                font-size: 1rem;
            }
            
            .form-menu-item {
                padding: 1rem 1.2rem;
                font-size: 1rem;
            }
            
            .file-upload-wrapper {
                padding: 1.5rem 1rem;
            }
            
            .file-upload-icon {
                font-size: 2.5rem;
            }
            
            .file-upload-text {
                font-size: 1rem;
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
            <div>
                <div class="gambar">
                    <h2>LAYANAN PENGADUAN</h2>
                </div>
                
                <!-- Form Pengaduan Section -->
                <div class="form-pengaduan-container">
                    <div class="form-pengaduan-layout">
                        <!-- Sidebar - 25% -->
                        <aside class="form-sidebar">
                            <div class="form-sidebar-card">
                                <h3 class="form-sidebar-title">Menu</h3>
                                <button class="form-menu-item active">
                                    <i class="fas fa-bullhorn me-2"></i>
                                    Pengaduan
                                </button>
                                <button class="form-menu-item">
                                    <i class="fas fa-file-alt me-2"></i>
                                    Panduan
                                </button>
                                <button class="form-menu-item">
                                    <i class="fas fa-question-circle me-2"></i>
                                    FAQ
                                </button>
                                <button class="form-menu-item">
                                    <i class="fas fa-headset me-2"></i>
                                    Kontak Support
                                </button>
                            </div>
                        </aside>

                        <!-- Form Content - 75% -->
                        <main class="form-content">
                            <div class="form-header">
                                <h1 class="form-title">Form Pengaduan</h1>
                                <p class="form-subtitle">
                                    Lengkapi data di bawah ini untuk mengirim laporan Anda. 
                                    Semua informasi akan dijaga kerahasiaannya dan ditindaklanjuti oleh pihak berwenang.
                                </p>
                            </div>

                            <div class="form-card">
                                <form id="pengaduanForm">
                                    <!-- Judul Laporan -->
                                    <div class="form-group">
                                        <label class="form-label required" for="judulLaporan">
                                            <i class="fas fa-envelope"></i>
                                            Email Pelapor
                                        </label>
                                        <input 
                                            type="email" 
                                            id="emailPelapor"
                                            class="form-control-custom"
                                            placeholder="Contoh: user@email.com"
                                            required
                                        >
                                        <small class="text-muted" style="display: block; margin-top: 0.5rem; color: var(--text-light);">
                                            Gunakan email aktif untuk komunikasi lebih lanjut
                                        </small>
                                    </div>
                                    
                                    <!-- Judul Laporan -->
                                    <div class="form-group">
                                        <label class="form-label required" for="judulLaporan">
                                            <i class="fas fa-heading"></i>
                                            Judul Laporan
                                        </label>
                                        <input 
                                            type="text" 
                                            id="judulLaporan"
                                            class="form-control-custom"
                                            placeholder="Contoh: Penebangan Liar di Hutan Lindung"
                                            required
                                        >
                                        <small class="text-muted" style="display: block; margin-top: 0.5rem; color: var(--text-light);">
                                            Buat judul yang jelas dan deskriptif untuk membantu penanganan
                                        </small>
                                    </div>

                                    <!-- Isi Laporan -->
                                    <div class="form-group">
                                        <label class="form-label required" for="isiLaporan">
                                            <i class="fas fa-file-alt"></i>
                                            Isi Laporan
                                        </label>
                                        <textarea 
                                            id="isiLaporan"
                                            class="form-control-custom"
                                            placeholder="Jelaskan secara detail kejadian yang Anda laporkan. Sertakan informasi waktu, tempat, dan kronologi kejadian."
                                            rows="6"
                                            required
                                        ></textarea>
                                        <small class="text-muted" style="display: block; margin-top: 0.5rem; color: var(--text-light);">
                                            Minimal 100 karakter. Jelaskan dengan jelas agar laporan dapat ditindaklanjuti
                                        </small>
                                    </div>

                                    <!-- Tanggal dan Lokasi -->
                                    <div class="form-row" style="display: flex; gap: 2rem; margin-bottom: 2.5rem;">
                                        <div style="flex: 1;">
                                            <label class="form-label required" for="tanggalKejadian">
                                                <i class="far fa-calendar-alt"></i>
                                                Tanggal Kejadian
                                            </label>
                                            <input 
                                                type="date" 
                                                id="tanggalKejadian"
                                                class="form-control-custom"
                                                required
                                            >
                                        </div>
                                        <div style="flex: 2;">
                                            <label class="form-label required" for="lokasiKejadian">
                                                <i class="fas fa-map-marker-alt"></i>
                                                Lokasi Kejadian
                                            </label>
                                            <input 
                                                type="text" 
                                                id="lokasiKejadian"
                                                class="form-control-custom"
                                                placeholder="Contoh: Jl. Hutan Lindung No. 123, Kecamatan Sukamaju"
                                                required
                                            >
                                        </div>
                                    </div>

                                    <!-- Kategori Laporan -->
                                    <div class="form-group">
                                        <label class="form-label required" for="kategoriLaporan">
                                            <i class="fas fa-tags"></i>
                                            Kategori Laporan
                                        </label>
                                        <select id="kategoriLaporan" class="form-control-custom" required>
                                            <option value="" disabled selected>Pilih kategori laporan</option>
                                            <option value="fasilitas">Fasilitas Publik</option>
                                            <option value="keamanan">Keamanan Lingkungan</option>
                                            <option value="layanan">Layanan Publik</option>
                                            <option value="lingkungan">Kerusakan Lingkungan</option>
                                            <option value="sampah">Pengelolaan Sampah</option>
                                            <option value="polusi">Polusi Udara/Air</option>
                                        </select>
                                    </div>

                                    <!-- Lampiran -->
                                    <div class="form-group">
                                        <label class="form-label" for="lampiran">
                                            <i class="fas fa-paperclip"></i>
                                            Lampiran
                                        </label>
                                        <div class="file-upload-wrapper" id="fileDropArea">
                                            <div class="file-upload-icon">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                            </div>
                                            <div class="file-upload-text">
                                                Seret dan lepas file di sini atau klik untuk mengunggah
                                            </div>
                                            <div class="file-upload-hint">
                                                Maksimal 5 file, masing-masing maksimal 10MB. Format: JPG, PNG, PDF, DOC
                                            </div>
                                            <button type="button" class="file-upload-btn">
                                                <i class="fas fa-folder-open me-2"></i>
                                                Pilih File
                                            </button>
                                            <input 
                                                type="file" 
                                                id="lampiran"
                                                class="file-input"
                                                multiple
                                                accept=".jpg,.jpeg,.png,.pdf,.doc,.docx"
                                            >
                                        </div>
                                        <div class="file-list" id="fileList">
                                            <!-- File list akan ditampilkan di sini -->
                                        </div>
                                    </div>

                                    <!-- Informasi Tambahan -->
                                    <div class="form-info">
                                        <h4 class="form-info-title">
                                            <i class="fas fa-info-circle"></i>
                                            Informasi Penting
                                        </h4>
                                        <p class="form-info-text">
                                            • Laporan Anda akan diproses dalam waktu maksimal 3-5 hari kerja<br>
                                            • Pastikan data yang diisi akurat dan dapat dipertanggungjawabkan<br>
                                            • Anda akan mendapatkan nomor tiket untuk melacak status laporan<br>
                                            • Identitas pelapor dijamin kerahasiaannya sesuai peraturan yang berlaku
                                        </p>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="form-submit">
                                        <button type="submit" class="submit-btn">
                                            <i class="fas fa-paper-plane"></i>
                                            Kirim Laporan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </main>
                    </div>
                </div>
                <!-- End Form Pengaduan -->
                
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

        // Form functionality
        document.addEventListener('DOMContentLoaded', function() {
            handleNavbarToggle();
            
            // Sidebar menu item click
            document.querySelectorAll('.form-menu-item').forEach(item => {
                item.addEventListener('click', function() {
                    document.querySelectorAll('.form-menu-item').forEach(i => {
                        i.classList.remove('active');
                    });
                    this.classList.add('active');
                    
                    // Add ripple effect
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = event.clientX - rect.left - size/2;
                    const y = event.clientY - rect.top - size/2;
                    
                    ripple.style.cssText = `
                        position: absolute;
                        border-radius: 50%;
                        background: rgba(164, 190, 123, 0.3);
                        transform: scale(0);
                        animation: ripple 0.6s linear;
                        width: ${size}px;
                        height: ${size}px;
                        top: ${y}px;
                        left: ${x}px;
                    `;
                    
                    this.appendChild(ripple);
                    setTimeout(() => ripple.remove(), 600);
                });
            });

            // File upload functionality
            const fileDropArea = document.getElementById('fileDropArea');
            const fileInput = document.getElementById('lampiran');
            const fileList = document.getElementById('fileList');
            const fileUploadBtn = fileDropArea.querySelector('.file-upload-btn');
            
            let files = [];
            
            // Click to select files
            fileUploadBtn.addEventListener('click', (e) => {
                e.preventDefault();
                fileInput.click();
            });
            
            fileDropArea.addEventListener('click', (e) => {
                if (e.target !== fileUploadBtn) {
                    fileInput.click();
                }
            });
            
            // Handle file selection
            fileInput.addEventListener('change', (e) => {
                handleFiles(e.target.files);
            });
            
            // Drag and drop functionality
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                fileDropArea.addEventListener(eventName, preventDefaults, false);
            });
            
            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }
            
            ['dragenter', 'dragover'].forEach(eventName => {
                fileDropArea.addEventListener(eventName, highlight, false);
            });
            
            ['dragleave', 'drop'].forEach(eventName => {
                fileDropArea.addEventListener(eventName, unhighlight, false);
            });
            
            function highlight() {
                fileDropArea.classList.add('dragover');
            }
            
            function unhighlight() {
                fileDropArea.classList.remove('dragover');
            }
            
            fileDropArea.addEventListener('drop', (e) => {
                const dt = e.dataTransfer;
                const droppedFiles = dt.files;
                handleFiles(droppedFiles);
            });
            
            function handleFiles(newFiles) {
                const maxFiles = 5;
                const maxSize = 10 * 1024 * 1024; // 10MB
                const allowedTypes = ['image/jpeg', 'image/png', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                
                Array.from(newFiles).forEach(file => {
                    // Check file limit
                    if (files.length >= maxFiles) {
                        alert(`Maksimal ${maxFiles} file yang diizinkan`);
                        return;
                    }
                    
                    // Check file size
                    if (file.size > maxSize) {
                        alert(`File ${file.name} terlalu besar. Maksimal 10MB`);
                        return;
                    }
                    
                    // Check file type
                    if (!allowedTypes.includes(file.type)) {
                        alert(`File ${file.name} tidak didukung. Gunakan JPG, PNG, PDF, atau DOC`);
                        return;
                    }
                    
                    files.push(file);
                });
                
                updateFileList();
            }
            
            function updateFileList() {
                fileList.innerHTML = '';
                
                if (files.length === 0) {
                    fileList.classList.remove('show');
                    return;
                }
                
                fileList.classList.add('show');
                
                files.forEach((file, index) => {
                    const fileItem = document.createElement('div');
                    fileItem.className = 'file-item';
                    
                    const fileSize = formatFileSize(file.size);
                    
                    fileItem.innerHTML = `
                        <div class="file-info">
                            <i class="fas fa-file file-icon"></i>
                            <div>
                                <div class="file-name">${file.name}</div>
                                <div class="file-size">${fileSize}</div>
                            </div>
                        </div>
                        <button type="button" class="file-remove" data-index="${index}">
                            <i class="fas fa-times"></i>
                        </button>
                    `;
                    
                    fileList.appendChild(fileItem);
                });
                
                // Add remove functionality
                document.querySelectorAll('.file-remove').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const index = parseInt(this.getAttribute('data-index'));
                        files.splice(index, 1);
                        updateFileList();
                    });
                });
            }
            
            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }
            
            // Form submission
            const form = document.getElementById('pengaduanForm');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Basic validation
                const judul = document.getElementById('judulLaporan').value.trim();
                const isi = document.getElementById('isiLaporan').value.trim();
                const tanggal = document.getElementById('tanggalKejadian').value;
                const lokasi = document.getElementById('lokasiKejadian').value.trim();
                const kategori = document.getElementById('kategoriLaporan').value;
                
                if (!judul || !isi || !tanggal || !lokasi || !kategori) {
                    alert('Harap lengkapi semua field yang wajib diisi');
                    return;
                }
                
                if (isi.length < 100) {
                    alert('Isi laporan minimal 100 karakter');
                    return;
                }
                
                // Show loading state
                const submitBtn = form.querySelector('.submit-btn');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
                submitBtn.disabled = true;
                
                // Simulate API call
                setTimeout(() => {
                    // Show success message
                    submitBtn.innerHTML = '<i class="fas fa-check"></i> Terkirim!';
                    submitBtn.style.background = 'linear-gradient(135deg, #27ae60, #2ecc71)';
                    
                    // Reset form after 2 seconds
                    setTimeout(() => {
                        form.reset();
                        files = [];
                        updateFileList();
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                        submitBtn.style.background = 'linear-gradient(135deg, var(--green) 0%, var(--dark-green) 100%)';
                        
                        // Show success notification
                        showNotification('Laporan berhasil dikirim! Anda akan mendapatkan email konfirmasi.', 'success');
                    }, 2000);
                }, 2000);
            });
            
            function showNotification(message, type) {
                const notification = document.createElement('div');
                notification.className = `notification notification-${type}`;
                notification.innerHTML = `
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                        <span>${message}</span>
                    </div>
                    <button class="notification-close">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                
                // Add styles
                notification.style.cssText = `
                    position: fixed;
                    top: 100px;
                    right: 20px;
                    background: white;
                    padding: 1.5rem;
                    border-radius: 12px;
                    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
                    border-left: 4px solid ${type === 'success' ? 'var(--green)' : '#e74c3c'};
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    min-width: 300px;
                    max-width: 400px;
                    z-index: 1000;
                    animation: slideIn 0.3s ease;
                `;
                
                document.body.appendChild(notification);
                
                // Add close button functionality
                notification.querySelector('.notification-close').addEventListener('click', () => {
                    notification.style.animation = 'slideOut 0.3s ease';
                    setTimeout(() => notification.remove(), 300);
                });
                
                // Auto remove after 5 seconds
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.style.animation = 'slideOut 0.3s ease';
                        setTimeout(() => notification.remove(), 300);
                    }
                }, 5000);
            }
            
            // Add CSS animations
            const style = document.createElement('style');
            style.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
                
                @keyframes slideIn {
                    from {
                        transform: translateX(100%);
                        opacity: 0;
                    }
                    to {
                        transform: translateX(0);
                        opacity: 1;
                    }
                }
                
                @keyframes slideOut {
                    from {
                        transform: translateX(0);
                        opacity: 1;
                    }
                    to {
                        transform: translateX(100%);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        });

        window.addEventListener('scroll', handleNavbarToggle);
        window.addEventListener('resize', handleNavbarToggle);
    </script>
</body>
</html>