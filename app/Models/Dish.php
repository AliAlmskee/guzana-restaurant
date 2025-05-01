<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'photo', 'category_id'];
    protected $casts = [
        'name' => 'array' ,
        'description' => 'array' 
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
