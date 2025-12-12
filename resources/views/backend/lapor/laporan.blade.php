<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Daftar Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --cream: #E5D9B6;
            --sage: #A4BE7B;
            --green: #5F8D4E;
            --dark-green: #285430;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar-custom {
            background: linear-gradient(135deg, var(--dark-green) 0%, var(--green) 100%);
            box-shadow: 0 4px 20px rgba(40, 84, 48, 0.2);
        }
        
        .admin-container {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }
        
        .admin-header {
            background: white;
            border-radius: 16px;
            padding: 2.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(164, 190, 123, 0.2);
        }
        
        .admin-title {
            color: var(--dark-green);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .admin-subtitle {
            color: #6c757d;
            font-size: 1.1rem;
        }
        
        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(164, 190, 123, 0.2);
            transition: all 0.3s ease;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(164, 190, 123, 0.15);
        }
        
        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }
        
        .stats-icon.menunggu { background: rgba(255, 193, 7, 0.1); color: #ffc107; }
        .stats-icon.investigasi { background: rgba(155, 89, 182, 0.1); color: #9b59b6; }
        .stats-icon.diproses { background: rgba(52, 152, 219, 0.1); color: #3498db; }
        .stats-icon.selesai { background: rgba(46, 204, 113, 0.1); color: #2ecc71; }
        .stats-icon.total { background: rgba(164, 190, 123, 0.1); color: var(--green); }
        
        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-green);
            margin-bottom: 0.3rem;
        }
        
        .stats-label {
            color: #6c757d;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .table-container {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(164, 190, 123, 0.2);
        }
        
        .table-custom {
            width: 100%;
            border-collapse: collapse;
        }
        
        .table-custom th {
            background: rgba(164, 190, 123, 0.1);
            color: var(--dark-green);
            font-weight: 600;
            padding: 1.2rem 1rem;
            text-align: left;
            border-bottom: 2px solid rgba(164, 190, 123, 0.3);
        }
        
        .table-custom td {
            padding: 1rem;
            border-bottom: 1px solid rgba(164, 190, 123, 0.1);
            vertical-align: top;
        }
        
        .table-custom tr:hover {
            background: rgba(164, 190, 123, 0.05);
        }
        
        .status-badge {
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
        }
        
        .action-btn {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            margin-right: 0.3rem;
            margin-bottom: 0.3rem;
        }
        
        .action-btn.detail {
            background: rgba(164, 190, 123, 0.1);
            color: var(--green);
        }
        
        .action-btn.detail:hover {
            background: var(--sage);
            color: white;
        }
        
        .action-btn.edit {
            background: rgba(52, 152, 219, 0.1);
            color: #3498db;
        }
        
        .action-btn.edit:hover {
            background: #3498db;
            color: white;
        }
        
        .action-btn.investigasi {
            background: rgba(155, 89, 182, 0.1);
            color: #9b59b6;
        }
        
        .action-btn.investigasi:hover {
            background: #9b59b6;
            color: white;
        }
        
        .action-btn.proses {
            background: rgba(41, 128, 185, 0.1);
            color: #2980b9;
        }
        
        .action-btn.proses:hover {
            background: #2980b9;
            color: white;
        }
        
        .action-btn.selesai {
            background: rgba(39, 174, 96, 0.1);
            color: #27ae60;
        }
        
        .action-btn.selesai:hover {
            background: #27ae60;
            color: white;
        }
        
        .pagination-custom .page-link {
            color: var(--green);
            border: 1px solid rgba(164, 190, 123, 0.3);
        }
        
        .pagination-custom .page-item.active .page-link {
            background: var(--green);
            border-color: var(--green);
            color: white;
        }
        
        .pagination-custom .page-link:hover {
            background: rgba(164, 190, 123, 0.1);
            border-color: var(--sage);
        }
        
        .text-muted-small {
            font-size: 0.85rem;
            color: #6c757d;
        }
        
        .progress-thin {
            height: 8px;
            margin-top: 5px;
        }
        
        .workflow-timeline {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            position: relative;
        }
        
        .workflow-step {
            text-align: center;
            flex: 1;
            position: relative;
            padding: 0 10px;
        }
        
        .workflow-step .step-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 1.2rem;
            background: #f8f9fa;
            border: 2px solid #dee2e6;
            color: #6c757d;
        }
        
        .workflow-step.active .step-icon {
            background: var(--green);
            border-color: var(--green);
            color: white;
        }
        
        .workflow-step .step-label {
            font-size: 0.85rem;
            font-weight: 600;
        }
        
        .workflow-line {
            position: absolute;
            top: 25px;
            left: 0;
            right: 0;
            height: 2px;
            background: #dee2e6;
            z-index: -1;
        }
        
        .quick-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }
        
        .swal2-popup {
            border-radius: 16px !important;
        }
        
        @media (max-width: 768px) {
            .admin-container {
                padding: 0 1rem;
            }
            
            .admin-header {
                padding: 1.5rem;
            }
            
            .table-custom {
                display: block;
                overflow-x: auto;
            }
            
            .action-btn {
                margin-bottom: 0.5rem;
                width: 100%;
                justify-content: center;
            }
            
            .workflow-step .step-label {
                font-size: 0.7rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-shield-alt me-2"></i>
                Admin Panel
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="fas fa-list me-1"></i> Daftar Laporan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard">
                            <i class="fas fa-home me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link" style="border: none; background: none;">
                                <i class="fas fa-sign-out-alt me-1"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="admin-container">
        <!-- Header -->
        <div class="admin-header">
            <h1 class="admin-title">
                <i class="fas fa-file-alt me-2"></i>
                Daftar Laporan Pengaduan
            </h1>
            <p class="admin-subtitle">
                Kelola dan pantau semua laporan yang masuk dari masyarakat
            </p>
        </div>

        <!-- Workflow Timeline -->
        <div class="workflow-timeline">
            <div class="workflow-line"></div>
            <div class="workflow-step active">
                <div class="step-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="step-label">MENUNGGU</div>
                <div class="text-muted-small">{{ $stats['menunggu'] ?? 0 }} laporan</div>
            </div>
            <div class="workflow-step">
                <div class="step-icon">
                    <i class="fas fa-search"></i>
                </div>
                <div class="step-label">INVESTIGASI</div>
                <div class="text-muted-small">{{ $stats['investigasi'] ?? 0 }} laporan</div>
            </div>
            <div class="workflow-step">
                <div class="step-icon">
                    <i class="fas fa-cogs"></i>
                </div>
                <div class="step-label">DIPROSES</div>
                <div class="text-muted-small">{{ $stats['diproses'] ?? 0 }} laporan</div>
            </div>
            <div class="workflow-step">
                <div class="step-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="step-label">SELESAI</div>
                <div class="text-muted-small">{{ $stats['selesai'] ?? 0 }} laporan</div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stats-card">
                    <div class="stats-icon total">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="stats-number">{{ $stats['total'] ?? 0 }}</div>
                    <div class="stats-label">Total Laporan</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stats-card">
                    <div class="stats-icon menunggu">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stats-number">{{ $stats['menunggu'] ?? 0 }}</div>
                    <div class="stats-label">Menunggu</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stats-card">
                    <div class="stats-icon investigasi">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="stats-number">{{ $stats['investigasi'] ?? 0 }}</div>
                    <div class="stats-label">Investigasi</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stats-card">
                    <div class="stats-icon diproses">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div class="stats-number">{{ $stats['diproses'] ?? 0 }}</div>
                    <div class="stats-label">Diproses</div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="table-container">
            <div class="table-responsive">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Judul</th>
                            <th>Email Pelapor</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Progress</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($laporans as $index => $laporan)
                        @php
                            // AMBIL NAMA STATUS DARI DATABASE - PERBAIKAN
                            $statusName = $laporan->status->name ?? 'Menunggu Verifikasi';
                            $statusColor = $laporan->status->color ?? '#ffc107';
                            $statusId = $laporan->status_id ?? 1;
                            
                            // Hitung progress berdasarkan NAMA STATUS YANG SEBENARNYA
                            $progress = 0;
                            if ($statusName == 'Menunggu Verifikasi') $progress = 20;
                            elseif ($statusName == 'Dalam Investigasi') $progress = 40;
                            elseif ($statusName == 'Diproses') $progress = 70;
                            elseif ($statusName == 'Selesai') $progress = 100;
                        @endphp
                        <tr>
                            <td>
                                <strong>{{ ($laporans->currentPage() - 1) * $laporans->perPage() + $index + 1 }}</strong>
                                @if($laporan->nomor_tiket)
                                <div class="text-muted-small">#{{ $laporan->nomor_tiket }}</div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold">{{ $laporan->title ?? 'Tidak ada judul' }}</div>
                                <div class="text-muted-small mt-1">
                                    {{ Str::limit($laporan->content ?? '', 70) }}
                                </div>
                            </td>
                            <td>{{ $laporan->email ?? 'Tidak ada email' }}</td>
                            <td>
                                <div>{{ \Carbon\Carbon::parse($laporan->created_at)->format('d/m/Y') }}</div>
                                <div class="text-muted-small">
                                    {{ \Carbon\Carbon::parse($laporan->created_at)->format('H:i') }}
                                </div>
                            </td>
                            <td>
                                <span class="status-badge" style="background-color: {{ $statusColor }}20; color: {{ $statusColor }};">
                                    {{ $statusName }}
                                </span>
                            </td>
                            <td>
                                <div class="progress progress-thin">
                                    <div class="progress-bar" 
                                         style="width: {{ $progress }}%; background-color: {{ $statusColor }};"></div>
                                </div>
                                <div class="text-muted-small mt-1">
                                    {{ $progress }}% selesai
                                </div>
                            </td>
                            <td>
                                <div class="quick-actions">
                                    <button class="action-btn detail" onclick="showDetail({{ $laporan->id }})">
                                        <i class="fas fa-eye me-1"></i> Detail
                                    </button>
                                    
                                    <!-- Quick Actions berdasarkan status - PERBAIKAN -->
                                    @if($statusName == 'Menunggu Verifikasi')
                                    <button class="action-btn investigasi" onclick="quickAction({{ $laporan->id }}, 'investigasi')">
                                        <i class="fas fa-search me-1"></i> Investigasi
                                    </button>
                                    @elseif($statusName == 'Dalam Investigasi')
                                    <button class="action-btn proses" onclick="quickAction({{ $laporan->id }}, 'proses')">
                                        <i class="fas fa-play me-1"></i> Proses
                                    </button>
                                    @elseif($statusName == 'Diproses')
                                    <button class="action-btn selesai" onclick="quickAction({{ $laporan->id }}, 'selesai')">
                                        <i class="fas fa-check me-1"></i> Selesai
                                    </button>
                                    @elseif($statusName == 'Selesai')
                                    <span class="badge bg-success p-2">Selesai</span>
                                    @endif
                                    
                                    <!-- Edit manual -->
                                    <button class="action-btn edit" onclick="editStatus({{ $laporan->id }}, '{{ $statusName }}', '{{ $statusId }}')">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-inbox fa-3x mb-3 text-muted"></i>
                                <p class="text-muted">Belum ada laporan yang masuk</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($laporans->hasPages())
            <div class="d-flex justify-content-center mt-4">
                <nav>
                    <ul class="pagination pagination-custom">
                        {{-- Previous Page Link --}}
                        @if ($laporans->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link"><i class="fas fa-chevron-left"></i></span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $laporans->previousPageUrl() }}">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @php
                            $current = $laporans->currentPage();
                            $last = $laporans->lastPage();
                            $start = max($current - 2, 1);
                            $end = min($current + 2, $last);
                        @endphp

                        @if($start > 1)
                            <li class="page-item">
                                <a class="page-link" href="{{ $laporans->url(1) }}">1</a>
                            </li>
                            @if($start > 2)
                                <li class="page-item disabled">
                                    <span class="page-link">...</span>
                                </li>
                            @endif
                        @endif

                        @for ($page = $start; $page <= $end; $page++)
                            @if ($page == $laporans->currentPage())
                                <li class="page-item active">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $laporans->url($page) }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endfor

                        @if($end < $last)
                            @if($end < $last - 1)
                                <li class="page-item disabled">
                                    <span class="page-link">...</span>
                                </li>
                            @endif
                            <li class="page-item">
                                <a class="page-link" href="{{ $laporans->url($last) }}">{{ $last }}</a>
                            </li>
                        @endif

                        {{-- Next Page Link --}}
                        @if ($laporans->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $laporans->nextPageUrl() }}">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link"><i class="fas fa-chevron-right"></i></span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
            @endif
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    // Status mapping
    const statuses = [
        { id: 1, name: 'Menunggu Verifikasi', color: '#ffc107', description: 'Laporan baru, menunggu verifikasi admin' },
        { id: 3, name: 'Dalam Investigasi', color: '#007bff', description: 'Sedang diverifikasi dan diselidiki' },
        { id: 4, name: 'Diproses', color: '#28a745', description: 'Sedang ditangani oleh tim' },
        { id: 5, name: 'Selesai', color: '#6c757d', description: 'Laporan telah selesai ditangani' }
    ];

    // ⭐⭐ FUNGSI UTAMA DENGAN URL YANG BENAR ⭐⭐
    
    // 1. Fungsi untuk menampilkan detail laporan
    async function showDetail(id) {
        try {
            Swal.fire({
                title: 'Memuat data...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // ⭐ URL YANG BENAR SESUAI ROUTE KAMU ⭐
            const response = await fetch(`/admin/laporan/${id}/detail`);
            
            // Cek jika response ok
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const result = await response.json();
            
            Swal.close();
            
            if (result.success) {
                const data = result.data || {};
                
                Swal.fire({
                    title: `Detail Laporan #${data.nomor_tiket || 'TKT-' + id}`,
                    html: `
                        <div class="text-start">
                            <div class="row mb-2">
                                <div class="col-4"><strong>Nomor Tiket:</strong></div>
                                <div class="col-8">${data.nomor_tiket || '-'}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4"><strong>Judul:</strong></div>
                                <div class="col-8">${data.title || '-'}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4"><strong>Email Pelapor:</strong></div>
                                <div class="col-8">${data.email || '-'}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4"><strong>Tanggal Kejadian:</strong></div>
                                <div class="col-8">${data.date || '-'}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4"><strong>Lokasi:</strong></div>
                                <div class="col-8">${data.location || '-'}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4"><strong>Kategori:</strong></div>
                                <div class="col-8">${data.category || '-'}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4"><strong>Status:</strong></div>
                                <div class="col-8">
                                    <span class="badge p-2" style="background-color:${data.status_color || '#ffc107'}20; color:${data.status_color || '#ffc107'}">
                                        ${data.status_name || 'Menunggu Verifikasi'}
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4"><strong>Dibuat:</strong></div>
                                <div class="col-8">${data.created_at || '-'}</div>
                            </div>
                            ${data.completed_at ? `
                            <div class="row mb-2">
                                <div class="col-4"><strong>Selesai:</strong></div>
                                <div class="col-8">${data.completed_at}</div>
                            </div>
                            ` : ''}
                            <hr>
                            <div class="mb-2"><strong>Isi Laporan:</strong></div>
                            <div class="border p-3 bg-light rounded">${data.content || 'Tidak ada konten'}</div>
                            
                            ${data.catatan ? `
                            <hr>
                            <div class="mb-2"><strong>Catatan Admin:</strong></div>
                                <div class="border p-3 bg-light rounded">${data.catatan}</div>
                            ` : ''}
                        </div>
                    `,
                    width: 800,
                    confirmButtonText: 'Tutup',
                    showCloseButton: true,
                    customClass: {
                        popup: 'rounded-3'
                    }
                });
            } else {
                Swal.fire('Error', result.message || 'Gagal memuat data laporan', 'error');
            }
        } catch (error) {
            Swal.close();
            Swal.fire({
                icon: 'error',
                title: 'Gagal Memuat Detail',
                html: `
                    <div class="text-start">
                        <p>URL yang dipanggil: <code>/admin/laporan/${id}/detail</code></p>
                        <p><strong>Error:</strong> ${error.message}</p>
                        <hr>
                        <p class="small">
                            <strong>Pastikan:</strong><br>
                            1. Route <code>/admin/laporan/{id}/detail</code> ada di web.php<br>
                            2. Controller mengembalikan JSON<br>
                            3. ID laporan valid
                        </p>
                    </div>
                `,
                confirmButtonText: 'OK'
            });
            console.error('Detail Error:', error);
        }
    }
    
    // 2. Quick action untuk pindah status
    async function quickAction(id, action) {
        let statusId, statusName;
        
        switch(action) {
            case 'investigasi':
                statusId = 3;
                statusName = 'Dalam Investigasi';
                break;
            case 'proses':
                statusId = 4;
                statusName = 'Diproses';
                break;
            case 'selesai':
                statusId = 5;
                statusName = 'Selesai';
                break;
            default:
                return;
        }
        
        const { value: catatan } = await Swal.fire({
            title: `Pindah ke ${statusName}`,
            input: 'textarea',
            inputLabel: 'Catatan (opsional)',
            inputPlaceholder: 'Masukkan catatan tindakan yang dilakukan...',
            showCancelButton: true,
            confirmButtonText: 'Ya, Pindah Status',
            cancelButtonText: 'Batal'
        });
        
        if (catatan !== undefined) {
            Swal.fire({
                title: 'Menyimpan...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            try {
                // ⭐ URL YANG BENAR SESUAI ROUTE KAMU ⭐
                const response = await fetch(`/admin/laporan/${id}/update-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        status_id: statusId,
                        catatan: catatan || `Dipindah ke ${statusName} via quick action`
                    })
                });
                
                const result = await response.json();
                
                if (result.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: `Status berhasil dipindah ke ${statusName}`,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    
                    setTimeout(() => window.location.reload(), 2000);
                } else {
                    Swal.fire('Error', result.message, 'error');
                }
            } catch (error) {
                Swal.fire('Error', 'Terjadi kesalahan: ' + error.message, 'error');
            }
        }
    }
    
    // 3. Fungsi untuk mengedit status manual
    async function editStatus(id, currentStatusName, currentStatusId) {
        try {
            const { value: formValues } = await Swal.fire({
                title: 'Ubah Status Laporan',
                html: `
                    <div class="text-start">
                        <div class="alert alert-info mb-3">
                            <small>
                                <i class="fas fa-info-circle me-1"></i>
                                <strong>Alur Kerja:</strong> 
                                Menunggu Verifikasi → Investigasi → Diproses → Selesai
                            </small>
                        </div>
                        
                        <label class="form-label">Status Saat Ini:</label>
                        <div class="mb-3">
                            <span class="badge p-2" style="background-color:${statuses.find(s => s.id == currentStatusId)?.color || '#ffc107'}20; 
                                                            color:${statuses.find(s => s.id == currentStatusId)?.color || '#ffc107'}">
                                ${currentStatusName}
                            </span>
                        </div>
                        
                        <label class="form-label">Pilih Status Baru:</label>
                        <select id="statusSelect" class="form-select mb-3">
                            ${statuses.map(status => `
                                <option value="${status.id}" ${status.id == currentStatusId ? 'selected' : ''}>
                                    ${status.name} - ${status.description}
                                </option>
                            `).join('')}
                        </select>
                        
                        <label class="form-label">Catatan Perubahan:</label>
                        <textarea id="catatan" class="form-control" rows="4" 
                                  placeholder="Jelaskan tindakan yang telah/sedang dilakukan..."></textarea>
                    </div>
                `,
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: 'Update Status',
                cancelButtonText: 'Batal',
                preConfirm: () => {
                    const statusSelect = document.getElementById('statusSelect');
                    const catatan = document.getElementById('catatan');
                    
                    if (!statusSelect) {
                        Swal.showValidationMessage('Pilih status terlebih dahulu');
                        return false;
                    }
                    
                    return {
                        status_id: statusSelect.value,
                        catatan: catatan.value || `Status diubah menjadi ${statusSelect.options[statusSelect.selectedIndex].text.split(' - ')[0]}`
                    };
                }
            });
            
            if (formValues) {
                Swal.fire({
                    title: 'Menyimpan...',
                    text: 'Mengupdate status laporan',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // ⭐ URL YANG BENAR SESUAI ROUTE KAMU ⭐
                const response = await fetch(`/admin/laporan/${id}/update-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(formValues)
                });
                
                const result = await response.json();
                
                if (result.success) {
                    const newStatus = statuses.find(s => s.id == formValues.status_id) || statuses[0];
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Status Diperbarui!',
                        html: `
                            <div class="text-center">
                                <div class="mb-3">
                                    <i class="fas fa-check-circle fa-3x text-success"></i>
                                </div>
                                <p>Status berhasil diubah menjadi:</p>
                                <span class="badge p-2 mb-3" style="background-color:${newStatus.color}20; color:${newStatus.color}; font-size: 1.1rem;">
                                    ${newStatus.name}
                                </span>
                            </div>
                        `,
                        timer: 2000,
                        showConfirmButton: false
                    });
                    
                    setTimeout(() => window.location.reload(), 2200);
                } else {
                    Swal.fire('Error', result.message, 'error');
                }
            }
        } catch (error) {
            Swal.fire('Error', 'Terjadi kesalahan: ' + error.message, 'error');
        }
    }
    
    // Auto refresh setiap 30 detik
    setInterval(function() {
        if (document.querySelectorAll('.swal2-show').length === 0) {
            window.location.reload();
        }
    }, 30000);
    
    // CSRF token
    document.addEventListener('DOMContentLoaded', function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>
</body>
</html>