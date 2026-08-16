<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category()
{
    return $this->belongsTo(Category::class);
}

use HasFactory;
 protected $fillable = [
        'name',
        'description',
        'price',
        'stock_quantity',
        'image_url',
        'category_id',
        'user_id',
    ];
}
