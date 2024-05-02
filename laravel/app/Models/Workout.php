<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;
    /**
     * Get the user that owns the routine.
     */
    public function routine()
    {
        return $this->belongsTo(Routine::class);
    }
}
