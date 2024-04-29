<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Exports\backup_ex;
use Excel;
// use Mpdf;


class BackupsController extends Controller
{
    public function index(){
        //enter relevant info below
        
        $title = 'backups';
        return view('backend.backups.index',compact(
            'title'
        ));
    }
   
    public function backup()
    {
        //export user 
        return view('frontend.backupmain');
    }
    public function backupmain()
    {
        //export user 
        // return Excel::download(new backup_ex,'Backup.xlsx' );
        // return Excel::download(new backup_ex, 'invoices.csv', \Maatwebsite\Excel\Excel::CSV);
        return Excel::download(new backup_ex, 'invoices.pdf', \Maatwebsite\Excel\Excel::MPDF);
    }
    
}

