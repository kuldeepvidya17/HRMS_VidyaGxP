<?php

namespace App\Exports;

// use App\Models\backup_exp;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Schema;
use DB;
class backup_ex implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    
        // return Employee::all();
        {
            $tables = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
            $data = collect();
    
            foreach ($tables as $table) {
                $records = DB::table($table)->get();
                $data = $data->merge($records);
            }
    
            return $data;
        }
    
}
