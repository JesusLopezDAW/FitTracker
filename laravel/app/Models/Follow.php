<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'followed_user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function followedUser()
    {
        return $this->belongsTo(User::class, 'followed_user_id');
    }
}