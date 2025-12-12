<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->get('q');
        $kategori = $request->get('kategori');
        
        $beritaQuery = Berita::query();
        
        // Filter berdasarkan pencarian
        if ($query) {
            $beritaQuery->where(function($q) use ($query) {
                $q->where('judul', 'like', '%' . $query . '%')
                  ->orWhere('kategori', 'like', '%' . $query . '%')
                  ->orWhere('excerpt', 'like', '%' . $query . '%')
                  ->orWhere('konten', 'like', '%' . $query . '%');
            });
        }
        
        // Filter berdasarkan kategori
        if ($kategori) {
            $beritaQuery->where('kategori', $kategori);
        }
        
        $berita = $beritaQuery->latest()->paginate(6);
        $totalViews = Berita::sum('views');
        
        return view('backend.berita.index', compact('berita', 'totalViews', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/berita')->with('error', 'Akses ditolak.');
        }
        
        return view('backend.berita.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/berita')->with('error', 'Akses ditolak.');
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'excerpt' => 'required|string|max:200',
            'konten' => 'required|string',
        ]);

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('berita', 'public');
            $validated['gambar'] = $path;
        }

        // Tambah user_id
        $validated['user_id'] = auth()->id();

        Berita::create($validated);

        return redirect('/berita')->with('success', 'Berita berhasil ditambahkan!');
    }

    /**
     * Display the specified resource. - METHOD INI YANG HILANG!
     */
    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        // Tambah view count
        $berita->increment('views');
        
        return view('backend.berita.show', compact('berita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/berita')->with('error', 'Akses ditolak.');
        }

        $berita = Berita::findOrFail($id);
        return view('backend.berita.edit', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/berita')->with('error', 'Akses ditolak.');
        }

        $berita = Berita::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'excerpt' => 'required|string|max:200',
            'konten' => 'required|string',
        ]);

        // Handle file upload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            
            $path = $request->file('gambar')->store('berita', 'public');
            $validated['gambar'] = $path;
        }

        $berita->update($validated);

        return redirect('/berita')->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return response()->json(['error' => 'Akses ditolak.'], 403);
        }

        $berita = Berita::findOrFail($id);
        
        // Hapus gambar jika ada
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }
        
        $berita->delete();

        return response()->json(['success' => 'Berita berhasil dihapus.']);
    }

    /**
     * Search suggestions for autocomplete
     */
    public function searchSuggest(Request $request)
    {
        $query = $request->get('q');
        
        if (empty($query) || strlen($query) < 2) {
            return response()->json(['success' => true, 'berita' => []]);
        }
        
        try {
            $berita = Berita::where(function($q) use ($query) {
                    $q->where('judul', 'like', '%' . $query . '%')
                      ->orWhere('kategori', 'like', '%' . $query . '%')
                      ->orWhere('excerpt', 'like', '%' . $query . '%');
                })
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
            
            return response()->json([
                'success' => true,
                'berita' => $berita
            ]);
            
        } catch (\Exception $e) {
            Log::error('Search error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mencari',
                'berita' => []
            ], 500);
        }
    }

    /**
     * Full search results page
     */
    public function search(Request $request)
    {
        return $this->index($request); // Reuse index method
    }
}