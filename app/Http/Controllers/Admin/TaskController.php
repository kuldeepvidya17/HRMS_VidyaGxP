<?php
namespace App\Http\Controllers\Admin;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class TaskController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'TaskHRMS';
        $tasks = Task::latest()->get();
        return view('backend.task_add',compact(
            'title','tasks'
        ));
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists()
    {
        $title = 'projects';
        $tasks = Task::get();
        return view('backend.task_list',compact(
            'title','tasks'
        ));
    }


    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function leads(){
        $title = 'project leads';
        $projects = Task::get();
        return view('backend.projects.leads',compact(
            'title','projects'
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
        $request->validate([
            'task_name'=>'required',
            'task_description'=>'required',
            'task_deadline'=>'required',
            'task_priority'=>'required',
      
        ]); 
        // $files = null;
        // if($request->hasFile('image')){
        //     $files = array();
        //     foreach($request->image as $file){
        //         $fileName = time().'.'.$file->extension();
        //         $file->move(public_path('storage/tasks/'.$request->name), $fileName);
        //         array_push($files,$fileName);
        //     }
        // }

        $imageName = null;
        if($request->image != null){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('storage/tasks'), $imageName);
        }
      
        Task::create([
            'task_name'=>$request->task_name,
            'task_description'=>$request->task_description,
            'task_deadline'=>$request->task_deadline,
            'task_priority'=>$request->task_priority,
            // 'company'=>$request->company,
            // 'image' => $files,
                ]);
                return back()->with('success','Task has been added successfully!!!');
    }
    /**
     * Display the specified resource.
     *
     * @param  string  $project_name
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
       $title = 'view project';
        // $project = Task::where('name','=',$project_name)->firstOrFail();
        // return view('backend.tasks.show',compact(
        //     'title','project'
        // ));

        $tasks = Task::get();
        //dd($tasks);
        return view('backend.Task.show', ['tasks' => $tasks,'title'=>$title]);
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
        $request->validate([
            'task_name' => 'required',
            'task_description' => 'required',
            'task_deadline' => 'required',
            'task_priority' => 'required',
            // 'image'=>'file|image|mimes:jpg,jpeg,gif',
      
        ]); 
        
        

        $imageName = null;
        if($request->image != null){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('storage/tasks'), $imageName);
        }
       $task =Task::findorfail($request->id);
        
        $task->update([
             'task_name'=>$request->task_name,
             'task_description'=>$request->lastname,
             'task_deadline'=>$request->email,
             'task_priority'=>$request->phone,
            //  'image'=>$imageName,
            //  'company'=>$request->company
        ]);
        $notification = notify('task has been updated');
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
        Task::findOrfail($request->id)->delete();
        $notification = notify('Task Deleted');
        return back()->with($notification);
    }

}
