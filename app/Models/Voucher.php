<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'code',
        'discount_type',
        'discount_value',
        'expiry_date',
        'usage_limit',
        'used_count'
    ];

    protected $casts = [
        'expiry_date' => 'date',
    ];
}
