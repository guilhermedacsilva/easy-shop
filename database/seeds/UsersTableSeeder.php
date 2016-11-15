<?php

use Illuminate\Database\Seeder;
use Gym\Model\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'type' => User::TYPE_ADMIN,
            'password' => bcrypt('123456'),
        ]);
    }
}
