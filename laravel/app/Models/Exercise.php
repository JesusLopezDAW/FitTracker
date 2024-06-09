<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Laravel\Scout\Searchable;

class Exercise extends Model
{
    use HasFactory, Searchable;

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

    public function toSearchableArray()
    {
        // Devuelve solo los campos necesarios para la búsqueda
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }

    public function shouldBeSearchable()
    {
        if ($this->visibility === 'global' || Auth::check() && $this->user_id === Auth::id()) {
            return true;
        }
    
        return false;
    }

    public function series()
    {
        return $this->hasMany(Serie::class);
    }
}
