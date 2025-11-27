<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'age', 'gender','tel', 'skin_tone','nbrecredit','imgprofil', 'city', 'role','statut','statutcpt',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function blogPosts()
    {
        return $this->hasMany(BlogPost::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

    public function activities()
    {
        return $this->hasMany(UserActivity::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
