<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'name',
        'description',
        'ingredients',
        'instructions',
        'prep_time',
        'cook_time',
        'servings',
        'difficulty',
        'category',
        'image'
    ];
}
