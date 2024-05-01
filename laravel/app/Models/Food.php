<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $fillable = [
        'calories',
        'total_fat_g',
        'name',
        'saturated_fat_g',
        'protein_g',
        'sodium_mg',
        'potassium_mg',
        'carbohydrate_total_g',
        'size_portion_g',
        'fiber_g',
        'sugar_g',
    ];
}
