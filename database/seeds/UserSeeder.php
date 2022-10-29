<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' => 'Admin',
            'lastname' => "Admin",
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);

        DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id' => 2
        ]);
    }
}
