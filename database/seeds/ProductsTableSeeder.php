<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'Broom',
            'quantity' => 10,
            'created_by' => 1,
        ]);
        DB::table('products')->insert([
            'name' => 'Chair',
            'quantity' => 5,
            'created_by' => 1,
        ]);
    }
}
