<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use App\Http\Controllers\Controller;
use App\Settings\AttendanceSettings;
use App\Models\IclockTransaction;
use Illuminate\Support\Facades\DB;

class EmployeeAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return "test";
        $title = 'employee attendance';
        $attendances = EmployeeAttendance::latest()->get();
        // $db_attendances = IclockTransaction::limit(5)->get();

        $query = 'SELECT emp_code, DATE(punch_time) AS punch_date, MIN(punch_time) AS check_in, MAX(punch_time) AS check_out FROM iclock_transaction GROUP BY emp_code, DATE(punch_time)';

        $db_attendances = DB::connection('dotnetDB')->select($query);

        $db_attendances = collect($db_attendances)->sortByDesc('check_in');

        return view('backend.attendance',compact(
            'title','attendances', 'db_attendances'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'employee' => 'required',
            'checkin' => 'required',
        ]);
        $settings = new AttendanceSettings();
        $time = date('H:i');
        $min_checkin_time = strtotime($settings->checkin_time) + 1800;
        if($request->checkin){
            if($time < $settings->checkin_time){
                $status = 'early';
            }if($time <= date('H:i',$min_checkin_time)){
                $status = 'ontime';
            }else{
                $status = 'late';
            }
        }
            
       $empAttendance= EmployeeAttendance::create([
            'employee_id' => $request->employee,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'status' => $status,
        ]);
        $notification = notify('employee attendance has been created');

        storeActivityLog($userId=1, $action='store', $description='Add', $moduleName='attendance', $moduleId=$empAttendance->id,$status='attendance Has Been Successfully added.');
        return back()->with($notification);
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'employee' => 'required',
            'checkin' => 'required',
        ]);
        $settings = new AttendanceSettings();
        $time = date('H:i');
        $min_checkin_time = strtotime($settings->checkin_time) + 1800;
        if($request->checkin){
            if($time < $settings->checkin_time){
                $status = 'early';
            }if($time <= date('H:i',$min_checkin_time)){
                $status = 'ontime';
            }else{
                $status = 'late';
            }
        }
        if($request->checkout){
            if($time < $settings->checkout_time){
                $status = 'early';
            }if($time >= date('H:i',$min_checkin_time)){
                $status = 'ontime';
            }else{
                $status = 'overtime';
            }
        }   
        $attendance = EmployeeAttendance::findOrFail($request->id);
        $attendance->update([
            'employee_id' => $request->employee,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'status' => $status,
        ]);
        $notification = notify('employee attendance has been updated');
        storeActivityLog($userId=1, $action='update', $description='Update', $moduleName='attendance', $moduleId=$request->id,$status='attendance Has Been Successfully Uodate.');

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
        EmployeeAttendance::findOrFail($request->id)->delete();
        $notification = notify('employee attendance has been deleted');
        storeActivityLog($userId=1, $action='Delete', $description='attendance', $moduleName='Attendance', $moduleId=$request->id,$status='Attendance has been deleted successfully!!');
        return back()->with($notification);
    }
}
