<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'vouchers';

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
        'discount_value' => 'decimal:2'
    ];
}
