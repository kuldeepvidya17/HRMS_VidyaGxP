<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('designations')->insert([
            // Laravel Developer Designations
            ['name' => 'Junior Laravel Developer', 'department_id' => 1], // Replace 1 with the appropriate department ID
            ['name' => 'Mid-Level Laravel Developer', 'department_id' => 1],
            ['name' => 'Senior Laravel Developer', 'department_id' => 1],
            ['name' => 'Lead Laravel Developer', 'department_id' => 1],
            ['name' => 'Super Senior Laravel Developer', 'department_id' => 1],

            // React Developer Designations
            ['name' => 'Junior React Developer', 'department_id' => 2], // Replace 2 with the appropriate department ID
            ['name' => 'Mid-Level React Developer', 'department_id' => 2],
            ['name' => 'Senior React Developer', 'department_id' => 2],
            ['name' => 'Lead React Developer', 'department_id' => 2],
            ['name' => 'Super Senior React Developer', 'department_id' => 2],
        ]);
    }
}
