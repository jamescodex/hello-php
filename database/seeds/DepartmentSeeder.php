<?php

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'name' => Str::random(10),
            'number' => Str::random(10),
            'location' => Str::random(10).'lagos',
        ]);
    }
}
