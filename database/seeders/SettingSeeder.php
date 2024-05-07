<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            'group' => "theme",
            'name' => 'currency_symbol',
            'locked' => 0,
            'payload' => "INR",
        ]);

        DB::table('settings')->insert([
            'group' => "theme",
            'name' => 'currency_code',
            'locked' => 0,
            'payload' => "INR",
        ]);
    }
}
