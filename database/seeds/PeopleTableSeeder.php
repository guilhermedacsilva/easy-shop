<?php

use Illuminate\Database\Seeder;
use EasyShop\Model\Person;
use Carbon\Carbon;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('people')->insert([
            'name' => 'John',
            'type' => Person::TYPE_CUSTOMER,
            'created_at' => Carbon::now(),
        ]);
        DB::table('people')->insert([
            'name' => 'Bill',
            'type' => Person::TYPE_CUSTOMER,
            'created_at' => Carbon::now(),
        ]);
        DB::table('people')->insert([
            'name' => 'Some Industry',
            'type' => Person::TYPE_SUPPLIER,
            'created_at' => Carbon::now(),
        ]);
        DB::table('people')->insert([
            'name' => 'Nails Store',
            'type' => Person::TYPE_SUPPLIER,
            'created_at' => Carbon::now(),
        ]);
    }
}
