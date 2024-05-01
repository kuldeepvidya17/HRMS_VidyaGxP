<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDetails extends Model
{
    protected $table = 'company_details';
    protected $fillable = [
        'company_name',
        'contact_person',
        'address',
        'country',
        'city',
        'province',
        'postal_code',
        'email',
        'phone',
        'mobile',
        'fax',
        'website_url',
    ];
    use HasFactory;
}
