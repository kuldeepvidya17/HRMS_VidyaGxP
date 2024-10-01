<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            ['name' => 'DevOps'],
            ['name' => 'Laravel Developer'],
            ['name' => 'Full Stack Developer'],
            ['name' => 'Frontend Developer'],
            ['name' => 'UI/UX Developer'],
            ['name' => 'Node Developer'],
            ['name' => 'Python Developer'],
            ['name' => 'MERN Stack Developer'],
            ['name' => 'Database Expert'],
            ['name' => 'QA'],
            ['name' => 'Tester'],
            ['name' => 'Validation Expert'],
            ['name' => 'Validation Lead'],
            ['name' => 'Research & Development (R&D)'],
            ['name' => 'Project Manager'],
            ['name' => 'Subject Matter Expert (SME)'],
            ['name' => 'Data Science'],
            ['name' => 'Cyber Security'],
            ['name' => 'Product Management'],
            ['name' => 'Senior Solutions Architect'],
            ['name' => 'Senior Developer'],
            ['name' => 'Human Resources'],
            ['name' => 'Admin'],
            ['name' => 'Personal Assistant'],
            ['name' => 'Flutter Developer'],
            ['name' => 'React Native Developer'],
            ['name' => 'AI/ML Engineer'],
            ['name' => 'Salesforce Developer'],
            ['name' => 'Support Specialist'],
            ['name' => 'Regional Director'],
            ['name' => 'Director'],
            ['name' => 'CEO'],
            ['name' => 'COO'],
            ['name' => 'CTO'],
            ['name' => 'MD'],
            ['name' => 'CFO'],
            // ['name' => 'Procurement'],
            ['name' => 'Accounts'],
            ['name' => 'Principal Consultant']
        ]);
        
    }
}
