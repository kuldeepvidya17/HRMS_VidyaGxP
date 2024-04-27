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
		<h3 class="page-title">Employee Salary</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
			<li class="breadcrumb-item active">Salary</li>
		</ul>
	</div>
	<div class="col-auto float-right ml-auto">
		<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_salary"><i class="fa fa-plus"></i> Add Salary</a>
	</div>
</div>
@endsection


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped custom-table mb-0 datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Salary</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $count = 1;
                    @endphp
                    @foreach ($employees as $salary)
                    <tr>
                        <td>{{$count}}</td>
                        <td>
                            <h2 class="table-avatar blue-link">
                                <a href="javascript:void(0)" class="avatar1"><img alt="avatar"  src="{{ !empty($salary->employee->avatar) ? asset('storage/employees/'.$salary->employee->avatar): asset('assets/img/user.jpg') }}"></a>
                                <a href="javascript:void(0)">{{ !empty($salary->employee) ? $salary->employee->firstname.' '.$salary->employee->lastname: ' '}}</a>
                            </h2>
                        </td>
                        <td class="text-">{{$salary->amount}}</td>                        
                        <td class="text-end">
                            <div class="dropdown dropdown-action">
                                <a href="javascript:void(0)" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item editbtn" href="javascript:void(0)" data-id="{{$salary->id}}"
                                    data-employee="{{$salary->employee_id}}" data-amount="{{$salary->amount}}"
                                    ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item deletebtn" data-id="{{$salary->id}}" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @php
                        $count++;
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<!-- /Page Content -->

<!-- Add Salary Modal -->
<div id="add_salary" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Salary</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('salary')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Select Employee <span class="text-danger">*</span></label>
                        <select class="select2" name="employee">
                            <option value="null"> -</option>
                            @foreach (\App\Models\Employee::get() as $employee)
                                <option value="{{$employee->id}}">{{$employee->firstname.' '.$employee->lastname}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Salary <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="amount">
                    </div>
                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Salary Modal -->

<!-- Edit Salary Modal -->
<div id="edit_overtime" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Salary</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('salary')}}" method="post">
                    @csrf
                    @method("PUT")
                    <input type="hidden" name="id" id="edit_id">
                    <div class="form-group">
                        <label>Select Employee <span class="text-danger">*</span></label>
                        <select class="select" id="edit_employee" name="employee">
                            <option>-</option>
                            @foreach (\App\Models\Employee::get() as $employee)
                                <option value="{{$employee->id}}">{{$employee->firstname.' '.$employee->lastname}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Amount <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="edit_amount" name="amount">
                    </div>
                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Salary Modal -->

<x-modals.delete route="salary" title="salary" />

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
            var employee = $(this).data('employee');
            var amount = $(this).data('amount');
         
            $('#edit_overtime').modal('show');
            $('#edit_id').val(id);
            $('#edit_employee').val(employee).trigger('change');
            $('#edit_amount').val(amount);
            // check employee select
            $("#edit_employee option").each(function()
            {
                if($(this).val() == employee){
                    $(this).attr('selected','selected');
                }
            });
        });
    });
    </script>
@endsection