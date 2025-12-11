<?php

namespace App\Http\Controllers\Admin;  // PERHATIKAN: namespace Admin

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Berita;
use App\Models\User;

class DashboardController extends Controller  // NAMA CLASS SAMA
{
    public function index()
    {
        // Cek jika user adalah admin
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'Akses ditolak.');
        }

        // Ambil data statistik
        $stats = [
            'total_reports' => Report::count(),
            'new_reports' => Report::whereDate('created_at', today())->count(),
            'pending_reports' => Report::where('status', 'pending')->count(),
            'completed_reports' => Report::where('status', 'completed')->count(),
            'total_news' => Berita::count(),
            'total_users' => User::count(),
        ];

        $recentReports = Report::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentReports'));
    }
}