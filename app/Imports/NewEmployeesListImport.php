<?php

namespace App\Imports;

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

        return new NewEmployeeList([
            'first_name' => $row['first_name'],  // Map these to your Excel headers
            'last_name' => $row['last_name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'department' => $row['department'],
            'salary' => $row['salary'],
        ]);
    }
}
