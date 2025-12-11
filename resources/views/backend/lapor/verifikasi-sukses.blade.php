<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Verifikasi Berhasil</title>
    <style>
        .success-page {
            min-height: 100vh;
            background: linear-gradient(135deg, #E5D9B6 0%, #A4BE7B 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        
        .success-card {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(40, 84, 48, 0.2);
            text-align: center;
        }
        
        .success-icon {
            font-size: 5rem;
            color: #28a745;
            margin-bottom: 2rem;
            animation: bounce 1s infinite alternate;
        }
        
        @keyframes bounce {
            from { transform: translateY(0); }
            to { transform: translateY(-20px); }
        }
        
        .success-title {
            color: #285430;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .report-info {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
            text-align: left;
        }
        
        .info-item {
            display: flex;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #dee2e6;
        }
        
        .info-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .info-label {
            font-weight: 600;
            color: #285430;
            min-width: 150px;
        }
        
        .info-value {
            color: #444;
            flex: 1;
        }
        
        .status-badge {
            background: #17a2b8;
            color: white;
            padding: 0.3rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        
        .actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
            flex-wrap: wrap;
        }
        
        .btn-success-custom {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            border: none;
            transition: all 0.3s ease;
        }
        
        .btn-success-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(40, 167, 69, 0.3);
        }
        
        @media (max-width: 768px) {
            .success-card {
                padding: 2rem;
            }
            
            .success-title {
                font-size: 2rem;
            }
            
            .info-item {
                flex-direction: column;
            }
            
            .info-label {
                margin-bottom: 0.5rem;
            }
            
            .actions {
                flex-direction: column;
            }
            
            .btn-success-custom {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    @include('backend.bar.Navbar')
    
    <div class="success-page">
        <div class="success-card">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            
            <h1 class="success-title">🎉 Verifikasi Berhasil!</h1>
            
            <p style="font-size: 1.2rem; color: #555; margin-bottom: 2rem;">
                Email Anda telah berhasil diverifikasi. Laporan Anda sekarang akan diproses oleh tim kami.
            </p>
            
            <div class="report-info">
                <h4 style="color: #285430; margin-bottom: 1.5rem;">
                    <i class="fas fa-file-alt me-2"></i>Detail Laporan Anda:
                </h4>
                
                <div class="info-item">
                    <div class="info-label">Nomor Laporan:</div>
                    <div class="info-value">#{{ str_pad($report->id, 6, '0', STR_PAD_LEFT) }}</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">Judul:</div>
                    <div class="info-value">{{ $report->title }}</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">Tanggal:</div>
                    <div class="info-value">{{ date('d F Y', strtotime($report->date)) }}</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">Lokasi:</div>
                    <div class="info-value">{{ $report->location }}</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">Kategori:</div>
                    <div class="info-value">{{ $report->category }}</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">Status:</div>
                    <div class="info-value">
                        <span class="status-badge">Terverifikasi</span>
                    </div>
                </div>
            </div>
            
            <p style="color: #666; margin-bottom: 2rem;">
                <i class="fas fa-info-circle me-1"></i>
                Anda akan mendapatkan update via email saat laporan Anda ditindaklanjuti.
            </p>
            
            <div class="actions">
                <a href="{{ route('lapor.index') }}" class="btn-success-custom">
                    <i class="fas fa-plus"></i> Buat Laporan Lain
                </a>
                
                <a href="/" class="btn" style="padding: 1rem 2rem; color: #285430; text-decoration: none; font-weight: 600;">
                    <i class="fas fa-home"></i> Kembali ke Beranda
                </a>
            </div>
            
            <p style="margin-top: 3rem; color: #777; font-size: 0.9rem; border-top: 1px solid #eee; padding-top: 1.5rem;">
                <i class="fas fa-shield-alt me-1"></i>
                <strong>Keamanan:</strong> Identitas Anda akan kami rahasiakan sesuai dengan kebijakan privasi kami.
            </p>
        </div>
    </div>
    
    <!-- Footer -->
    @include('backend.bar.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>