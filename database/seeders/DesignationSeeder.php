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
            // // Laravel Developer Designations
            // ['name' => 'Junior Laravel Developer', 'department_id' => 1], // Replace 1 with the appropriate department ID
            // ['name' => 'Mid-Level Laravel Developer', 'department_id' => 1],
            // ['name' => 'Senior Laravel Developer', 'department_id' => 1],
            // ['name' => 'Lead Laravel Developer', 'department_id' => 1],
            // ['name' => 'Super Senior Laravel Developer', 'department_id' => 1],

            // // React Developer Designations
            // ['name' => 'Junior React Developer', 'department_id' => 2], // Replace 2 with the appropriate department ID
            // ['name' => 'Mid-Level React Developer', 'department_id' => 2],
            // ['name' => 'Senior React Developer', 'department_id' => 2],
            // ['name' => 'Lead React Developer', 'department_id' => 2],
            // ['name' => 'Super Senior React Developer', 'department_id' => 2],
            // DevOps Designations
            ['name' => 'Junior DevOps Engineer', 'department_id' => 1],
            ['name' => 'DevOps Engineer', 'department_id' => 1],
            ['name' => 'Senior DevOps Engineer', 'department_id' => 1],
            ['name' => 'DevOps Intern', 'department_id' => 1], // Intern added

            // Laravel Developer Designations
            ['name' => 'Junior Laravel Developer', 'department_id' => 2],
            ['name' => 'Laravel Developer', 'department_id' => 2],
            ['name' => 'Senior Laravel Developer', 'department_id' => 2],
            ['name' => 'Laravel Intern', 'department_id' => 2], // Intern added

            // Full Stack Developer Designations
            ['name' => 'Junior Full Stack Developer', 'department_id' => 3],
            ['name' => 'Full Stack Developer', 'department_id' => 3],
            ['name' => 'Senior Full Stack Developer', 'department_id' => 3],
            ['name' => 'Full Stack Intern', 'department_id' => 3], // Intern added

            // Frontend Developer Designations
            ['name' => 'Junior Frontend Developer', 'department_id' => 4],
            ['name' => 'Frontend Developer', 'department_id' => 4],
            ['name' => 'Senior Frontend Developer', 'department_id' => 4],
            ['name' => 'Frontend Intern', 'department_id' => 4], // Intern added

            // UI/UX Developer Designations
            ['name' => 'Junior UI/UX Developer', 'department_id' => 5],
            ['name' => 'UI/UX Developer', 'department_id' => 5],
            ['name' => 'Senior UI/UX Developer', 'department_id' => 5],
            ['name' => 'UI/UX Intern', 'department_id' => 5], // Intern added

            // Node Developer Designations
            ['name' => 'Junior Node Developer', 'department_id' => 6],
            ['name' => 'Node Developer', 'department_id' => 6],
            ['name' => 'Senior Node Developer', 'department_id' => 6],
            ['name' => 'Node Intern', 'department_id' => 6], // Intern added

            // Python Developer Designations
            ['name' => 'Junior Python Developer', 'department_id' => 7],
            ['name' => 'Python Developer', 'department_id' => 7],
            ['name' => 'Senior Python Developer', 'department_id' => 7],
            ['name' => 'Python Intern', 'department_id' => 7], // Intern added

            // MERN Stack Developer Designations
            ['name' => 'Junior MERN Stack Developer', 'department_id' => 8],
            ['name' => 'MERN Stack Developer', 'department_id' => 8],
            ['name' => 'Senior MERN Stack Developer', 'department_id' => 8],
            ['name' => 'MERN Stack Intern', 'department_id' => 8], // Intern added

            // Database Expert Designations
            ['name' => 'Junior Database Expert', 'department_id' => 9],
            ['name' => 'Database Expert', 'department_id' => 9],
            ['name' => 'Senior Database Expert', 'department_id' => 9],
            ['name' => 'Database Intern', 'department_id' => 9], // Intern added

            // QA Designations
            ['name' => 'Junior QA Engineer', 'department_id' => 10],
            ['name' => 'QA Engineer', 'department_id' => 10],
            ['name' => 'Senior QA Engineer', 'department_id' => 10],
            ['name' => 'QA Intern', 'department_id' => 10], // Intern added

            // Tester Designations
            ['name' => 'Junior Tester', 'department_id' => 11],
            ['name' => 'Tester', 'department_id' => 11],
            ['name' => 'Senior Tester', 'department_id' => 11],
            ['name' => 'Testing Intern', 'department_id' => 11], // Intern added

            // Validation Expert Designations
            ['name' => 'Validation Associate', 'department_id' => 12],
            ['name' => 'Validation Expert', 'department_id' => 12],
            ['name' => 'Validation Intern', 'department_id' => 12], // Intern added

            // Validation Lead Designations
            ['name' => 'Validation Lead', 'department_id' => 13],

            // Research & Development Designations
            ['name' => 'Research Associate', 'department_id' => 14],
            ['name' => 'R&D Engineer', 'department_id' => 14],
            ['name' => 'R&D Intern', 'department_id' => 14], // Intern added

            // Project Manager Designations
            ['name' => 'Project Coordinator', 'department_id' => 15],
            ['name' => 'Project Manager', 'department_id' => 15],
            ['name' => 'Senior Project Manager', 'department_id' => 15],

            // Subject Matter Expert Designations
            ['name' => 'Junior Subject Matter Expert', 'department_id' => 16],
            ['name' => 'Subject Matter Expert', 'department_id' => 16],

            // Data Science Designations
            ['name' => 'Data Analyst', 'department_id' => 17],
            ['name' => 'Data Scientist', 'department_id' => 17],

            // Cyber Security Designations
            ['name' => 'Junior Cyber Security Analyst', 'department_id' => 18],
            ['name' => 'Cyber Security Analyst', 'department_id' => 18],

            // Product Management Designations
            ['name' => 'Product Manager', 'department_id' => 19],
            ['name' => 'Senior Product Manager', 'department_id' => 19],

            // Senior Solutions Architect Designations
            ['name' => 'Solutions Architect', 'department_id' => 20],
            ['name' => 'Senior Solutions Architect', 'department_id' => 20],

            // Senior Developer Designations
            ['name' => 'Senior Developer', 'department_id' => 21],

            // Human Resources Designations
            ['name' => 'HR Associate', 'department_id' => 22],
            ['name' => 'HR Manager', 'department_id' => 22],

            // Admin Designations
            ['name' => 'Admin Assistant', 'department_id' => 23],

            // Personal Assistant Designations
            ['name' => 'Personal Assistant', 'department_id' => 24],

            // Flutter Developer Designations
            ['name' => 'Junior Flutter Developer', 'department_id' => 25],
            ['name' => 'Flutter Developer', 'department_id' => 25],
            ['name' => 'Senior Flutter Developer', 'department_id' => 25],
            ['name' => 'Flutter Intern', 'department_id' => 25], // Intern added
        ]);
    }
}
