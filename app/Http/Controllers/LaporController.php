<?php
namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ReportStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ReportVerificationEmail;
use Symfony\Component\Mime\Email;

class LaporController extends Controller
{
    public function index()
    {
        return view('backend.lapor.index');
    }
    
public function store(Request $request)
{
    // Validasi
    $validated = $request->validate([
        'email' => 'required|email|max:255',
        'judul' => 'required|string|max:255',
        'isi' => 'required|string|min:100',
        'tanggal' => 'required|date',
        'lokasi' => 'required|string|max:500',
        'kategori' => 'required|string',
    ]);
    
    // Buat report
    $report = Report::create([
        'email' => $validated['email'],
        'title' => $validated['judul'],
        'content' => $validated['isi'],
        'date' => $validated['tanggal'],
        'location' => $validated['lokasi'],
        'category' => $validated['kategori'],
        'status_id' => 1,
        'verification_token' => \Illuminate\Support\Str::random(64),
        'email_verified_at' => null
    ]);
    
    // ⭐ SIMPLE EMAIL SEND - NO TRY CATCH ⭐
    $verificationUrl = route('lapor.verify', $report->verification_token);
    
    Mail::send([], [], function ($message) use ($report, $verificationUrl) {
        $message->to($report->email)
                ->subject('Verifikasi Email Laporan - ' . $report->title)
                ->from('lomon189@gmail.com', 'Layanan Pengaduan Lingkungan')
                ->html("
                    <h1>Verifikasi Email Laporan</h1>
                    <p>Halo, terima kasih telah mengirim laporan.</p>
                    <p><strong>Judul:</strong> {$report->title}</p>
                    <p><strong>Tanggal:</strong> {$report->date}</p>
                    <p>Klik link berikut untuk verifikasi:</p>
                    <p><a href='{$verificationUrl}'>{$verificationUrl}</a></p>
                ");
    });
    
    // Redirect
    return redirect()->route('lapor.verifikasi.dikirim')
                    ->with('success', 'Laporan berhasil!')
                    ->with('email', $report->email);
}
    
    public function verificationSent()
    {
        // Ambil data dari session
        $email = session('report_email', session('email', 'Alamat email Anda'));
        $title = session('report_title', 'Laporan Anda');
        
        return view('backend.lapor.verifikasi-dikirim', compact('email', 'title'));
    }
    
    public function verify($token)
    {
        $report = Report::where('verification_token', $token)->first();
        
        if (!$report) {
            return redirect()->route('lapor.index')
                            ->with('error', 'Token verifikasi tidak valid atau telah kadaluarsa.');
        }
        
        if ($report->email_verified_at) {
            return redirect()->route('lapor.index')
                            ->with('info', 'Email sudah diverifikasi sebelumnya.');
        }
        
        // Update status ke "Terverifikasi"
        $verifiedStatus = ReportStatus::where('name', 'Terverifikasi')->first();
        
        $report->update([
            'email_verified_at' => now(),
            'verification_token' => null,
            'status_id' => $verifiedStatus ? $verifiedStatus->id : 2
        ]);
        
        return view('backend.lapor.verifikasi-sukses', compact('report'));
    }
}