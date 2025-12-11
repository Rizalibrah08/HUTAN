<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    // Menampilkan semua berita untuk public
   // Update method index di BeritaController
public function index()
{
    $query = Berita::query();
    
    // Filter berdasarkan kategori
    if ($kategori = request('kategori')) {
        $query->where('kategori', $kategori);
    }
    
    $berita = $query->latest()->paginate(6);
    $totalViews = Berita::sum('views');
    
    return view('backend.berita.index', compact('berita', 'totalViews'));
}
    // Menampilkan form tambah berita (hanya admin)
    public function create()
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/berita')->with('error', 'Akses ditolak.');
        }
        
        return view('backend.berita.create');
    }

    // Menyimpan berita baru (hanya admin)
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

    // Menampilkan detail berita
    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        // Tambah view count
        $berita->increment('views');
        
        return view('backend.berita.show', compact('berita'));
    }

    // Edit berita (hanya admin)
    public function edit($id)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/berita')->with('error', 'Akses ditolak.');
        }

        $berita = Berita::findOrFail($id);
        return view('backend.berita.edit', compact('berita'));
    }

    // Update berita (hanya admin)
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

    // Hapus berita (hanya admin)
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

    
}