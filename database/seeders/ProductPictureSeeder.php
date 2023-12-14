<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductPictureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_pictures')->insert([
            'picture' => 'belum diupload kak sabar',
            'product_id' => 2
        ]);
        DB::table('product_pictures')->insert([
            'picture' => 'sama juga kak',
            'product_id' => 1
        ]);
    }
}
