<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonnelEmployee extends Model
{
    use HasFactory;

    protected $connection = "dotnetDB";

    protected $table = "personnel_employee";

    public function department()
    {
        return $this->belongsTo(PersonnelDepartment::class, 'department_id');
    }
}
