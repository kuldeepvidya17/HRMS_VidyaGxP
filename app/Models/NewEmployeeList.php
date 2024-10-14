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
