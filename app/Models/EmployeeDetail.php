<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDetail extends Model
{
    use HasFactory;
protected $table ="employee_details";
protected $fillable = [
    'name',
    'phone',
    'email',
    'address',
    'permanent_address',
    'document_attachment',
    'gov_id',
];


}
