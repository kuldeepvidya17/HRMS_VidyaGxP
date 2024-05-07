<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IclockTransaction extends Model
{
    use HasFactory;

    protected $connection = "dotnetDB";

    protected $table = "iclock_transaction";

    public function employee()
    {
        return $this->belongsTo(PersonnelEmployee::class, 'emp_code', 'emp_code');
    }
}
