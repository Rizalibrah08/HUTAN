<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil 4 berita terbaru untuk slider dashboard
        $beritaTerkini = Berita::latest()
            ->take(4)
            ->get();
        
        // Hitung total berita untuk statistik
        $totalBerita = Berita::count();
        
        return view('backend.dashboard.index', compact('beritaTerkini', 'totalBerita'));
    }
}