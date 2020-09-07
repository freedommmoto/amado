<?php

use Illuminate\Database\Seeder;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('products')->insert([
            'name' => 'A1',
            'stock' => 1,
            'price' => 120,
        ]);
        DB::table('products')->insert([
            'name' => 'A2',
            'stock' => 0,
            'price' => 98,
        ]);
        DB::table('products')->insert([
            'name' => 'A3',
            'stock' => 0,
            'price' => 125,
        ]);
        DB::table('products')->insert([
            'name' => 'A4',
            'stock' => 1,
            'price' => 235,
        ]);
        DB::table('products')->insert([
            'name' => 'A5',
            'stock' => 1,
            'price' => 145,
        ]);
        DB::table('products')->insert([
            'name' => 'A6',
            'stock' => 1,
            'price' => 550,
        ]);
        DB::table('products')->insert([
            'name' => 'A7',
            'stock' => 1,
            'price' => 110,
        ]);
        DB::table('products')->insert([
            'name' => 'A8',
            'stock' => 2,
            'price' => 178,
        ]);
    }
}
