<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportStatus extends Model
{
    protected $fillable = ['name', 'color'];
    
    // Relationship
    public function reports()
    {
        return $this->hasMany(Report::class, 'status_id');
    }
}