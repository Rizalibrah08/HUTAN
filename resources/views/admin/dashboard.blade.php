<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Dashboard Admin - Lapor Pak</title>
    <style>
        /* Hanya tambah style untuk admin dashboard saja */
        .admin-body {
            background: #f8f9fa;
            min-height: 100vh;
        }
        
        .admin-content {
            margin-top: 85px;
            padding: 2rem;
        }
        
        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            border-left: 4px solid var(--green);
            margin-bottom: 1rem;
        }
        
        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            color: var(--dark-green);
        }
        
        .stat-label {
            color: #666;
            font-size: 0.9rem;
        }
        
        .recent-list {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }
        
        .list-item {
            padding: 0.8rem 0;
            border-bottom: 1px solid #eee;
        }
        
        .list-item:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body class="admin-body">
    <!-- Navbar SAMA dengan yang di dashboard user -->
    @include('backend.bar.Navbar')
    
    <div class="admin-content">
        <div class="container">
            <h1 class="mb-4">Dashboard Admin</h1>
            
            <!-- Stats Row -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-value">{{ $stats['total_reports'] ?? 0 }}</div>
                        <div class="stat-label">Total Laporan</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-value">{{ $stats['new_reports'] ?? 0 }}</div>
                        <div class="stat-label">Laporan Hari Ini</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-value">{{ $stats['pending_reports'] ?? 0 }}</div>
                        <div class="stat-label">Dalam Proses</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-value">{{ $stats['completed_reports'] ?? 0 }}</div>
                        <div class="stat-label">Selesai</div>
                    </div>
                </div>
            </div>
            
            <!-- Content Row -->
            <div class="row">
                <div class="col-md-8">
                    <div class="recent-list">
                        <h5 class="mb-3">Laporan Terbaru</h5>
                        @if($recentReports->count() > 0)
                            @foreach($recentReports as $report)
                            <div class="list-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <strong>{{ $report->title }}</strong>
                                        <div class="text-muted small">
                                            {{ $report->email }} • {{ $report->created_at->format('d M Y') }}
                                        </div>
                                    </div>
                                    <span class="badge bg-{{ $report->status === 'pending' ? 'warning' : ($report->status === 'processing' ? 'info' : 'success') }}">
                                        {{ ucfirst($report->status) }}
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <p class="text-muted">Belum ada laporan</p>
                        @endif
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="recent-list">
                        <h5 class="mb-3">Quick Actions</h5>
                        <div class="d-grid gap-2">
                            <a href="/admin/laporan" class="btn btn-primary">
                                <i class="fas fa-list me-2"></i> Kelola Laporan
                            </a>
                            <a href="/admin/berita" class="btn btn-success">
                                <i class="fas fa-newspaper me-2"></i> Kelola Berita
                            </a>
                            <a href="/admin/users" class="btn btn-info">
                                <i class="fas fa-users me-2"></i> Kelola User
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>