<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Report extends Model
{
    protected $table = 'reports';
    
    // app/Models/Report.php
protected $fillable = [
    'nomor_tiket', 'email', 'title', 'content', 
    'date', 'location', 'category', 'status_id',
    'verification_token', 'email_verified_at',
    'admin_notes', 'completed_at', 'attachment'
];

    
    protected $dates = ['date', 'email_verified_at'];

    public static function boot()
{
    parent::boot();
    
    static::creating(function ($report) {
        if (!$report->nomor_tiket) {
            $report->nomor_tiket = 'TKT-' . date('Ymd') . '-' . str_pad(static::count() + 1, 4, '0', STR_PAD_LEFT);
        }
    });
}

    
    // Relationship
    public function status()
    {
        return $this->belongsTo(ReportStatus::class, 'status_id');
    }
    
    // Generate token
    public static function generateVerificationToken()
    {
        return Str::random(64);
    }
    
    // Check if verified
    public function isVerified()
    {
        return !is_null($this->email_verified_at);
    }
    
    // Format date
    public function getFormattedDateAttribute()
    {
        return $this->date->format('d F Y');
    }

    public function getStatusNameAttribute()
    {
        return $this->status ? $this->status->name : 'menunggu';
    }
}