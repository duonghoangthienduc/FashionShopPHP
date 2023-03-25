<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    protected $fillable = [
        'name_category',
        'parent_id',
        'thumb',
        'is_active'
    ];

    public function getRouteKeyName()
    {
        return 'name_category';
    }

    public function product()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
