<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewEmployeeList extends Model
{
    use HasFactory;
    protected $fillable= [
        'first_name',
        'last_name',
        'email',
        'phone',
        'salary',
        'avatar',
        'department_id',
        'designation_id',
        'Employee_id',
        'country_code',
        'reporting_managers',
        'area',
        'employee_type',
        'date_of_joining',
        'aadhaar_no',
        'passport_no',
        'card_no',
        'permanent_address',
        'birthday',
        'nick_name',
        'office_tel',
        'religion',
        'pincode',
        'gender',
        'motorcycle_lic',
        'automobile_lic',
        'country',
        'state',

    ];

    // protected $casts = [
    //     'reporting_managers' => 'array', 
    //     'date_of_joining' => 'date',      
    //     'birthday' => 'date',              
    // ];
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
}
