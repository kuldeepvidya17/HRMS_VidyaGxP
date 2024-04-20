<?php

namespace App\Http\Controllers;

use App\Models\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmpSalary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index()
    {
        $title = 'salary';
        $employees = EmpSalary::all();
        return view('backend.EmpSalary.employeesalary', compact('employees', 'title'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'employee' => 'required|exists:employees,id',
            'amount' => 'required|numeric|min:0',
        ]);

        $empSalary= EmpSalary::create([
            'employee_id' => $request->employee,
            'amount' => $request->amount,
        ]);

        storeActivityLog($userId=1, $action='store', $description='Add', $moduleName='Salary', $moduleId=$empSalary->id,$status='Salary Has Been Successfully added.');
        return redirect()->back()->with('success', 'Salary details added successfully!');
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'employee' => 'required',
            'amount' => 'required'
        ]);
        $salary = EmpSalary::findOrfail($request->id);
        $salary->update([
            'employee_id' => $request->employee,
            'amount' => $request->amount,
        ]);
        $notification = notify('salary has been updated');
        storeActivityLog($userId=1, $action='update', $description='Update', $moduleName='salary', $moduleId=$salary->id,$status='Salary Has Been Successfully Uodate.');
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        EmpSalary::findOrfail($request->id)->delete();
        $notification = notify('salary has been added');
        storeActivityLog($userId=1, $action='Delete', $description='Delete', $moduleName='Salary', $moduleId=$request->id,$status='Salary has been deleted successfully!!');
        return back()->with($notification);
    }
}
