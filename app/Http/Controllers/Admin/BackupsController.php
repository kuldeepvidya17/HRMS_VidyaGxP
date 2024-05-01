<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Exports\backup_ex;
use Illuminate\Support\Facades\DB;
use Excel;
// use Mpdf;


class BackupsController extends Controller
{
    public function index(){
        
        
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
    
    public function backupmain(Request $request)
    {
    //  added code 
    $format = $request->get('format'); 

    // Export data based on the selected format
    switch ($format) {
        case 'csv':
            return Excel::download(new backup_ex, 'backup.csv', \Maatwebsite\Excel\Excel::CSV);
            break;
        case 'excel':
            return Excel::download(new backup_ex, 'backup.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            break;
        case 'pdf   ':
            return Excel::download(new backup_ex, 'backup.pdf', \Maatwebsite\Excel\Excel::MPDF);
            break;
        default:
            // Handle invalid format or no format provided
            return back()->with('error', 'Invalid file format selected.');
    }    // added code 
     
    }
    
}

