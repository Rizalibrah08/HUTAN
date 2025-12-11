<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relationships
    public function reports()
    {
        return $this->hasMany(Report::class, 'assigned_admin_id');
    }

    public function news()
    {
        return $this->hasMany(News::class, 'author_id');
    }

    public function statusChanges()
    {
        return $this->hasMany(ReportStatus::class, 'changed_by');
    }

    // Scopes
    public function scopeAdmins($query)
    {
        return $query->whereIn('role', ['admin', 'super_admin']);
    }

    // Helpers
    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }

    public function isAdmin()
    {
        return in_array($this->role, ['admin', 'super_admin']);
    }
}