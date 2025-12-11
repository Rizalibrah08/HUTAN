<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Tambah Berita Baru - Hutan</title>
    <style>
        /* CREATE BERITA PAGE STYLES */
        .create-container {
            max-width: 1200px;
            margin: 3rem auto;
            padding: 0 2rem;
        }

        /* Header */
        .create-header {
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid rgba(164, 190, 123, 0.3);
        }

        .create-header h1 {
            font-size: 2.2rem;
            color: var(--dark-green);
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .create-header h1 i {
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

        /* File upload */
        .file-upload {
            position: relative;
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

        .preview-image {
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
            justify-content: flex-end;
            gap: 1rem;
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

        /* Rich text editor area (placeholder untuk editor) */
        .editor-toolbar {
            display: flex;
            gap: 0.5rem;
            padding: 1rem;
            background: #f8f9fa;
            border: 1px solid rgba(164, 190, 123, 0.3);
            border-bottom: none;
            border-radius: 10px 10px 0 0;
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

        .editor-content {
            border: 1px solid rgba(164, 190, 123, 0.3);
            border-top: none;
            border-radius: 0 0 10px 10px;
            min-height: 300px;
            padding: 1rem;
            outline: none;
            line-height: 1.6;
        }

        .editor-content:focus {
            border-color: var(--green);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .create-container {
                padding: 0 1.5rem;
            }
            
            .form-container {
                padding: 2rem;
            }
            
            .create-header h1 {
                font-size: 1.8rem;
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .create-container {
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
                    <h2>TAMBAH BERITA</h2>
                </div>

                <div class="create-container">
                    <!-- Header -->
                    <div class="create-header">
                        <h1>
                            <i class="fas fa-plus-circle"></i>
                            Tambah Berita Baru
                        </h1>
                        <a href="{{ route('berita.index') }}" class="back-link">
                            <i class="fas fa-arrow-left"></i>
                            Kembali ke Daftar Berita
                        </a>
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
                        <h4><i class="fas fa-lightbulb"></i> Tips Menulis Berita:</h4>
                        <ul>
                            <li>Gunakan judul yang menarik dan informatif</li>
                            <li>Ringkasan (excerpt) maksimal 200 karakter</li>
                            <li>Pilih gambar yang relevan dengan isi berita</li>
                            <li>Format gambar: JPG, PNG, GIF (maks. 2MB)</li>
                            <li>Konten berita minimal 300 karakter</li>
                        </ul>
                    </div>

                    <!-- Form Container -->
                    <div class="form-container">
                        <form method="POST" action="{{ route('berita.store') }}" enctype="multipart/form-data" id="beritaForm">
                            @csrf
                            
                            <!-- Judul -->
                            <div class="form-group">
                                <label class="form-label required" for="judul">Judul Berita</label>
                                <input type="text" 
                                       id="judul" 
                                       name="judul" 
                                       class="form-control @error('judul') error @enderror" 
                                       placeholder="Contoh: Program Reforestasi Berhasil Tanam 1 Juta Pohon di Kalimantan"
                                       value="{{ old('judul') }}"
                                       required
                                       maxlength="255">
                                <div class="char-counter" id="judulCounter">0/255 karakter</div>
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
                                    <option value="" disabled selected>Pilih Kategori Berita</option>
                                    <option value="Perubahan Iklim" {{ old('kategori') == 'Perubahan Iklim' ? 'selected' : '' }}>Perubahan Iklim</option>
                                    <option value="Konservasi" {{ old('kategori') == 'Konservasi' ? 'selected' : '' }}>Konservasi</option>
                                    <option value="Polusi" {{ old('kategori') == 'Polusi' ? 'selected' : '' }}>Polusi</option>
                                    <option value="Regulasi" {{ old('kategori') == 'Regulasi' ? 'selected' : '' }}>Regulasi</option>
                                    <option value="Teknologi Hijau" {{ old('kategori') == 'Teknologi Hijau' ? 'selected' : '' }}>Teknologi Hijau</option>
                                    <option value="Keanekaragaman Hayati" {{ old('kategori') == 'Keanekaragaman Hayati' ? 'selected' : '' }}>Keanekaragaman Hayati</option>
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
                                <label class="form-label required" for="gambar">Gambar Utama</label>
                                <div class="file-upload">
                                    <input type="file" 
                                           id="gambar" 
                                           name="gambar" 
                                           class="file-input @error('gambar') error @enderror" 
                                           accept="image/*"
                                           required>
                                    <label for="gambar" class="file-label" id="fileLabel">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                        <span>Klik untuk memilih gambar (JPG, PNG, GIF - Maks. 2MB)</span>
                                    </label>
                                </div>
                                <div class="file-preview" id="filePreview">
                                    <img src="" alt="Preview" class="preview-image">
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
                                          required>{{ old('excerpt') }}</textarea>
                                <div class="char-counter" id="excerptCounter">0/200 karakter</div>
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
                                </div>
                                
                                <div id="konten" 
                                     class="editor-content @error('konten') error @enderror"
                                     contenteditable="true"
                                     placeholder="Tulis konten berita lengkap di sini...">{{ old('konten') }}</div>
                                
                                <textarea name="konten" 
                                          id="kontenHidden" 
                                          style="display:none;" 
                                          required></textarea>
                                
                                <div class="char-counter" id="kontenCounter">0 karakter (minimal 300)</div>
                                
                                @error('konten')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Form Actions -->
                            <div class="form-actions">
                                <a href="{{ route('berita.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i>
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-primary" id="submitBtn">
                                    <i class="fas fa-paper-plane"></i>
                                    <span>Simpan Berita</span>
                                    <i class="fas fa-spinner loading-spinner"></i>
                                </button>
                            </div>
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
                    preview.querySelector('.preview-image').src = e.target.result;
                    preview.querySelector('.file-name').textContent = file.name;
                    preview.style.display = 'block';
                    label.innerHTML = `<i class="fas fa-check-circle"></i><span>Ganti gambar (${file.name})</span>`;
                }
                
                reader.readAsDataURL(file);
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

        // Update hidden textarea with editor content
        function updateHiddenContent() {
            const editor = document.getElementById('konten');
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
        document.getElementById('beritaForm').addEventListener('submit', function(e) {
            // Update hidden content sebelum submit
            updateHiddenContent();
            
            // Validasi konten minimal
            const editor = document.getElementById('konten');
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

        // Initialize counters and listeners
        document.addEventListener('DOMContentLoaded', function() {
            handleNavbarToggle();
            
            // Setup character counters
            const judulInput = document.getElementById('judul');
            const excerptInput = document.getElementById('excerpt');
            const editor = document.getElementById('konten');
            
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
            
            // Editor placeholder
            editor.addEventListener('focus', function() {
                if (!this.textContent.trim()) {
                    this.textContent = '';
                }
            });
            
            editor.addEventListener('blur', function() {
                if (!this.textContent.trim()) {
                    this.innerHTML = '<p>Tulis konten berita lengkap di sini...</p>';
                }
            });
        });

        window.addEventListener('scroll', handleNavbarToggle);
    </script>
</body>
</html>