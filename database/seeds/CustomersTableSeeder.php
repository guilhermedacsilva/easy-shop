<?php

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'name' => 'John',
        ]);
        DB::table('customers')->insert([
            'name' => 'Bill',
        ]);
    }
}
