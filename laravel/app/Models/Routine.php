<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    use HasFactory;
    /**
     * Get the user that owns the routine.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the workouts for the user.
     */
    public function workouts()
    {
        return $this->hasMany(Workout::class);
    }
}
