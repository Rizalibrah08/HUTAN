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

    public function __construct()
    {
        // Middleware admin hanya untuk method laporan
        $this->middleware('admin')->only('laporan');
    }

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

    // ===== METHOD BARU/TAMBAHAN UNTUK ADMIN =====
    public function laporan()
    {
        // Ambil semua laporan dengan status, urutkan terbaru
        $laporans = Report::with('status') // Menggunakan 'status' bukan 'user'
            ->orderBy('created_at', 'desc')
            ->paginate(10);

    // Hitung statistik
     // Di LaporController, method laporan()
$stats = [
    'total' => Report::count(),
    'menunggu' => Report::whereHas('status', function($q) {
        $q->where('name', 'Menunggu');
    })->count(),
    'investigasi' => Report::whereHas('status', function($q) {
        $q->where('name', 'Dalam Investigasi');
    })->count(),
    'diproses' => Report::whereHas('status', function($q) {
        $q->where('name', 'Diproses');
    })->count(),
    'selesai' => Report::whereHas('status', function($q) {
        $q->where('name', 'Selesai');
    })->count(),
];
    
    // Ambil semua status untuk dropdown
    $allStatuses = \App\Models\ReportStatus::orderBy('sort_order', 'asc')->get();
    
    return view('backend.lapor.laporan', compact('laporans', 'stats', 'allStatuses'));
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

    // Method untuk detail (JSON response)
public function show($id)
{
    try {
        // Gunakan find() bukan findOrFail() untuk menghindari exception
        $laporan = Report::with('status')->find($id);
        
        if (!$laporan) {
            return response()->json([
                'success' => false,
                'message' => 'Laporan tidak ditemukan'
            ], 404);
        }
        
        // DEBUG: Cek data
        Log::info('Laporan Data:', [
            'id' => $laporan->id,
            'status_id' => $laporan->status_id,
            'status_relation' => $laporan->status ? 'exists' : 'null'
        ]);
        
        // Handle jika status null
        $statusName = 'Menunggu Verifikasi';
        $statusColor = '#ffc107';
        
        if ($laporan->status) {
            $statusName = $laporan->status->name;
            $statusColor = $laporan->status->color;
        } else {
            // Fallback: cari status langsung dari database
            $status = \App\Models\ReportStatus::find($laporan->status_id);
            if ($status) {
                $statusName = $status->name;
                $statusColor = $status->color;
            }
        }
        
        // Data dengan null safety
        $data = [
            'id' => $laporan->id,
            'nomor_tiket' => $laporan->nomor_tiket ?? 'TKT-' . $laporan->id,
            'title' => $laporan->title ?? 'Tidak ada judul',
            'email' => $laporan->email ?? 'Tidak ada email',
            'date' => $laporan->date ?? '-',
            'location' => $laporan->location ?? '-',
            'category' => $laporan->category ?? '-',
            'content' => $laporan->content ?? 'Tidak ada konten',
            'status_name' => $statusName,
            'status_color' => $statusColor,
            'status_id' => $laporan->status_id,
            'catatan' => $laporan->admin_notes ?? null,
            'lampiran' => $laporan->attachment ?? null,
            'created_at' => $laporan->created_at ? $laporan->created_at->format('d/m/Y H:i') : '-',
            'completed_at' => $laporan->completed_at ? $laporan->completed_at->format('d/m/Y H:i') : null,
        ];
        
        return response()->json([
            'success' => true,
            'data' => $data,
            'debug' => [
                'status_relation_exists' => $laporan->status ? true : false,
                'status_id_in_db' => $laporan->status_id
            ]
        ]);
        
    } catch (\Exception $e) {
        Log::error('LaporController show error: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString()
        ]);
        
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
        ], 500);
    }
}

// Ganti validasi di method updateStatus():
public function updateStatus(Request $request, $id)
{
    try {
        // DAPATKAN MAX STATUS ID DARI DATABASE (DINAMIS)
        $maxStatusId = \App\Models\ReportStatus::max('id');
        
        $request->validate([
            'status_id' => "required|integer|min:1|max:{$maxStatusId}", // DINAMIS
            'catatan' => 'nullable|string|max:500'
        ]);
        
        $laporan = Report::findOrFail($id);
        $oldStatus = $laporan->status_id;
        
        // Update status
        $laporan->status_id = $request->status_id;
        
        // Tambahkan catatan jika ada
        if ($request->catatan) {
            $currentNotes = $laporan->admin_notes ? $laporan->admin_notes . "\n\n" : '';
            $laporan->admin_notes = $currentNotes . date('d/m/Y H:i') . " - " . $request->catatan;
        }
        
        // Cek status Selesai berdasarkan NAMA, bukan ID
        $selesaiStatus = \App\Models\ReportStatus::where('name', 'Selesai')->first();
        
        if ($selesaiStatus && $request->status_id == $selesaiStatus->id && $oldStatus != $selesaiStatus->id) {
            $laporan->completed_at = now();
            
            // Kirim email notifikasi ke pelapor
            Mail::send([], [], function ($message) use ($laporan) {
                $message->to($laporan->email)
                        ->subject('Laporan Anda Telah Selesai - ' . $laporan->title)
                        ->from('lomon189@gmail.com', 'Layanan Pengaduan Lingkungan')
                        ->html("
                            <h1>Laporan Telah Selesai Ditangani</h1>
                            <p>Halo, laporan Anda telah selesai ditangani oleh tim kami.</p>
                            <p><strong>Judul:</strong> {$laporan->title}</p>
                            <p><strong>Nomor Tiket:</strong> {$laporan->nomor_tiket}</p>
                            <p><strong>Tanggal Selesai:</strong> " . now()->format('d/m/Y') . "</p>
                            <p>Terima kasih telah melaporkan masalah ini.</p>
                        ");
            });
        }
        
        $laporan->save();
        
        // Log aktivitas
        Log::info('Admin mengubah status laporan', [
            'laporan_id' => $id,
            'old_status' => $oldStatus,
            'new_status' => $request->status_id,
            'admin_id' => auth()->id(),
            'catatan' => $request->catatan ? 'Ya' : 'Tidak'
        ]);
        
        return response()->json([
            'success' => true, 
            'message' => 'Status berhasil diperbarui',
            'status_name' => $laporan->status->name,
            'status_color' => $laporan->status->color
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ], 500);
    }
}
}