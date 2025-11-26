<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Voucher;
use Carbon\Carbon;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Voucher::create([
            'code' => 'HEALTH2025',
            'discount_type' => 'percent',
            'discount_value' => 20, // 20% off
            'expiry_date' => Carbon::now()->addMonths(1),
            'usage_limit' => 100,
            'used_count' => 0
        ]);

        Voucher::create([
            'code' => 'WELCOME50K',
            'discount_type' => 'fixed',
            'discount_value' => 50000, // 50k off
            'expiry_date' => Carbon::now()->addMonths(1),
            'usage_limit' => 100,
            'used_count' => 0
        ]);
    }
}
