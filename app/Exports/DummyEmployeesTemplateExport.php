<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DummyEmployeesTemplateExport implements FromArray, WithHeadings
{
    public function headings(): array
    {
        return [
            'EMP-ID', 'First Name', 'Last Name', 'Email', 'Phone', 'Department', 'Designation', 'Salary', 
            'Reporting Manager', 'Area', 'Employee Type', 'Date of Joining', 'Aadhaar No', 'Passport No', 
            'Card No', 'Permanent Address', 'Birthday', 'Nick Name', 'Office Tel', 'Religion', 'Pincode', 
            'Gender', 'Motorcycle License', 'Automobile License', 'Country', 'State', 'City', 'CV'
        ];
    }

    public function array(): array
    {
        // Optional: Return dummy data or leave it empty
        return [];
    }
}
