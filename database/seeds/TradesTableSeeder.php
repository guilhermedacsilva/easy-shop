<?php

use Illuminate\Database\Seeder;
use EasyShop\Model\Trade;
use EasyShop\Model\ProductMovement;

class TradesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('trades')->insert([
            'type' => Trade::TYPE_PURCHASE,
            'total_value' => 20,
            'discount' => 0,
            'final_value' => 20,
            'created_by' => 1,
            'created_at' => '2000-01-01 00:00:01',
        ]);
        DB::table('product_movements')->insert([
            'quantity' => 10,
            'total_value' => 20,
            'type' => ProductMovement::TYPE_INPUT,
            'product_id' => 1,
            'created_by' => 1,
            'trade_id' => 1,
            'created_at' => '2000-01-01 00:00:01',
        ]);

        DB::table('trades')->insert([
            'type' => Trade::TYPE_SALE,
            'total_value' => 50,
            'discount' => 5,
            'final_value' => 45,
            'created_by' => 1,
            'created_at' => '2000-01-02 00:00:01',
            'customer_id' => 1
        ]);
        DB::table('product_movements')->insert([
            'quantity' => 1,
            'total_value' => 15,
            'type' => ProductMovement::TYPE_OUTPUT,
            'product_id' => 1,
            'created_by' => 1,
            'trade_id' => 2,
            'created_at' => '2000-01-02 00:00:01',
        ]);
        DB::table('product_movements')->insert([
            'quantity' => 1,
            'total_value' => 35,
            'type' => ProductMovement::TYPE_OUTPUT,
            'product_id' => 2,
            'created_by' => 1,
            'trade_id' => 2,
            'created_at' => '2000-01-02 00:00:01',
        ]);
    }
}
