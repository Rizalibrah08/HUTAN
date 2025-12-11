<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Edit Berita: {{ $berita->judul }} - Hutan</title>
    <style>
        /* EDIT BERITA PAGE STYLES */
        .edit-container {
            max-width: 1200px;
            margin: 3rem auto;
            padding: 0 2rem;
        }

        /* Header */
        .edit-header {
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid rgba(164, 190, 123, 0.3);
        }

        .edit-header h1 {
            font-size: 2.2rem;
            color: var(--dark-green);
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .edit-header h1 i {
            color: var(--green);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--green);
            text-decoration: none;
            font-weight: 500;
            margin-top: 1rem;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: var(--dark-green);
            transform: translateX(-3px);
        }

        /* Preview Link */
        .preview-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--sage);
            text-decoration: none;
            font-weight: 500;
            margin-left: 1.5rem;
            transition: all 0.3s ease;
        }

        .preview-link:hover {
            color: var(--dark-green);
            text-decoration: underline;
        }

        /* Form Container */
        .form-container {
            background: white;
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(229, 217, 182, 0.3);
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 2rem;
        }

        .form-label {
            display: block;
            font-size: 1rem;
            font-weight: 600;
            color: var(--dark-green);
            margin-bottom: 0.8rem;
        }

        .form-label.required:after {
            content: ' *';
            color: #dc3545;
        }

        .form-control {
            width: 100%;
            padding: 0.9rem 1rem;
            font-size: 1rem;
            font-family: inherit;
            color: var(--dark-green);
            background: white;
            border: 2px solid rgba(164, 190, 123, 0.3);
            border-radius: 10px;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-control:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(164, 190, 123, 0.2);
        }

        .form-control.error {
            border-color: #dc3545;
            background: rgba(220, 53, 69, 0.02);
        }

        .form-control::placeholder {
            color: rgba(40, 84, 48, 0.4);
        }

        /* Textarea khusus */
        .form-textarea {
            min-height: 200px;
            resize: vertical;
            line-height: 1.6;
        }

        /* Select dropdown */
        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%235F8D4E' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 16px;
            padding-right: 3rem;
        }

        /* Current Image */
        .current-image {
            margin-top: 1rem;
            padding: 1.5rem;
            background: rgba(164, 190, 123, 0.05);
            border-radius: 12px;
            border: 1px solid rgba(164, 190, 123, 0.2);
        }

        .current-image h4 {
            color: var(--dark-green);
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .image-preview {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .preview-img {
            width: 200px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid rgba(164, 190, 123, 0.3);
        }

        .image-info {
            flex: 1;
            min-width: 200px;
        }

        .image-info p {
            margin: 0.3rem 0;
            color: #666;
            font-size: 0.9rem;
        }

        /* File upload */
        .file-upload {
            position: relative;
            margin-top: 1rem;
        }

        .file-input {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 2;
        }

        .file-label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            padding: 1.5rem;
            border: 2px dashed rgba(164, 190, 123, 0.5);
            border-radius: 10px;
            background: rgba(164, 190, 123, 0.05);
            color: var(--dark-green);
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .file-label:hover {
            border-color: var(--green);
            background: rgba(164, 190, 123, 0.1);
        }

        .file-label i {
            font-size: 1.5rem;
            color: var(--green);
        }

        .file-preview {
            display: none;
            margin-top: 1rem;
            text-align: center;
        }

        .new-preview-image {
            max-width: 300px;
            max-height: 200px;
            border-radius: 10px;
            margin-bottom: 0.5rem;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
        }

        .file-name {
            font-size: 0.9rem;
            color: var(--green);
            font-weight: 500;
        }

        /* Character counter */
        .char-counter {
            font-size: 0.85rem;
            color: #666;
            text-align: right;
            margin-top: 0.5rem;
        }

        .char-counter.near-limit {
            color: #ff9800;
        }

        .char-counter.over-limit {
            color: #dc3545;
        }

        /* Error messages */
        .error-message {
            color: #dc3545;
            font-size: 0.85rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .error-message i {
            font-size: 0.8rem;
        }

        /* Success message */
        .success-message {
            background: rgba(39, 174, 96, 0.1);
            border: 1px solid #27ae60;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .success-message i {
            color: #27ae60;
            font-size: 1.2rem;
        }

        .success-message p {
            margin: 0;
            color: var(--dark-green);
            font-weight: 500;
        }

        /* Form actions */
        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(164, 190, 123, 0.2);
        }

        .btn {
            padding: 0.9rem 2rem;
            border-radius: 10px;
            border: none;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            text-decoration: none;
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

        .btn-danger {
            background: #dc3545;
            color: white;
            border: none;
        }

        .btn-danger:hover {
            background: #c82333;
            transform: translateY(-3px);
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
        }

        /* Loading state */
        .loading-spinner {
            display: none;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Tips/Helper text */
        .form-tips {
            background: rgba(164, 190, 123, 0.05);
            border-left: 4px solid var(--sage);
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 2rem;
        }

        .form-tips h4 {
            color: var(--dark-green);
            margin-bottom: 0.8rem;
            font-size: 1.1rem;
        }

        .form-tips ul {
            margin: 0;
            padding-left: 1.5rem;
            color: #666;
        }

        .form-tips li {
            margin-bottom: 0.5rem;
            line-height: 1.5;
        }

        /* Rich text editor area */
        .editor-toolbar {
            display: flex;
            gap: 0.5rem;
            padding: 1rem;
            background: #f8f9fa;
            border: 1px solid rgba(164, 190, 123, 0.3);
            border-bottom: none;
            border-radius: 10px 10px 0 0;
            flex-wrap: wrap;
        }

        .editor-btn {
            padding: 0.5rem 0.8rem;
            background: white;
            border: 1px solid rgba(164, 190, 123, 0.3);
            border-radius: 6px;
            cursor: pointer;
            color: var(--dark-green);
            transition: all 0.3s ease;
        }

        .editor-btn:hover {
            background: rgba(164, 190, 123, 0.1);
            border-color: var(--sage);
        }

        .editor-btn.active {
            background: var(--sage);
            color: white;
            border-color: var(--sage);
        }

        .editor-content {
            border: 1px solid rgba(164, 190, 123, 0.3);
            border-top: none;
            border-radius: 0 0 10px 10px;
            min-height: 300px;
            padding: 1rem;
            outline: none;
            line-height: 1.6;
            font-family: inherit;
            font-size: 1rem;
        }

        .editor-content:focus {
            border-color: var(--green);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .edit-container {
                padding: 0 1.5rem;
            }
            
            .form-container {
                padding: 2rem;
            }
            
            .edit-header h1 {
                font-size: 1.8rem;
            }
            
            .form-actions {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }
            
            .btn {
                width: 100%;
            }
            
            .image-preview {
                flex-direction: column;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .edit-container {
                padding: 0 1rem;
            }
            
            .form-container {
                padding: 1.5rem;
            }
            
            .form-label {
                font-size: 0.95rem;
            }
            
            .form-control {
                padding: 0.8rem;
                font-size: 0.95rem;
            }
            
            .editor-toolbar {
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
                    <h2>EDIT BERITA</h2>
                </div>

                <div class="edit-container">
                    <!-- Header -->
                    <div class="edit-header">
                        <h1>
                            <i class="fas fa-edit"></i>
                            Edit Berita: {{ $berita->judul }}
                        </h1>
                        <div>
                            <a href="{{ route('berita.show', $berita->id) }}" class="preview-link">
                                <i class="fas fa-eye"></i>
                                Lihat Preview
                            </a>
                            <a href="{{ route('berita.index') }}" class="back-link">
                                <i class="fas fa-arrow-left"></i>
                                Kembali ke Daftar Berita
                            </a>
                        </div>
                    </div>

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="success-message">
                            <i class="fas fa-check-circle"></i>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    <!-- Error Messages -->
                    @if($errors->any())
                        <div class="error-message" style="background: rgba(220, 53, 69, 0.1); border: 1px solid #dc3545; border-radius: 10px; padding: 1rem; margin-bottom: 2rem;">
                            <i class="fas fa-exclamation-triangle"></i>
                            <div>
                                <strong>Periksa kembali form:</strong>
                                <ul style="margin: 0.5rem 0 0 1.5rem; padding: 0;">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <!-- Form Tips -->
                    <div class="form-tips">
                        <h4><i class="fas fa-lightbulb"></i> Tips Edit Berita:</h4>
                        <ul>
                            <li>Pastikan gambar baru maksimal 2MB</li>
                            <li>Ringkasan (excerpt) maksimal 200 karakter</li>
                            <li>Konten berita minimal 300 karakter</li>
                            <li>Gambar lama akan diganti jika Anda upload gambar baru</li>
                        </ul>
                    </div>

                    <!-- Form Container -->
                    <div class="form-container">
                        <form method="POST" action="{{ route('berita.update', $berita->id) }}" enctype="multipart/form-data" id="editBeritaForm">
                            @csrf
                            @method('PUT')
                            
                            <!-- Judul -->
                            <div class="form-group">
                                <label class="form-label required" for="judul">Judul Berita</label>
                                <input type="text" 
                                       id="judul" 
                                       name="judul" 
                                       class="form-control @error('judul') error @enderror" 
                                       placeholder="Contoh: Program Reforestasi Berhasil Tanam 1 Juta Pohon di Kalimantan"
                                       value="{{ old('judul', $berita->judul) }}"
                                       required
                                       maxlength="255">
                                <div class="char-counter" id="judulCounter">{{ strlen(old('judul', $berita->judul)) }}/255 karakter</div>
                                @error('judul')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Kategori -->
                            <div class="form-group">
                                <label class="form-label required" for="kategori">Kategori</label>
                                <select id="kategori" 
                                        name="kategori" 
                                        class="form-control form-select @error('kategori') error @enderror" 
                                        required>
                                    <option value="">Pilih Kategori Berita</option>
                                    <option value="Perubahan Iklim" {{ old('kategori', $berita->kategori) == 'Perubahan Iklim' ? 'selected' : '' }}>Perubahan Iklim</option>
                                    <option value="Konservasi" {{ old('kategori', $berita->kategori) == 'Konservasi' ? 'selected' : '' }}>Konservasi</option>
                                    <option value="Polusi" {{ old('kategori', $berita->kategori) == 'Polusi' ? 'selected' : '' }}>Polusi</option>
                                    <option value="Regulasi" {{ old('kategori', $berita->kategori) == 'Regulasi' ? 'selected' : '' }}>Regulasi</option>
                                    <option value="Teknologi Hijau" {{ old('kategori', $berita->kategori) == 'Teknologi Hijau' ? 'selected' : '' }}>Teknologi Hijau</option>
                                    <option value="Keanekaragaman Hayati" {{ old('kategori', $berita->kategori) == 'Keanekaragaman Hayati' ? 'selected' : '' }}>Keanekaragaman Hayati</option>
                                </select>
                                @error('kategori')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Gambar -->
                            <div class="form-group">
                                <label class="form-label" for="gambar">Gambar Utama</label>
                                
                                <!-- Current Image -->
                                <div class="current-image">
                                    <h4><i class="fas fa-image"></i> Gambar Saat Ini</h4>
                                    <div class="image-preview">
                                        <img src="{{ Storage::url($berita->gambar) }}" 
                                             alt="{{ $berita->judul }}" 
                                             class="preview-img"
                                             onerror="this.src='https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'">
                                        <div class="image-info">
                                            <p><strong>File:</strong> {{ basename($berita->gambar) }}</p>
                                            <p><strong>Upload:</strong> {{ $berita->created_at->format('d M Y H:i') }}</p>
                                            <p><i class="fas fa-info-circle"></i> Kosongkan jika tidak ingin mengganti gambar</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Upload New Image -->
                                <div class="file-upload">
                                    <input type="file" 
                                           id="gambar" 
                                           name="gambar" 
                                           class="file-input @error('gambar') error @enderror" 
                                           accept="image/*">
                                    <label for="gambar" class="file-label" id="fileLabel">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                        <span>Klik untuk mengganti gambar (JPG, PNG, GIF - Maks. 2MB)</span>
                                    </label>
                                </div>
                                <div class="file-preview" id="filePreview">
                                    <img src="" alt="Preview Gambar Baru" class="new-preview-image">
                                    <div class="file-name"></div>
                                </div>
                                @error('gambar')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Ringkasan (Excerpt) -->
                            <div class="form-group">
                                <label class="form-label required" for="excerpt">Ringkasan (Excerpt)</label>
                                <textarea id="excerpt" 
                                          name="excerpt" 
                                          class="form-control form-textarea @error('excerpt') error @enderror" 
                                          placeholder="Ringkasan singkat berita yang akan ditampilkan di halaman utama"
                                          rows="3"
                                          maxlength="200"
                                          required>{{ old('excerpt', $berita->excerpt) }}</textarea>
                                <div class="char-counter" id="excerptCounter">{{ strlen(old('excerpt', $berita->excerpt)) }}/200 karakter</div>
                                @error('excerpt')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Konten -->
                            <div class="form-group">
                                <label class="form-label required" for="konten">Konten Berita</label>
                                
                                <!-- Simple Editor Toolbar -->
                                <div class="editor-toolbar">
                                    <button type="button" class="editor-btn" onclick="formatText('bold')" title="Bold">
                                        <i class="fas fa-bold"></i>
                                    </button>
                                    <button type="button" class="editor-btn" onclick="formatText('italic')" title="Italic">
                                        <i class="fas fa-italic"></i>
                                    </button>
                                    <button type="button" class="editor-btn" onclick="formatText('underline')" title="Underline">
                                        <i class="fas fa-underline"></i>
                                    </button>
                                    <button type="button" class="editor-btn" onclick="insertBullet()" title="Bullet List">
                                        <i class="fas fa-list-ul"></i>
                                    </button>
                                    <button type="button" class="editor-btn" onclick="insertNumber()" title="Number List">
                                        <i class="fas fa-list-ol"></i>
                                    </button>
                                    <button type="button" class="editor-btn" onclick="insertLink()" title="Insert Link">
                                        <i class="fas fa-link"></i>
                                    </button>
                                    <button type="button" class="editor-btn" onclick="insertImage()" title="Insert Image">
                                        <i class="fas fa-image"></i>
                                    </button>
                                </div>
                                
                                <div id="kontenEditor" 
                                     class="editor-content @error('konten') error @enderror"
                                     contenteditable="true">
                                    {!! old('konten', $berita->konten) !!}
                                </div>
                                
                                <textarea name="konten" 
                                          id="kontenHidden" 
                                          style="display:none;" 
                                          required>{{ old('konten', $berita->konten) }}</textarea>
                                
                                <div class="char-counter" id="kontenCounter">{{ strlen(strip_tags(old('konten', $berita->konten))) }} karakter (minimal 300)</div>
                                
                                @error('konten')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Form Actions -->
                            <div class="form-actions">
                                <div>
                                    <a href="{{ route('berita.show', $berita->id) }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i>
                                        Batal
                                    </a>
                                </div>
                                
                                <div style="display: flex; gap: 1rem;">
                                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                                        <i class="fas fa-trash"></i>
                                        Hapus Berita
                                    </button>
                                    
                                    <button type="submit" class="btn btn-primary" id="submitBtn">
                                        <i class="fas fa-save"></i>
                                        <span>Simpan Perubahan</span>
                                        <i class="fas fa-spinner loading-spinner"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Delete Form (Hidden) -->
                        <form id="deleteForm" method="POST" action="{{ route('berita.destroy', $berita->id) }}" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
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

        // Character counters
        function updateCharCounter(inputId, counterId, maxLength) {
            const input = document.getElementById(inputId);
            const counter = document.getElementById(counterId);
            
            if (input && counter) {
                const length = input.value.length;
                counter.textContent = `${length}/${maxLength} karakter`;
                
                // Warna warning
                if (length > maxLength * 0.9) {
                    counter.classList.add('near-limit');
                } else {
                    counter.classList.remove('near-limit');
                }
                
                if (length > maxLength) {
                    counter.classList.add('over-limit');
                } else {
                    counter.classList.remove('over-limit');
                }
            }
        }

        // File upload preview
        document.getElementById('gambar').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('filePreview');
            const label = document.getElementById('fileLabel');
            
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.querySelector('.new-preview-image').src = e.target.result;
                    preview.querySelector('.file-name').textContent = `File baru: ${file.name} (${(file.size / 1024).toFixed(1)} KB)`;
                    preview.style.display = 'block';
                    label.innerHTML = `<i class="fas fa-sync-alt"></i><span>Ganti file lain (${file.name})</span>`;
                }
                
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
                label.innerHTML = `<i class="fas fa-cloud-upload-alt"></i><span>Klik untuk mengganti gambar (JPG, PNG, GIF - Maks. 2MB)</span>`;
            }
        });

        // Text formatting for editor
        function formatText(command) {
            document.execCommand(command, false, null);
            updateHiddenContent();
        }

        function insertBullet() {
            document.execCommand('insertUnorderedList', false, null);
            updateHiddenContent();
        }

        function insertNumber() {
            document.execCommand('insertOrderedList', false, null);
            updateHiddenContent();
        }

        function insertLink() {
            const url = prompt('Masukkan URL:');
            if (url) {
                document.execCommand('createLink', false, url);
                updateHiddenContent();
            }
        }

        function insertImage() {
            const url = prompt('Masukkan URL gambar:');
            if (url) {
                document.execCommand('insertImage', false, url);
                updateHiddenContent();
            }
        }

        // Update hidden textarea with editor content
        function updateHiddenContent() {
            const editor = document.getElementById('kontenEditor');
            const hidden = document.getElementById('kontenHidden');
            const counter = document.getElementById('kontenCounter');
            
            if (editor && hidden) {
                // Strip HTML tags for character count
                const text = editor.innerText || editor.textContent;
                const length = text.length;
                
                hidden.value = editor.innerHTML;
                counter.textContent = `${length} karakter (minimal 300)`;
                
                if (length < 300) {
                    counter.classList.add('over-limit');
                } else {
                    counter.classList.remove('over-limit');
                }
            }
        }

        // Form submission
        document.getElementById('editBeritaForm').addEventListener('submit', function(e) {
            // Update hidden content sebelum submit
            updateHiddenContent();
            
            // Validasi konten minimal
            const editor = document.getElementById('kontenEditor');
            const text = editor.innerText || editor.textContent;
            
            if (text.length < 300) {
                e.preventDefault();
                alert('Konten berita minimal 300 karakter.');
                editor.focus();
                return;
            }
            
            // Show loading state
            const submitBtn = document.getElementById('submitBtn');
            const spinner = submitBtn.querySelector('.loading-spinner');
            const textSpan = submitBtn.querySelector('span');
            
            submitBtn.disabled = true;
            textSpan.textContent = 'Menyimpan...';
            spinner.style.display = 'inline-block';
        });

        // Delete confirmation
        function confirmDelete() {
            if (confirm('Apakah Anda yakin ingin menghapus berita ini?\n\nTindakan ini tidak dapat dibatalkan!')) {
                document.getElementById('deleteForm').submit();
            }
        }

        // Initialize counters and listeners
        document.addEventListener('DOMContentLoaded', function() {
            handleNavbarToggle();
            
            // Setup character counters
            const judulInput = document.getElementById('judul');
            const excerptInput = document.getElementById('excerpt');
            const editor = document.getElementById('kontenEditor');
            
            // Initial update
            updateCharCounter('judul', 'judulCounter', 255);
            updateCharCounter('excerpt', 'excerptCounter', 200);
            updateHiddenContent();
            
            // Live updates
            judulInput.addEventListener('input', () => updateCharCounter('judul', 'judulCounter', 255));
            excerptInput.addEventListener('input', () => updateCharCounter('excerpt', 'excerptCounter', 200));
            editor.addEventListener('input', updateHiddenContent);
            editor.addEventListener('paste', function(e) {
                // Allow paste but strip formatting
                e.preventDefault();
                const text = e.clipboardData.getData('text/plain');
                document.execCommand('insertText', false, text);
                updateHiddenContent();
            });
            
            // Auto-focus judul
            judulInput.focus();
        });

        window.addEventListener('scroll', handleNavbarToggle);
    </script>
</body>
</html>