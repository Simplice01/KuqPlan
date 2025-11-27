<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeletedUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'original_user_id', 'name', 'email', 'other_info', 'deleted_at'
    ];

    public function originalUser()
    {
        return $this->belongsTo(User::class, 'original_user_id');
    }
}
