<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $table = 'bill';

    protected $fillable = [
        'address',
        'province_id',
        'district_id',
        'ward_id',
        'note',
        'prod_id',
        'prod_qty',
        'prod_price',
        'prod_size',
        'status',
    ];
}
