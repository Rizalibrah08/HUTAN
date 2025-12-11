<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Email Verifikasi Dikirim</title>
    <style>
        .verification-page {
            min-height: 100vh;
            background: linear-gradient(135deg, #E5D9B6 0%, #A4BE7B 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        
        .verification-card {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            max-width: 700px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(40, 84, 48, 0.2);
        }
        
        .verification-icon {
            font-size: 5rem;
            color: #5F8D4E;
            margin-bottom: 2rem;
            text-align: center;
        }
        
        .verification-title {
            color: #285430;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-align: center;
        }
        
        .email-highlight {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 12px;
            padding: 1.5rem;
            margin: 2rem 0;
            border-left: 4px solid #5F8D4E;
            text-align: center;
        }
        
        .email-address {
            font-size: 1.3rem;
            color: #285430;
            font-weight: 600;
            word-break: break-all;
        }
        
        .steps {
            margin: 2rem 0;
        }
        
        .step {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            padding: 1.2rem;
            background: #f8f9fa;
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        
        .step:hover {
            transform: translateX(5px);
            background: #e9ecef;
        }
        
        .step-number {
            width: 40px;
            height: 40px;
            background: #5F8D4E;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 1.5rem;
            flex-shrink: 0;
        }
        
        .step-content h5 {
            color: #285430;
            margin-bottom: 0.3rem;
        }
        
        .step-content p {
            color: #666;
            margin: 0;
        }
        
        .actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 3rem;
            flex-wrap: wrap;
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, #5F8D4E 0%, #285430 100%);
            color: white;
            padding: 1rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            border: none;
            transition: all 0.3s ease;
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(95, 141, 78, 0.3);
        }
        
        .btn-secondary-custom {
            background: #E5D9B6;
            color: #285430;
            padding: 1rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            border: 2px solid #A4BE7B;
            transition: all 0.3s ease;
        }
        
        .btn-secondary-custom:hover {
            background: #A4BE7B;
            color: white;
        }
        
        .alert-testing {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            border: 2px dashed #ffc107;
            border-radius: 12px;
            padding: 1.5rem;
            margin-top: 2rem;
        }
        
        @media (max-width: 768px) {
            .verification-card {
                padding: 2rem;
            }
            
            .verification-title {
                font-size: 2rem;
            }
            
            .actions {
                flex-direction: column;
            }
            
            .btn-primary-custom, 
            .btn-secondary-custom {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    @include('backend.bar.Navbar')
    
    <div class="verification-page">
        <div class="verification-card">
            <div class="verification-icon">
                <i class="fas fa-envelope-circle-check"></i>
            </div>
            
            <h1 class="verification-title">Email Verifikasi Telah Dikirim!</h1>
            
            <p style="text-align: center; font-size: 1.2rem; color: #555; margin-bottom: 2rem;">
                Kami telah mengirimkan email verifikasi ke alamat email Anda.
            </p>
            
            <div class="email-highlight">
                <p style="margin-bottom: 0.5rem; color: #666;">
                    <i class="fas fa-paper-plane"></i> Email dikirim ke:
                </p>
                <div class="email-address">
                    {{ $email }}
                </div>
            </div>
            
            <div class="steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h5><i class="fas fa-inbox"></i> Buka Email Anda</h5>
                        <p>Cek di inbox atau folder spam</p>
                    </div>
                </div>
                
                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h5><i class="fas fa-search"></i> Cari Email Verifikasi</h5>
                        <p>Subjek: "Verifikasi Email Laporan Lingkungan"</p>
                    </div>
                </div>
                
                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h5><i class="fas fa-mouse-pointer"></i> Klik Tombol Verifikasi</h5>
                        <p>Klik tombol "Verifikasi Email Saya" dalam email</p>
                    </div>
                </div>
                
                <div class="step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h5><i class="fas fa-check-circle"></i> Selesai!</h5>
                        <p>Laporan Anda akan diproses setelah verifikasi</p>
                    </div>
                </div>
            </div>
            
            <div class="actions">
                <a href="{{ route('lapor.index') }}" class="btn-primary-custom">
                    <i class="fas fa-plus"></i> Buat Laporan Baru
                </a>
                
                <a href="/" class="btn-secondary-custom">
                    <i class="fas fa-home"></i> Kembali ke Beranda
                </a>
            </div>
            
            @if(session('warning'))
                <div class="alert alert-warning mt-4">
                    <i class="fas fa-exclamation-triangle"></i>
                    {{ session('warning') }}
                </div>
            @endif
            
            <!-- Testing Info -->
            <div class="alert-testing mt-4">
                <h5><i class="fas fa-vial"></i> Informasi Testing</h5>
                <p>Jika email tidak masuk dalam 5 menit:</p>
                <ul>
                    <li>Cek folder <strong>Spam</strong> atau <strong>Promotions</strong></li>
                    <li>Pastikan email yang dimasukkan benar: <strong>{{ $email }}</strong></li>
                    <li>Refresh inbox email Anda</li>
                    <li>Jika masih tidak ada, <a href="mailto:support@lingkungan.com">hubungi support</a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    @include('backend.bar.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>