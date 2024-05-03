<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\EmployeeDetail;

class EmployeeDetailController extends Controller
{
    public function index()
    {
        $title = 'Employee Detail';
        $employeedetail = EmployeeDetail::all(); 
        return view('backend.employeedetail', compact('employeedetail', 'title'));
    }
    
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'employee' => 'required|exists:employees,id',
    //         'phone' => 'required',
    //         'email' => 'required|email',
    //         'Address' => 'required',
    //         'PAddress' => 'required',
    //         'gov_id' => 'required',
    //         'document_attachment' => 'nullable|file', 
    //     ]);
    
    //     $employee = Employee::findOrFail($request->input('employee'));
    
    //     $employeedetail = EmployeeDetail::create([
    //         'name' => $employee->firstname . ' ' . $employee->lastname,
    //         'phone' => $request->input('phone'),
    //         'email' => $request->input('email'),
    //         'address' => $request->input('Address'),
    //         'permanent_address' => $request->input('PAddress'),
    //         'gov_id' => $request->input('gov_id'),
    //         'document_attachment' => $request->file('document_attachment') ? $request->file('document_attachment')->store('attachments') : null,
    //     ]);
    
    //     // You can add any additional validation or processing here
    
    //     return redirect()->back()->with('success', 'Employee details stored successfully');
    // }
    public function store(Request $request)
{
    $request->validate([
        'employee' => 'required|exists:employees,id',
        'phone' => 'required',
        'email' => 'required|email',
        'Address' => 'required',
        'PAddress' => 'required',
        'gov_id' => 'required',
        'document_attachment' => 'nullable|file', 
    ]);

    // Retrieve the employee from the database
    $employee = Employee::find($request->input('employee'));

    // Check if employee exists
    if (!$employee) {
        return redirect()->back()->with('error', 'Employee not found');
    }

    // Create EmployeeDetail with employee's details
    $employeedetail = EmployeeDetail::create([
        'name' => $employee->firstname . ' ' . $employee->lastname,
        'phone' => $request->input('phone'),
        'email' => $request->input('email'),
        'address' => $request->input('Address'),
        'permanent_address' => $request->input('PAddress'),
        'gov_id' => $request->input('gov_id'),
        'document_attachment' => $request->file('document_attachment') ? $request->file('document_attachment')->store('attachments') : null,
    
    
    ]);

    // You can add any additional validation or processing here

    return redirect()->back()->with('success', 'Employee details stored successfully');
}

    
}
