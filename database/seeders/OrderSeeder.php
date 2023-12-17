<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            'user_id' => 2,
            'product_id' => 1,
            'variant_id' => 1,
            'quantity' => 5,
            'order_price' => 5000
        ]);
    }
}