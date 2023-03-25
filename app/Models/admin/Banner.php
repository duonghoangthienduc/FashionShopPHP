<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Banner extends Model
{
    use HasFactory;
    protected $table = 'banner';

    protected $fillable = [
        'name_banner',
        'banner_content',
        'number_sort',
        'thumb',
        'is_active'
    ];
    public function getRouteKeyName()
    {
        return 'name_banner';
    }
}
