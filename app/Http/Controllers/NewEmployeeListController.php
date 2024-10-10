<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\NewEmployeesListImport;
use App\Models\Department;
use App\Models\Designation;
// use App\Models\Employee;
use App\Models\NewEmployeeList;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class NewEmployeeListController extends Controller
{
    public function index()
    {
        $employees = NewEmployeeList::all();
        $departments = Department::all(); 
        $designations = Designation::all(); 
        return view('backend.Newemployees-list', compact('employees','departments','departments'));
    }

   public function empdashborad(){
    $employees = NewEmployeeList::all();
    // $employees = Employee::with('department','designation',)->get();
        // // dd($employees);
        // return view('backend.employees',
        // compact('title','designations','departments','employees'));
        $departments = Department::all(); 
        $designations = Designation::all(); 
        return view('backend.employees',compact('employees','departments', 'designations'));
    }
    public function create()
    {
        $employees = NewEmployeeList::all();

        $departments = Department::all(); 
        $designations = Designation::all(); 
        return view('backend.addNewEmployee',compact('employees','departments', 'designations'));
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
        
    
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'avatar' => 'nullable|image',
        ]);
    
        // Handle avatar upload if exists
        $avatar = null;
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar')->store('employees', 'public');
        }
    
        // Create new employee
        $employee = new NewEmployeeList();
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->department_id = $request->department_id; 
        $employee->designation_id = $request->designation_id; 
        $employee->salary = $request->salary;
        $employee->avatar = $avatar;
        // $employee->reporting_manager = $request->reporting_managers;
        $employee->reporting_manager = implode(',', $request->reporting_managers);
        $employee->area = $request->area;
        $employee->employee_type = $request->employee_type;
        $employee->date_of_joining = $request->date_of_joining;
        $employee->aadhaar_no = $request->aadhaar_no;
        $employee->passport_no = $request->passport_no;
        $employee->card_no = $request->card_no;
        $employee->permanent_address = $request->permanent_address;
        $employee->birthday = $request->birthday;
        $employee->nick_name = $request->nick_name;
        $employee->office_tel = $request->office_tel;
        $employee->religion = $request->religion;
        $employee->Pincode = $request->pincode;
        $employee->gender = $request->gender;
        $employee->Motorcycle_lic = $request->motorcycle_lic;
        $employee->autoMobil_license = $request->automobile_lic;
        $employee->city = $request->city;
        $employee->save();
       
    
        return redirect()->route('NewEmployeeslist.empdashborad')->with('success', 'Employee added successfully!');
    }
    
    public function edit(NewEmployeeList $employee)
    {
        $departments = Department::all(); 
        $designations = Designation::all(); 
        $employees = NewEmployeeList::all(); // Assuming you're fetching all employees here
        return view('backend.editNewEmployee', compact('employee', 'departments', 'designations', 'employees'));
    }
    
    public function update(Request $request, NewEmployeeList $employee)
    {
        if ($request->hasFile('avatar')) {
            $avatarName = time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('storage/employees'), $avatarName);
            $employee->avatar = $avatarName; // Assign the avatar name
        }
    $employee->first_name = $request->first_name;
    $employee->last_name = $request->last_name;
    $employee->email = $request->email;
    $employee->phone = $request->phone;
    $employee->department_id = $request->department_id; 
    $employee->designation_id = $request->designation_id; 
    $employee->salary = $request->salary;
    $employee->reporting_manager = implode(',', $request->reporting_managers); // Handle multiple managers
    $employee->area = $request->area;
    $employee->employee_type = $request->employee_type;
    $employee->date_of_joining = $request->date_of_joining;
    $employee->aadhaar_no = $request->aadhaar_no;
    $employee->passport_no = $request->passport_no;
    $employee->card_no = $request->card_no;
    $employee->permanent_address = $request->permanent_address;
    $employee->birthday = $request->birthday;
    $employee->nick_name = $request->nick_name;
    $employee->office_tel = $request->office_tel;
    $employee->religion = $request->religion;
    $employee->Pincode = $request->pincode;
    $employee->gender = $request->gender;
    $employee->Motorcycle_lic = $request->motorcycle_lic;
    $employee->autoMobil_license = $request->automobile_lic;
    $employee->city = $request->city;
// dd( $employee->Pincode);
    // Save the updated employee record
    $employee->save();   


    
    
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
