<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonnelDepartment extends Model
{
    use HasFactory;

    protected $connection = "dotnetDB";

    protected $table = "personnel_department";
}
