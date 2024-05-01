@extends('layouts.backend')

@section('styles')	
<!-- Datatable CSS -->
<link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
@endsection

@section('page-header')
<div class="row align-items-center">
	<div class="col">
		<h3 class="page-title">Task</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
			<li class="breadcrumb-item active">Task</li>
		</ul>
	</div>
	<div class="col-auto float-right ml-auto">
		<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_client"><i class="fa fa-plus"></i> Add Task</a>
		<div class="view-icons">
			{{-- <a href="{{route('tasks')}}" class="grid-view btn btn-link {{route_is('tasks') ? 'active' : '' }}"><i class="fa fa-th"></i></a> --}}
			<a href="{{route('task-list')}}" class="list-view btn btn-link {{route_is('clients-list') ? 'active' : '' }}"><i class="fa fa-bars"></i></a>
		</div>
	</div>
</div>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped custom-table datatable">
				<thead>
				<tr>
						<th>Task Name</th>
						<th>Task Description</th>
						<th>Task Deadline</th>
						<th>Task Priority</th>
						<!-- <th>Mobile</th> -->
						<th class="text-right">Action</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($tasks->count()))
						@foreach ($tasks as $task)
						<tr>
							<td>
								<h2 class="table-avatar">
									<a href="task-profile.html" class="avatar"><img src="assets/img/profiles/avatar-19.jpg" alt=""></a>
									<a href="client-profile.html">Global Technologies</a>
								</h2>
							</td>
							<td>CLT-{{$task->id}}</td>
							<td>{{$task->task_name}} </td>
							<td>{{$task->task_description}}</td>
							<td>{{$task->task_deadline}}</td>
							<td>{{$task->task_priority}}</td>
							
							<td class="text-right">
								<div class="dropdown dropdown-action">
									<a href="javascript:void(0)" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
									<div class="dropdown-menu dropdown-menu-right">
										<a data-id="{{$task->id}}" data-firstname="{{$task->task_name}}" data-lastname="{{$task->task_description}}" data-email="{{$task->task_deadline}}" data-phone="{{$task->task_priority}}"  class="dropdown-item editbtn" href="javascript:void(0)" data-toggle="modal"><i class="fa fa-pencil m-r-5"></i> Edit</a>
										<a data-id="{{$task->id}}" class="dropdown-item deletebtn" href="javascript:void(0)" data-toggle="modal"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
									</div>
								</div>
							</td>
						</tr>
						@endforeach
						<x-modals.delete :route="'task.destroy'" :title="'task'" />
						<!-- Edit Client Modal -->
						<div id="edit_task" class="modal custom-modal fade" role="dialog">
							<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Edit Task</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form method="POST" enctype="multipart/form-data" action="#">
											@csrf
											@method("PUT")
											<div class="row">
												<input type="hidden" id="edit_id" name="id">
												<div class="col-md-6">
													<div class="form-group">
														<label class="col-form-label">Task Name <span class="text-danger">*</span></label>
														<input class="form-control edit_firstname" name="firstname" type="text">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="col-form-label">Task Description</label>
														<input class="form-control edit_lastname" name="lastname" type="text">
													</div>
												</div>
												
												<div class="col-md-6">
													<div class="form-group">
														<label class="col-form-label">Task Deadline <span class="text-danger">*</span></label>
														<input class="form-control floating edit_email" name="email" type="email">
													</div>
												</div>
												
												<div class="col-md-6">  
													<div class="form-group">
														<label class="col-form-label">Task Priority<span class="text-danger">*</span></label>
														<input class="form-control floating edit_image" name="avatar" type="file">
													</div>
												</div>
												
												
											</div>
											
											<div class="submit-section">
												<button class="btn btn-primary submit-btn">Update</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<!-- /Edit Client Modal -->
					@endif					
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Add Client Modal -->
<div id="add_client" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Task</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			<form method="POST" action="#">
    			@csrf <!-- CSRF Protection -->
    
    <!-- Task Name -->
    <div class="form-group">
        <label for="task_name">Task Name:</label>
        <input type="text" name="task_name" id="task_name" class="form-control" placeholder="Enter task name" required>
    </div>
    
    <!-- Task Description -->
    <div class="form-group">
        <label for="task_description">Task Description:</label>
        <textarea name="task_description" id="task_description" class="form-control" rows="3" placeholder="Enter task description"></textarea>
    </div>
    
    <!-- Task Deadline -->
    <div class="form-group">
        <label for="task_deadline">Task Deadline:</label>
        <input type="date" name="task_deadline" id="task_deadline" class="form-control" required>
    </div>
    
    <!-- Task Priority -->
    <div class="form-group">
        <label for="task_priority">Task Priority:</label>
        <select name="task_priority" id="task_priority" class="form-control" required>
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select>
    </div>
    
    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
			</div>
		</div>
	</div>
</div>
<!-- /Add Client Modal -->
@endsection

@section('scripts')
<!-- Datatable JS -->
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script>
	$(document).ready(function (){
		$('.editbtn').on('click',function (){
			$('#edit_task').modal('show');
			var id = $(this).data('id');
			var task_name = $(this).data('task_name');
			var task_description = $(this).data('task_description');
			var task_deadline = $(this).data('task_deadline');
			var task_priority = $(this).data('task_priority');
			

			$('#edit_id').val(id);
			$('.edit_task_name').val(task_name);
			$('.edit_task_description').val(task_description);
			$('.edit_task_deadline').val(task_deadline); 
			$('.edit_task_priority').val(task_priority);
			// $('.edit_avatar').val(avatar);
			// $('.edit_company').val(company);
		})
	})
</script>
@endsection


