<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'visibility',
        'name',
        'type',
        'muscle',
        'equipment',
        'difficulty',
        'instructions',
        'extra_info',
        'image',
        'image2',
        'video'
    ];

    protected $hidden = [
 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
