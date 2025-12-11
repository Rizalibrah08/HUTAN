<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\ReportStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporController extends Controller
{
    public function __construct()
    {
        // Hanya admin yang bisa akses
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role !== 'admin') {
                return redirect('/')->with('error', 'Akses ditolak!');
            }
            return $next($request);
        });
    }
    
    /**
     * Menampilkan semua laporan
     */
    public function index(Request $request)
    {
        // Filter parameter
    $status = $request->get('status');
    $search = $request->get('search');
    $date_from = $request->get('date_from');
    $date_to = $request->get('date_to');
    
    // Query laporan
    $reports = Report::with('status')
        ->when($status, function ($query) use ($status) {
            return $query->where('status_id', $status);
        })
        ->when($search, function ($query) use ($search) {
            return $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        })
        ->when($date_from, function ($query) use ($date_from) {
            return $query->where('date', '>=', $date_from);
        })
        ->when($date_to, function ($query) use ($date_to) {
            return $query->where('date', '<=', $date_to);
        })
        ->orderBy('created_at', 'desc')  // ← PERBAIKI: orderBy bukan orderBy
        ->paginate(20);
    
    // Get all statuses for filter dropdown
    $statuses = ReportStatus::all();
    
    // Statistics
    $stats = [
        'total' => Report::count(),
        'pending' => Report::where('status_id', 1)->count(),
        'verified' => Report::where('status_id', 2)->count(),
        'investigation' => Report::where('status_id', 3)->count(),
        'processed' => Report::where('status_id', 4)->count(),
        'completed' => Report::where('status_id', 5)->count(),
        'rejected' => Report::where('status_id', 6)->count(),
    ];
    
    return view('backend.lapor.adminindex', compact('reports', 'statuses', 'stats'));

    }
    
    /**
     * Update status laporan
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status_id' => 'required|exists:report_statuses,id',
            'admin_notes' => 'nullable|string|max:1000',
        ]);
        
        $report = Report::findOrFail($id);
        
        $report->update([
            'status_id' => $request->status_id,
            'admin_notes' => $request->admin_notes,
        ]);
        
        return redirect()->route('admin.laporan.show', $id)
                        ->with('success', 'Status laporan berhasil diperbarui.');
    }
    
    /**
     * Hapus laporan
     */
    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();
        
        return redirect()->route('admin.laporan.index')
                        ->with('success', 'Laporan berhasil dihapus.');
    }
    
    /**
     * Export laporan ke CSV
     */
    public function export(Request $request)
    {
        $reports = Report::with('status')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $filename = 'laporan-' . date('Y-m-d-H-i') . '.csv';
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        // Header CSV
        fputcsv($output, [
            'ID', 'Email', 'Judul', 'Isi', 'Tanggal Kejadian', 'Lokasi', 
            'Kategori', 'Status', 'Tanggal Verifikasi Email', 'Tanggal Dibuat'
        ]);
        
        // Data
        foreach ($reports as $report) {
            fputcsv($output, [
                $report->id,
                $report->email,
                $report->title,
                substr($report->content, 0, 200), // Ambil 200 karakter pertama
                $report->date,
                $report->location,
                $report->category,
                $report->status->name,
                $report->email_verified_at ? $report->email_verified_at->format('Y-m-d H:i') : 'Belum',
                $report->created_at->format('Y-m-d H:i')
            ]);
        }
        
        fclose($output);
        exit;
    }
    
    /**
     * Dashboard statistic
     */
    public function dashboard()
    {
        // Total laporan per bulan (6 bulan terakhir)
        $monthlyReports = Report::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
        
        // Laporan per kategori
        $categoryReports = Report::select('category', DB::raw('COUNT(*) as total'))
            ->groupBy('category')
            ->orderBy('total', 'desc')
            ->get();
        
        // Laporan per status
        $statusReports = Report::select('status_id', DB::raw('COUNT(*) as total'))
            ->groupBy('status_id')
            ->with('status')
            ->get();
        
        // Recent reports
        $recentReports = Report::with('status')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        return view('admin.lapor.dashboard', compact(
            'monthlyReports', 
            'categoryReports', 
            'statusReports',
            'recentReports'
        ));
    }
}