<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\Employee;
use App\Models\EmployeeAttendance;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index(){
        
        $title = 'Dashboard';
        $clients_count = Client::count();
        $task_count = Task::count();
        $employee_count = Employee::count();
        $absent_employee = EmployeeAttendance::where('status', 0)->count();
        $invoices_count = Invoice::count();
        $invoices = Invoice::where('status','pending')->count();
        // $expenses = Expense::count();
        // $tasks = Task::count();
        
//$task_count = Task::count();
        $new_employee_count = Employee::where('created_at','DESC')->count();
        
        $project_count =Project::count();
        

        return view('backend.dashboard',compact(
            'title','clients_count','employee_count','project_count','new_employee_count','task_count','absent_employee','invoices_count','invoices'
        ));
    }

    
}
