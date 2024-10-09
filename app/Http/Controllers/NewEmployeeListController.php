<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NewEmployeeList;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\NewEmployeesListImport;


class NewEmployeeListController extends Controller
{
    public function index()
    {
        $employees = NewEmployeeList::all();
        return view('backend.Newemployees-list', compact('employees'));
    }

   public function empdashborad(){
    $employees = NewEmployeeList::all();
    // $employees = Employee::with('department','designation',)->get();
        // // dd($employees);
        // return view('backend.employees',
        // compact('title','designations','departments','employees'));
        return view('backend.employees',compact('employees'));
    }
    public function create()
    {
        return view('backend.addNewEmployee');
    }

    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'first_name' => 'required|max:255',
    //         'last_name' => '|max:255',
    //         'email' => 'required|email',
    //         'phone' => 'required',
    //         'department' => 'required',
    //         'salary' => 'required'
    //     ]);
        

    //     NewEmployeeList::create($validatedData);
    //      // Handle the image upload
    // if ($request->hasFile('avatar')) {
    //     $avatarName = time().'.'.$request->avatar->extension();  
    //     $request->avatar->move(public_path('storage/employees'), $avatarName);
    //     $validatedData['avatar'] = $avatarName;
    // }
    //     return redirect('/employees/dashboard')->with('success', 'Employee added successfully!');
    // }
    public function store(Request $request)
    {
        // Step 1: Validate the input data
        $validatedData = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',  // Ensure last name is also required
            'email' => 'required|email',
            'phone' => 'required',
            'department' => 'required',
            'salary' => 'required|numeric',
        ]);
        
        // Step 2: Handle the image upload if present
        if ($request->hasFile('avatar')) {
            $avatarName = time().'.'.$request->avatar->extension();  
            $request->avatar->move(public_path('storage/employees'), $avatarName);
            $validatedData['avatar'] = $avatarName;
        }
    
        // Step 3: Create the new employee record with the validated data and avatar
        NewEmployeeList::create($validatedData);
    
        // Step 4: Redirect to dashboard with success message
        return redirect()->route('NewEmployeeslist.empdashborad')->with('success', 'Employee added successfully!');
    }
    
    public function edit(NewEmployeeList $employee)
    {
        return view('backend.editNewEmployee', compact('employee'));
    }

    public function update(Request $request, NewEmployeeList $employee)
    {
    $updateData = $request->except(['avatar']);  
    
    if ($request->hasFile('avatar')) {
        $avatarName = time().'.'.$request->avatar->extension();  
        
        $request->avatar->move(public_path('storage/employees'), $avatarName);
        
        $updateData['avatar'] = $avatarName;
    }

    $employee->update($updateData);
    
    
    return redirect('/employees/dashboard')->with('success', 'Employee updated successfully!');
    }

    public function destroy(NewEmployeeList $employee)
    {
        $employee->delete();
        return redirect('/NewListemployees')->with('success', 'Employee deleted successfully!');
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);
    
        Excel::import(new NewEmployeesListImport, $request->file('file')); // Use the correct class name
    
        return redirect()->route('NewEmployeeslist.index')->with('success', 'Employees imported successfully!');
    }
    public function show(NewEmployeeList $employee)
{
    // return view('NewE', compact('employee'));
}

    // Optional: DataTables Server-Side Integration Method
    // public function getEmployeesData()
    // {
    //     $employees = NewEmployeeList::select(['id', 'first_name', 'last_name', 'email', 'phone', 'department', 'salary']);
    //     return DataTables::of($employees)->make(true);
    // }
}
