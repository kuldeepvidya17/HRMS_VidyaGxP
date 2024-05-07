@extends('layouts.backend')

@section('styles')
<!-- Select2 CSS -->
<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.min.css')}}">
<!-- Datatable CSS -->
<link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
@endsection

@section('page-header')
<div class="row align-items-center">
	<div class="col">
		<h3 class="page-title">Employee Attendance</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
			<li class="breadcrumb-item active">Attendance</li>
		</ul>
	</div>
	<div class="col-auto float-right ml-auto">
		<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_attendance"><i class="fa fa-plus"></i> Add Attendance </a>
	</div>
</div>
@endsection


@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table class="table datatable2 table-striped custom-table mb-0">
				<thead>
					<tr>
						<th>ID</th>
						<th>Employee</th>
						<th>TimeIn</th>
						<th>TimeOut</th>
						<th>Date</th>
						{{-- <th>Status</th> --}}
						<th class="text-end">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($db_attendances as $attendance) 
					<tr>
					   {{-- <td>
							<h2 class="table-avatar">
								<a href="#" class="avatar1"><img alt="avatar"  src="{{ !empty($attendance->employee->avatar) ? asset('storage/employees/'.$attendance->employee->avatar): asset('assets/img/profiles/avatar-19.jpg') }}"></a>
								<a href="#">
									{{ $attendance->employee->firstname.' '. $attendance->employee->lastname}}
									@if ($attendance->employee->designation)
										<span>{{$attendance->employee->designation->name}}</span>
									@else
										<span>No Designation</span>
									@endif
								</a>
								
							</h2>
						</td> --}}
						{{-- <td>
							<h2 class="table-avatar">
								<a href="#" class="avatar">
									<img alt="avatar"  src="{{ !empty($attendance->employee->avatar) ? asset('storage/employees/'.$attendance->employee->avatar): asset('assets/img/profiles/avatar-19.jpg') }}">
								</a>
								<a href="#">
									{{$attendance->employee->firstname.' '. $attendance->employee->lastname}}
									@if (!empty($attendance->employee->designation))
										<span>{{$attendance->employee->designation->name}}</span>
									@endif
								</a>
								<p></p>
							</h2>
						</td> --}}
					   <td>{{ $attendance->id }}</td>
					   <td>{{ $attendance->employee ? $attendance->employee->first_name . ' ' . $attendance->employee->last_name : '' }}</td>
					   <td>{{ $attendance->punch_time ? Carbon\Carbon::parse($attendance->punch_time)->format('d F Y H:i') : '' }}</td>
					   <td>{{ $attendance->punch_time ? Carbon\Carbon::parse($attendance->punch_time)->format('d F Y H:i') : '' }}</td>
					   <td>{{ $attendance->punch_time ? Carbon\Carbon::parse($attendance->punch_time)->format('d F Y') : '' }}</td>
					   {{-- <td>{{$attendance->status}}</td> --}}
					   <td class="text-end">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item editbtn" href="javascript:void(0)" data-id="{{$attendance->id}}" data-checkin="{{$attendance->checkin}}" data-checkout="{{$attendance->checkout}}" data-employee="{{$attendance->employee_id}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a class="dropdown-item deletebtn" href="javascript:void(0)" data-id="{{$attendance->id}}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<x-modals.delete route="employees.attendance" title="Attendance"/>
<x-modals.popup />
@endsection


@section('scripts')
<!-- Select2 JS -->
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<!-- Datatable JS -->
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script>
	$(document).ready(function(){
		$('.editbtn').click(function(){
			var id = $(this).data('id');
			var checkin = $(this).data('checkin');
			var checkout = $(this).data('checkout');
			var employee = $(this).data('employee');
			$('#edit_attendance').modal('show');
			$('#edit_id').val(id);
			$('#edit_employee').val(employee).trigger('change');
			$('#edit_checkin').val(checkin);
			$('#edit_checkout').val(checkout);
		});

		$('.datatable2').DataTable({
			"order": [[0, 'desc']]
		})
	});
	</script>
@endsection