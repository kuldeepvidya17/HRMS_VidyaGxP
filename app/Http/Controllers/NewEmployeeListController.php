<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\NewEmployeesListImport;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Department;
// use App\Models\Employee;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\NewEmployeeList;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class NewEmployeeListController extends Controller
{
    public function index()
    {
        $employees = NewEmployeeList::all();
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $departments = Department::all(); 
        $designations = Designation::all(); 
        return view('backend.Newemployees-list', compact('countries','states','cities','employees','departments','designations'));
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
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $departments = Department::all(); 
        $designations = Designation::all(); 
        return view('backend.addNewEmployee',compact('countries','states','cities','employees','departments', 'designations'));
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
            $avatarName = time() . '.' . $request->avatar->extension();
            $request->file('avatar')->move(public_path('storage/employees'), $avatarName);
            $avatar = $avatarName; // Store just the file name, not the full path
        }
    
        // Create new employee
        $employee = new NewEmployeeList();
         if ($request->hasFile('cv')) {
        // Generate a unique file name with the current timestamp
        $cvName = time() . '.' . $request->cv->extension();
        
        // Store the file in 'storage/app/public/employees' directory
        $request->file('cv')->storeAs('employees', $cvName, 'public'); // Store on the public disk
        
        // Save the file name in the employee record
        $employee->cv = $cvName; // Store just the file name
    } else {
        // If no CV is uploaded, set it to null or keep previous value
        $employee->cv = null; // or leave it unset to keep previous
    }
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->department_id = $request->department_id; 
        $employee->designation_id = $request->designation_id; 
        $employee->salary = $request->salary;
        $employee->avatar = $avatar;
        // $employee->reporting_manager = $request->reporting_managers;
        // $employee->reporting_manager = implode(',', $request->reporting_managers);
        if ($request->has('reporting_managers') && !is_null($request->reporting_managers)) {
            $reportingManagers = is_array($request->reporting_managers) ? $request->reporting_managers : [$request->reporting_managers];
            $employee->reporting_manager = implode(',', $reportingManagers);
        } else {
            $employee->reporting_manager = null; 
        }
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
        $employee->Employee_id = $request->Employee_id;
        $employee->country = $request->country;
        $employee->state = $request->state;
        $employee->city = $request->city;
        $employee->country_code = $request->country_code;

        $employee->save();
       
    
        return redirect()->route('NewEmployeeslist.empdashborad')->with('success', 'Employee added successfully!');
    }
     public function viewCV($id)
    {
       
    $employee = NewEmployeeList::findOrFail($id);

    // Check if the CV exists
    if ($employee->cv) {
        
        $filePath = storage_path('app/public/employees/' . $employee->cv);

      
        if (file_exists($filePath)) {
           
            return response()->file($filePath);
        } else {
            return redirect()->back()->with('error', 'CV file does not exist.');
        }
    } else {
        return redirect()->back()->with('error', 'CV not found.');
    }
    }
    
    public function edit(NewEmployeeList $employee)
    {
        $departments = Department::all(); 
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $designations = Designation::all(); 
        $employees = NewEmployeeList::all(); // Assuming you're fetching all employees here
        return view('backend.editNewEmployee', compact('states','cities','countries','employee', 'departments', 'designations', 'employees'));
    }
    
    public function update(Request $request, NewEmployeeList $employee)
    {
        if ($request->hasFile('avatar')) {
            $avatarName = time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('storage/employees'), $avatarName);
            $employee->avatar = $avatarName; // Assign the avatar name
        }
        //  if ($request->hasFile('cv')) {
        //     // If there's an existing CV, delete it
        //     if ($employee->cv) {
        //         Storage::disk('public')->delete('employees/' . $employee->cv);
        //     }
    
        //     // Generate a unique file name for the CV
        //     $cvName = time() . '.' . $request->cv->extension();
            
        //     // Store the file in 'storage/app/public/employees' directory
        //     $request->file('cv')->storeAs('employees', $cvName, 'public'); // Store on the public disk
            
        //     // Save the new file name in the employee record
        //     $employee->cv = $cvName; // Store just the file name
        // }
         if ($request->hasFile('cv')) {
            // If there's an existing CV, delete it
            if ($employee->cv) {
                // Delete the old CV file
                $oldCvPath = public_path('storage/employees/' . $employee->cv);
                if (file_exists($oldCvPath)) {
                    unlink($oldCvPath); // Delete the old file
                }
            }
    
            // Generate a unique file name for the CV
            $cvName = time() . '.' . $request->cv->extension();
            $request->cv->move(public_path('storage/employees'), $cvName); // Directly move to public storage
    
            // Save the new file name in the employee record
            $employee->cv = $cvName; // Store just the file name
        }
    
    $employee->first_name = $request->first_name;
    $employee->last_name = $request->last_name;
    $employee->email = $request->email;
    $employee->phone = $request->phone;
    $employee->department_id = $request->department_id; 
    $employee->designation_id = $request->designation_id; 
    $employee->salary = $request->salary;
    // $employee->reporting_manager = implode(',', $request->reporting_managers); // Handle multiple managers
    if ($request->has('reporting_managers') && !is_null($request->reporting_managers)) {
        // If reporting_managers is not null and is an array, we handle it normally
        $reportingManagers = is_array($request->reporting_managers) ? $request->reporting_managers : [$request->reporting_managers];
        $employee->reporting_manager = implode(',', $reportingManagers);
    } else {
        // If reporting_managers is null, set the reporting_manager field to null or an empty string
        $employee->reporting_manager = null; // Or you can set it to an empty string if preferred: ''
    }
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
    $employee->Employee_id = $request->Employee_id;
    $employee->country = $request->country;
    $employee->state = $request->state;
    $employee->city = $request->city;
    $employee->country_code = $request->country_code;
// dd( $employee->Pincode);
    // Save the updated employee record
    $employee->update();   


    
    
    return redirect('/Newemployees/dashboard')->with('success', 'Employee updated successfully!');
    }

    public function destroy(NewEmployeeList $employee)
    {
        $employee->delete();
        return redirect('/NewListemployees');
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
// public function filterEmployees(Request $request)
// {
//     // Start query to fetch employees
//     $query = NewEmployeesListImport::query();

//     // Apply filter by designation if selected
//     if ($request->has('designation') && $request->designation != '') {
//         $query->where('designation_id', $request->designation);
//     }

//     // Fetch the filtered employees
//     $employees = $query->get();

//     // Fetch all designations for the filter dropdown
//     $designations = Designation::all();

//     // Return the view with employees and designations
//     return view('backend.filteremployees', compact('employees', 'designations'));
// }
    // Optional: DataTables Server-Side Integration Method
    // public function getEmployeesData()
    // {
    //     $employees = NewEmployeeList::select(['id', 'first_name', 'last_name', 'email', 'phone', 'department', 'salary']);
    //     return DataTables::of($employees)->make(true);
    // }
}
