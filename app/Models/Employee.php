<?php

namespace App\Models;

use App\Models\Department;
use App\Models\Designation;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname','lastname','uuid',
        'email','phone',
        'department_id','designation_id','company','avatar',
        'Employee_id',
        'position',
        'empsalary',
        'reporting_manager',
        'area',
        'employee_type',
        'date_of_joining',
        'aadhaar_no',
        'passport_no',
        'contact_no',
        'card_no',
        'permanent_address',
        'birthday',
        'nick_name',
        'office_tel',
        'religion',
        'Pincode',
        'gender',
        'Motorcycle_lic',
        'autoMobil_license',
        'city'
    ];


    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function designation(){
        return $this->belongsTo(Designation::class);
    }

    
}
