<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
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
        $complete_task_count = Task::where('status','completed-tasks')->count();
        $inprogress_task_count = Task::where('status','inprogress-tasks')->count();
        $onhold_task_count = Task::where('status','on-hold-tasks')->count();
        $pending_task_count = Task::where('status','pending-tasks')->count();
        $review_task_count = Task::where('status','review-tasks')->count();
        // dd($complete_task_count);
        $employee_count = Employee::count();
        $absent_employee = EmployeeAttendance::where('status', 0)->count();
        $invoice_count = Invoice::count();
        $invoice = Invoice::where('status','pending')->count();
        $ticket_count = Ticket::count();
        $open_ticket = Ticket::where('status','Open')->count();
        $close_ticket = Ticket::where('status','Closed')->count();
        // $expenses = Expense::all();
        // dd($expenses);
        // $tasks = Task::count();
        
//$task_count = Task::count();
        $new_employee_count = Employee::where('created_at','DESC')->count();
        
        $project_count =Project::count();
        $departments = Department::get();
        $employees = Employee::with('department','designation')->get();
        $designations = Designation::with('department')->get();

        return view('backend.dashboard',compact(
            'departments', 'title','clients_count','employee_count','project_count','new_employee_count','task_count','absent_employee','invoice_count','invoice','ticket_count','open_ticket','close_ticket','complete_task_count','inprogress_task_count','onhold_task_count','pending_task_count','review_task_count','employees','designations'
        ));
    }

    
}
