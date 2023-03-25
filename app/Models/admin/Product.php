<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $fillable = [
        'name_product',
        'description',
        'short_description',
        'info',
        'size',
        'old_price',
        'new_price',
        'thumb',
        'is_active',
        'category_id',
        'image1',
        'image2',
        'image3',
    ];

    public function getRouteKeyName()
    {
        return 'name_product';
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
