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
						<th>Hours</th>
						<th class="text-end">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($db_attendances as $attendance)
						<tr>
							<td>{{ $loop->index + 1 }}</td>
							<td>{{ get_employee_by_code($attendance->emp_code) }}</td>
							<td>{{ format_date($attendance->check_in, 'd M Y g:iA') }}</td>
							<td>{{ format_date($attendance->check_out, 'd M Y g:iA') }}</td>
							<td>{{ format_date($attendance->check_in, 'l, d M Y') }}</td>
							<td>{{ get_hours($attendance->check_in, $attendance->check_out, $attendance->emp_code) }}</td>
							<td>-</td>
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
			//"order": [[0, 'desc']]
			"ordering": false
		})
	});
	</script>
@endsection