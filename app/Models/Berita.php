<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'kategori',
        'gambar',
        'excerpt',
        'konten',
        'user_id',
        'views'
    ];

    protected $casts = [
        'views' => 'integer',
        'created_at' => 'datetime'
    ];

    // Relasi dengan user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessor untuk URL gambar
    public function getGambarUrlAttribute()
    {
        if ($this->gambar && Storage::disk('public')->exists($this->gambar)) {
            return asset('storage/' . $this->gambar);
        }
        
        // Array gambar placeholder dengan tema lingkungan
        $placeholders = [
            'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09',
            'https://images.unsplash.com/photo-1441974231531-c6227db76b6e',
            'https://images.unsplash.com/photo-1425913397330-cf8af2ff40a1',
            'https://images.unsplash.com/photo-1501854140801-50d01698950b',
            'https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05'
        ];
        
        // Gunakan placeholder berdasarkan ID
        $index = $this->id ? ($this->id % count($placeholders)) : 0;
        return $placeholders[$index] . '?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80';
    }

    // Format tanggal Indonesia
    public function getFormattedDateAttribute()
    {
        $months = [
            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
            'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
        ];
        
        $month = $months[$this->created_at->format('n') - 1];
        return $this->created_at->format('d') . ' ' . $month . ' ' . $this->created_at->format('Y');
    }

    // Ambil excerpt otomatis jika tidak diisi
    public function getExcerptAttribute($value)
    {
        if ($value) {
            return $value;
        }
        return Str::limit(strip_tags($this->konten), 150);
    }
}