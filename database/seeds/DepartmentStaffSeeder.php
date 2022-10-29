<?php

use App\User;
use Illuminate\Database\Seeder;

class DepartmentStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('department_staff')->insert([
            'department_id' => User::all()->random()->id,
            'staff_id' => User::all()->random()->id,
        ]);
    }
}
