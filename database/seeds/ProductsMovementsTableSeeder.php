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
        DB::table('products_movements')->insert([
            'quantity' => 10,
            'total_value' => 10,
            'type' => ProductsMovement::TYPE_INPUT,
            'created_by' => 1,
            'created_at' => Carbon::now(),
        ]);
    }
}
