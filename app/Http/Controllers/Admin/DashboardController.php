<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Employee;
use App\Models\NewEmployeeList;
use App\Models\EmployeeAttendance;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index(){
        
        $title = 'Dashboard';
        $clients_count = Client::count();
        $task_count = Task::count();
        // $employee_count = Employee::count();
        $employee_count = NewEmployeeList::count();
        $absent_employee = EmployeeAttendance::where('status', 0)->count();
        $invoice_count = Invoice::count();
        $invoice = Invoice::where('status','pending')->count();
        $ticket_count = Ticket::count();
        $open_ticket = Ticket::where('status','Open')->count();
        $close_ticket = Ticket::where('status','Closed')->count();
        // dd($close_ticket);
        // $expenses = Expense::count();
        // $tasks = Task::count();
        
//$task_count = Task::count();
        $new_employee_count = Employee::where('created_at','DESC')->count();
        
        $project_count =Project::count();
        

        return view('backend.dashboard',compact(
            'title','clients_count','employee_count','project_count','new_employee_count','task_count','absent_employee','invoice_count','invoice','ticket_count','open_ticket','close_ticket'
        ));
    }

    
}
