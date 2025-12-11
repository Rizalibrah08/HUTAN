<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Report extends Model
{
    protected $fillable = [
        'email',
        'title',
        'content',
        'date',
        'location',
        'category',
        'status_id',
        'verification_token',
        'email_verified_at'
    ];
    
    protected $dates = ['date', 'email_verified_at'];
    
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
}