@extends('layouts.tasks_layout')
@section('content')
<div class="card card-info list-group-item list-group-item-primary">
    <div class="card-header with-border d-flex justify-content-between align-items-left card text-white bg-primary mb-3">
        <div class="row">
            <div class="col-md-4">Task Manager</div>
            <div class="col-md-4">
                <select class="form-control" name="project" id="project_id" required>
                    <option value="">---Select Project---</option>
                    <option value="0">All Projects</option>
                    @foreach($projects as $project)
                        <option value="{{$project->id}}">{{$project->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4" align="right"> <i data-toggle="modal" data-target="#add_task" class="fa fa-plus" title="Add Task"></i></div>
       </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <ul id="task_sortable" class="task_list_ul">
                            @foreach ($tasks as $task)
                                <li class="list-group-item-warning" data-id="{{$task->id}}">
                                  
                                    <div class="row">
                                            <div class="col-md-6"><span>{{ $task->name }}</span></div>
                                            <div class="col-md-6" align="right"> 
                                                <a class="btn btn-primary btn-sm" href="{{url('/task/'.$task->id)}}"> <i class="fa fa-edit action" title="Edit Task"></i> </a>
                                                <button class="btn btn-warning btn-sm"> <i class="fa fa-trash action" title="Delete Task" data-toggle="modal" data-target="#delete_task_{{$task->id}}"></i></button>
                                            </div>
                                    </div>

                                    <!--start modal for deleting a task-->
                                    <div class="modal" id="delete_task_{{$task->id}}">
                                        <form method="post"  action="{{route('drop_task')}}" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            @method('delete')
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                    <h4 style="color: #000;">Delete Task</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="modal-body" style="color: #000;">
                                                        Are you sure you want to Delete this Task ?
                                                        <input type="hidden" name="task_id" class="form-control" value="{{$task->id}}">
                                                    </div>
                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" >Yes Delete</button>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </form>
                                    </div>   
                                    <!--end modal for deleting a task-->       
                                    
                                </li>    
                            @endforeach
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 

<!--start modal for adding a task-->
<div class="modal" id="add_task">
    <form method="post"  action="{{route('post_task')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Add Task</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label for="taskname" class="form-label mt-4">Task Name</label>
                    <input type="text" name="task_name" class="form-control"  aria-describedby="taskname" placeholder="Enter Task" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label mt-4">Priority</label>
                    <select class="form-control" name="priority" required>
                        <option value="">---Select Priority---</option>
                        @foreach($priorities as $priority)
                            <option value="{{$priority->level}}">{{$priority->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label mt-4">Project</label>
                    <select class="form-control" name="project" required>
                        <option value="">---Select Project---</option>
                        @foreach($projects as $project)
                            <option value="{{$project->id}}">{{$project->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" >Submit</button>
            </div>
            
        </div>
        </div>
    </form>
</div>
<!--end modal for adding a task-->
@endsection