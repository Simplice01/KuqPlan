<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeletedMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'file_path', 'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
