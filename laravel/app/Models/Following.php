<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
    use HasFactory;

    /**
     * Define la relación "belongsTo" con el modelo User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
