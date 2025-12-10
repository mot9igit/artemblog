<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_categories')->insert(['title' => 'Электроинструмент']);                              // 1
        DB::table('product_categories')->insert(['title' => 'Садовая техника']);                                // 2
        DB::table('product_categories')->insert(['title' => 'Шуруповерты', 'parent_id' => '1']);                // 3
        DB::table('product_categories')->insert(['title' => 'Аккумуляторные шуруповерты', 'parent_id' => '3']); // 4
        DB::table('product_categories')->insert(['title' => 'Сетевые шуруповерты', 'parent_id' => '3']);        // 5
        DB::table('product_categories')->insert(['title' => 'Дрели', 'parent_id' => '1']);                      // 6
        DB::table('product_categories')->insert(['title' => 'Аккумуляторные дрели', 'parent_id' => '6']);       // 7
        DB::table('product_categories')->insert(['title' => 'Сетевые дрели', 'parent_id' => '6']);              // 8
        DB::table('product_categories')->insert(['title' => 'Триммеры', 'parent_id' => '2']);                   // 9
        DB::table('product_categories')->insert(['title' => 'Газонокосилки', 'parent_id' => '2']);              // 10
        DB::table('product_categories')->insert(['title' => 'Цепные пилы', 'parent_id' => '2']);                // 11
        DB::table('product_categories')->insert(['title' => 'Сетевые пилы', 'parent_id' => '11']);              // 12
        DB::table('product_categories')->insert(['title' => 'Аккумуляторные пилы', 'parent_id' => '11']);       // 13
        DB::table('product_categories')->insert(['title' => 'Бензопилы', 'parent_id' => '11']);                 // 14
    }
}
