@extends('layouts.tasks_layout')
@section('content')
<div class="card card-info list-group-item list-group-item-primary">
    <div class="card-header with-border d-flex justify-content-between align-items-left card text-white bg-primary mb-3">
        <div class="row">
            <div class="col-md-4">Edit Task</div>
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
       </div>
    </div>
    <div class="card-body">
            <form method="post"  action="{{route('update_task')}}" enctype="multipart/form-data">
                 {{ csrf_field() }}
                  @method('put')
                    <div class="form-group">
                        <a type="button" href="{{url('/')}}" class="btn btn-danger" data-dismiss="modal"><< Back</a>
                        <button type="submit" class="btn btn-primary" >Update</button>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="taskname" class="form-label mt-4">Task Name</label>
                            <input type="text" name="task_name" value="{{$task->name}}" class="form-control"  aria-describedby="taskname" placeholder="Enter Task" required>
                            <input type="hidden" name="task_id" value="{{$task->id}}" class="form-control"  aria-describedby="taskname" placeholder="Enter Task" required>
                        </div> 
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label mt-4">Project</label>
                            <select class="form-control" name="project_id" required>
                                <option value="{{$task->project_id}}">{{$task->project->name}}</option>
                                @foreach($projects as $project)
                                    <option value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                    </div>
                    
                </form>
                </div>
</div>
@endsection