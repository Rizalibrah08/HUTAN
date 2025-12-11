<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'views' => 'integer'
    ];

    // Relasi dengan user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessor untuk URL gambar
    public function getGambarUrlAttribute()
    {
        if ($this->gambar) {
            return asset('storage/' . $this->gambar);
        }
        return 'https://images.unsplash.com/photo-1611273426858-450d8e3c9fce?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
    }

    // Format tanggal
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d M Y');
    }
}