<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\Priority;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function getTasks()
    {
        $tasks = Task::orderBy('priority', 'asc')->get();
        $priorities = Priority::all();
        $projects = Project::all();
        return view('tasks.index', compact('tasks','priorities','projects'));
    }

    public function taskOrderChange(Request $request)
    {
        $data = $request->input('order');
        foreach ($data as $index => $id)
        {
            Task::where('id', $id)->update(['priority' => $index]);
        }

        return  response()->json(['message' => 'Task Priority changed successfully.','alert-type' => 'success' ]);
    }

    public function postTask(Request $request)
    {
        $task = new Task;
        $task->name = $request->task_name;
        $task->project_id = $request->project;
        $task->priority = $request->priority;
        $task->save();
        toastr()->success('Task Saved Successfully!');
        return back();
    }

     public function findProjectTasks(Request $request)
     {
        if($request->id == 0)
        {
            $data = Task::orderBy('priority', 'asc')->get();  
        }
        else
        {
            $data= Task::where('project_id',$request->id)->orderBy('priority', 'asc')->get();
        }
         
         return response()->json($data);
     }

     public function getTask($id)
    {
        $task = Task::find($id);
        $projects = Project::all();
        return view('tasks.edit', compact('task','projects'));
    }

    public function updateTask(Request $request)
    {
        Task::where('id', $request->task_id)->update(['name' => $request->task_name, 'project_id' => $request->project_id]);
        toastr()->success('Task Updated Successfully!');
        return back();

    }

     public function dropTask(Request $request)
     {
         $to_destroy = Task::find($request->task_id);
         $to_destroy->delete();
         toastr()->success('Task Deleted Successfully!');
         return back();   
     }
}
