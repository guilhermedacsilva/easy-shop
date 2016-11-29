<?php

use Illuminate\Database\Seeder;

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
        ]);
        DB::table('people')->insert([
            'name' => 'Bill',
        ]);
    }
}
