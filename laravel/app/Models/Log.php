<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'workout_id',
        'user_id',
        'start_date',
        'end_date',
        'duration',
        'volume',
        'records',
        'calories_burned',
    ];

    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
