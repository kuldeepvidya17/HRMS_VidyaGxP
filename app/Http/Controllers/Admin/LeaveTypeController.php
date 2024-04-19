<?php

namespace App\Http\Controllers\Admin;

use App\Models\LeaveType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeaveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Leave Type";
        $leave_types = LeaveType::get();
        return view('backend.leave-type',compact('title','leave_types'));
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
            'type'=>'required|max:255',
            'days'=>'required'
        ]);
        LeaveType::create($request->all());
        storeActivityLog($userId=1, $action='store', $description=$request->type, $moduleName='Leave', $moduleId=$request->id,$status='Leave Has Been Successfully added.');

        return back()->with('success',"Leave type has been added");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $leave_type = LeaveType::find($request->id);
        $leave_type->update($request->all());
        storeActivityLog($userId=1, $action='Update', $description=$request->type, $moduleName='Leave', $moduleId=$request->id,$status='Leave Has Been Successfully updated.');

        return back()->with('success',"Leave type has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $leave_type = LeaveType::find($request->id);
        $leave_type->delete();
        storeActivityLog($userId=1, $action='Delete', $description=$request->type, $moduleName='Leave', $moduleId=$request->id,$status='Leave Has Been Successfully deleted.');
        return back()->with('success',"Leave Type has been deleted successfully!!");
    }
}
