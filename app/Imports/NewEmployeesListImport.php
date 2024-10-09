<?php

namespace App\Imports;

use App\Models\NewEmployeeList;
use Maatwebsite\Excel\Concerns\ToModel;

class NewEmployeesListImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new NewEmployeeList([
        'first_name'  => $row[0],
            'last_name'   => $row[1],
            'email'       => $row[2],
            'phone'       => $row[3],
            'department'  => $row[4],
            'salary'      => $row[5]
        ]);
    }
}
