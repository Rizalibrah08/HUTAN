<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email Laporan</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #285430 0%, #5F8D4E 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 40px;
        }
        .info-box {
            background: #f8f9fa;
            border-left: 4px solid #5F8D4E;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .btn-verify {
            display: inline-block;
            background: linear-gradient(135deg, #5F8D4E 0%, #285430 100%);
            color: white;
            text-decoration: none;
            padding: 14px 32px;
            border-radius: 8px;
            font-weight: bold;
            margin: 20px 0;
            text-align: center;
            border: none;
            cursor: pointer;
        }
        .footer {
            background: #e9ecef;
            padding: 20px;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
        }
        .token-box {
            background: #f1f8e9;
            padding: 15px;
            border-radius: 5px;
            word-break: break-all;
            font-family: monospace;
            font-size: 12px;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🌿 Layanan Pengaduan Lingkungan</h1>
            <p>Verifikasi Email Laporan Anda</p>
        </div>
        
        <div class="content">
            <p>Halo,</p>
            <p>Terima kasih telah mengirim laporan lingkungan melalui sistem kami. Untuk melanjutkan proses laporan, kami perlu memverifikasi bahwa email ini valid.</p>
            
            <div class="info-box">
                <h3 style="margin-top: 0; color: #285430;">📝 Detail Laporan Anda:</h3>
                <p><strong>Judul:</strong> {{ $report->title }}</p>
                <p><strong>Tanggal Kejadian:</strong> {{ date('d F Y', strtotime($report->date)) }}</p>
                <p><strong>Lokasi:</strong> {{ $report->location }}</p>
                <p><strong>Kategori:</strong> {{ $report->category }}</p>
                <p><strong>Status:</strong> Menunggu Verifikasi</p>
            </div>
            
            <p>Silakan klik tombol di bawah ini untuk verifikasi email:</p>
            
            <div style="text-align: center;">
                <a href="{{ $verificationUrl }}" class="btn-verify">
                    ✅ VERIFIKASI EMAIL SAYA
                </a>
            </div>
            
            <p>Atau salin tautan berikut ke browser Anda:</p>
            <div class="token-box">
                {{ $verificationUrl }}
            </div>
            
            <p style="color: #dc3545; font-size: 14px;">
                ⚠️ <strong>Penting:</strong> Tautan verifikasi akan kadaluarsa dalam 24 jam.
            </p>
            
            <p>Jika Anda tidak merasa mengirim laporan ini, silakan abaikan email ini.</p>
            
            <p>Terima kasih atas partisipasi Anda dalam menjaga lingkungan.</p>
            
            <p>Salam,<br>
            <strong>Tim Layanan Pengaduan Lingkungan</strong></p>
        </div>
        
        <div class="footer">
            <p>© {{ $currentYear }} Layanan Pengaduan Lingkungan</p>
            <p>Email ini dikirim otomatis, mohon tidak membalas.</p>
        </div>
    </div>
</body>
</html>