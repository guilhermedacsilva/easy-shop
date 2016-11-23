<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use EasyShop\Model\ProductsMovement;

class ProductsMovementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 2; $i++) {
            DB::table('products_movements')->insert([
                'type' => ProductsMovement::TYPE_INPUT,
                'quantity' => 2,
                'total_value' => 10,
                'product_id' => 1,
                'created_by' => 1,
                'created_at' => Carbon::createFromDate(2000, 1, $i),
            ]);
            DB::table('products_movements')->insert([
                'type' => ProductsMovement::TYPE_OUTPUT,
                'quantity' => 1,
                'total_value' => 5,
                'product_id' => 1,
                'created_by' => 1,
                'created_at' => Carbon::createFromDate(2000, 1, $i),
            ]);
        }
        for ($i = 1; $i <= 2; $i++) {
            DB::table('products_movements')->insert([
                'type' => ProductsMovement::TYPE_INPUT,
                'quantity' => 10,
                'total_value' => 20,
                'product_id' => 2,
                'created_by' => 1,
                'created_at' => Carbon::createFromDate(2000, 1, $i),
            ]);
            DB::table('products_movements')->insert([
                'type' => ProductsMovement::TYPE_OUTPUT,
                'quantity' => 1,
                'total_value' => 10,
                'product_id' => 2,
                'created_by' => 1,
                'created_at' => Carbon::createFromDate(2000, 1, $i),
            ]);
        }
    }
}
