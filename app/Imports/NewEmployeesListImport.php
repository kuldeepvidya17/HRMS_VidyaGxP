<?php

namespace App\Imports;
use Carbon\Carbon;

use App\Models\NewEmployeeList;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NewEmployeesListImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Debug the row to ensure you get the correct data.
        // dd($row);
        
        // $depatment_code = 0;
        
        // if ($row['department'] == 'Software Developer') 
        // {
        //     $department_code = 1;
        // }

     // Default values
    // Default values
    $department_code = 0;
    $designation_code = 0;

    // Map department to department_code
    if (isset($row[6])) { // Adjust the index based on your CSV
        switch ($row[6]) { // Accessing Department using index 6
            case 'DevOps':
                $department_code = 1;
                break;
            case 'Laravel Developer':
                $department_code = 2;
                break;
            case 'Full Stack Developer':
                $department_code = 3;
                break;
            case 'Frontend Developer':
                $department_code = 4;
                break;
            case 'UI/UX Developer':
                $department_code = 5;
                break;
            case 'Node Developer':
                $department_code = 6;
                break;
            case 'Python Developer':
                $department_code = 7;
                break;
            case 'MERN Stack Developer':
                $department_code = 8;
                break;
            case 'Database Expert':
                $department_code = 9;
                break;
            case 'QA':
                $department_code = 10;
                break;
            case 'Tester':
                $department_code = 11;
                break;
            case 'Validation Expert':
                $department_code = 12;
                break;
            case 'Validation Lead':
                $department_code = 13;
                break;
            case 'Research & Development (R&D)':
                $department_code = 14;
                break;
            case 'Project Manager':
                $department_code = 15;
                break;
            case 'Subject Matter Expert (SME)':
                $department_code = 16;
                break;
            case 'Data Science':
                $department_code = 17;
                break;
            case 'Cyber Security':
                $department_code = 18;
                break;
            case 'Product Management':
                $department_code = 19;
                break;
            case 'Senior Solutions Architect':
                $department_code = 20;
                break;
            case 'Senior Developer':
                $department_code = 21;
                break;
            case 'Human Resources':
                $department_code = 22;
                break;
            case 'Admin':
                $department_code = 23;
                break;
            case 'Personal Assistant':
                $department_code = 24;
                break;
            case 'Flutter Developer':
                $department_code = 25;
                break;
            case 'React Native Developer':
                $department_code = 26;
                break;
            case 'AI/ML Engineer':
                $department_code = 27;
                break;
            case 'Salesforce Developer':
                $department_code = 28;
                break;
            case 'Support Specialist':
                $department_code = 29;
                break;
            case 'Regional Director':
                $department_code = 30;
                break;
            case 'Director':
                $department_code = 31;
                break;
            case 'CEO':
                $department_code = 32;
                break;
            case 'COO':
                $department_code = 33;
                break;
            case 'CTO':
                $department_code = 34;
                break;
            case 'MD':
                $department_code = 35;
                break;
            case 'CFO':
                $department_code = 36;
                break;
            default:
                $department_code = 0; // Default if department is not listed
                break;
        }
    } else {
        // Handle missing 'Department' key
        $department_code = 0; // Default or error handling
    }

    // Map designation to designation_code
    if (isset($row[7])) { // Adjust the index based on your CSV
        switch ($row[7]) { // Accessing Designation using index 7
            // DevOps Designations
            case 'Junior DevOps Engineer':
                $designation_code = 1;
                break;
            case 'DevOps Engineer':
                $designation_code = 2;
                break;
            case 'Senior DevOps Engineer':
                $designation_code = 3;
                break;
            case 'DevOps Intern':
                $designation_code = 4;
                break;

            // Laravel Developer Designations
            case 'Junior Laravel Developer':
                $designation_code = 5;
                break;
            case 'Laravel Developer':
                $designation_code = 6;
                break;
            case 'Senior Laravel Developer':
                $designation_code = 7;
                break;
            case 'Laravel Intern':
                $designation_code = 8;
                break;

            // Full Stack Developer Designations
            case 'Junior Full Stack Developer':
                $designation_code = 9;
                break;
            case 'Full Stack Developer':
                $designation_code = 10;
                break;
            case 'Senior Full Stack Developer':
                $designation_code = 11;
                break;
            case 'Full Stack Intern':
                $designation_code = 12;
                break;

            // Add other designations here...

            default:
                $designation_code = 0; // Default if designation is not listed
                break;
        }
    } else {
        // Handle missing 'Designation' key
        $designation_code = 0; // Default or error handling
    }
    // dd($row);
    


    // Return the new employee list
    return new NewEmployeeList([
       'first_name' => array_key_exists('first_name', $row) ? $row['first_name'] : '',
    'last_name' => array_key_exists('last_name', $row) ? $row['last_name'] : '',
    'email' => array_key_exists('email', $row) ? $row['email'] : '',
    'phone' => array_key_exists('phone', $row) ? $row['phone'] : '',
    'department' => $department_code,  // already mapped via switch case
    'salary' => array_key_exists('salary', $row) ? $row['salary'] : '',
    'designation_id' => $designation_code,  // mapped via switch case
    'Employee_id' => array_key_exists('emp_id', $row) ? $row['emp_id'] : '',
    'country_code' => array_key_exists('country', $row) ? $row['country'] : '',
    'reporting_manager' => array_key_exists('reporting_manager', $row) ? $row['reporting_manager'] : '',
    'area' => array_key_exists('area', $row) ? $row['area'] : '',
    'employee_type' => array_key_exists('employee_type', $row) ? $row['employee_type'] : '',
    // 'date_of_joining' => array_key_exists('date_of_joining', $row) ? $row['date_of_joining'] : '',
   'date_of_joining' => array_key_exists('date_of_joining', $row)&& !empty($row['date_of_joining']) 
                        ? Carbon::parse($row['date_of_joining']) 
                        : null,
    'aadhaar_no' => array_key_exists('aadhaar_no', $row) ? $row['aadhaar_no'] : '',
    'passport_no' => array_key_exists('passport_no', $row) ? $row['passport_no'] : '',
    'card_no' => array_key_exists('card_no', $row) ? $row['card_no'] : '',
    'permanent_address' => array_key_exists('permanent_address', $row) ? $row['permanent_address'] : '',
    // 'birthday' => array_key_exists('birthday', $row) ? $row['birthday'] : '',
    'birthday' => array_key_exists('birthday', $row) && !empty($row['birthday']) 
                        ? Carbon::parse($row['birthday']) 
                        : null,
    'nick_name' => array_key_exists('nick_name', $row) ? $row['nick_name'] : '',
    'office_tel' => array_key_exists('office_tel', $row) ? $row['office_tel'] : '',
    'religion' => array_key_exists('religion', $row) ? $row['religion'] : '',
    'pincode' => array_key_exists('pincode', $row) ? $row['pincode'] : '',
    'gender' => array_key_exists('gender', $row) ? $row['gender'] : '',
    'motorcycle_lic' => array_key_exists('motorcycle_lic', $row) ? $row['motorcycle_lic'] : '',
    'autoMobil_license' => array_key_exists('autoMobil_license', $row) ? $row['autoMobil_license'] : '',
    'country' => array_key_exists('country', $row) ? $row['country'] : '',
    'state' => array_key_exists('state', $row) ? $row['state'] : '',
    ]);
    }
    
    public function convertExcelDate($excelDate) {
        // Excel starts counting from January 1, 1900
        $unixDate = ($excelDate - 25569) * 86400; // 25569 is the number of days from 1900-01-01 to 1970-01-01
        return gmdate("Y-m-d", $unixDate);
    }
}
