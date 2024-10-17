
text/x-generic filteremployees.blade.php ( HTML document, ASCII text, with very long lines, with CRLF line terminators )
@extends('layouts.backend')

@section('styles')
<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.min.css')}}">
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>

@endsection

@section('page-header')
<div class="row align-items-center">
	<div class="col">
		<h3 class="page-title">Employee</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
			<li class="breadcrumb-item active">Employee</li>
		</ul>
	</div>
	<div class="col-auto float-right ml-auto">
           <!-- Filter Button -->
           <a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" data-target="#filter_modal" style="margin-right: 30px">
            <i class="fa fa-filter"></i> Filter
        </a>
        
		<a href="javascript:void(0)" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Employee</a>
		<div class="view-icons">
			<a href="{{route('employees')}}" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
			<a href="{{route('employees-list')}}" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
		</div>
	</div>
</div>
@endsection

@section('content')


<div class="row staff-grid-row">
	@if (!empty($employees->count()))
		@foreach ($employees as $employee)
    <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
        <div class="profile-widget">
            <div class="profile-img">
                <a href="javascript:void(0)" class="avatar">
                    <img alt="avatar" src="@if(!empty($employee->avatar)) {{asset('storage/employees/'.$employee->avatar)}} @else assets/img/profiles/default.jpg @endif">
                </a>
            </div>
            {{-- <div class="dropdown profile-action">
                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a data-id="{{$employee->id}}"  data-employee_id="{{$employee->Employee_id}}"  data-firstname="{{$employee->firstname}}"  data-empsalary="{{$employee->empsalary}}" data-reporting_manager="{{$employee->reporting_manager}}" data-area="{{$employee->area}}"     data-employee_type="{{ $employee->employee_type }}"
                        data-date_of_joining="{{ $employee->date_of_joining }}"
                        data-aadhaar_no="{{ $employee->aadhaar_no }}"
                        data-passport_no="{{ $employee->passport_no }}"
                        data-contact_no="{{ $employee->contact_no }}"
                        data-card_no="{{ $employee->card_no }}"
                        data-permanent_address="{{ $employee->permanent_address }}"
                        data-birthday="{{ $employee->birthday }}"
                        data-nick_name="{{ $employee->nick_name }}"
                        data-office_tel="{{ $employee->office_tel }}"
                        data-religion="{{ $employee->religion }}"
                        data-pincode="{{ $employee->Pincode }}"
                        data-gender="{{ $employee->gender }}"
                        data-motorcycle_lic="{{ $employee->Motorcycle_lic }}"
                        data-automobil_license="{{ $employee->autoMobil_license }}"
                        data-city="{{ $employee->city }}"  data-lastname="{{$employee->lastname}}" data-email="{{$employee->email}}" data-phone="{{$employee->phone}}" data-avatar="{{$employee->avatar}}" data-company="{{$employee->company}}" data-designation="{{$employee->designation ? $employee->designation->id : ''}}" data-department="{{$employee->department ? $employee->department->id : ''}}" class="dropdown-item editbtn" href="javascript:void(0)" data-toggle="modal"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                    <a data-id="{{$employee->id}}" class="dropdown-item deletebtn" href="javascript:void(0)" data-toggle="modal" ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                </div>
            </div> --}}
            <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="javascript:void(0)">{{$employee->firstname}} {{$employee->lastname}}</a></h4>
            <h5 class="user-name m-t-10 mb-0 text-ellipsis"><a href="javascript:void(0)">{{$employee->designation ? $employee->designation->name : 'No Designation'}}</a></h5>
        </div>
    </div>
@endforeach

		<x-modals.delete :route="'employee.destroy'" :title="'Employee'" />


	@endif

</div>


<!-- Filter Modal -->
<div id="filter_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Filter Employees</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="filterForm" method="GET" action="{{ route('employees.filter') }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="designation">Select Designation</label>
                        <select class="form-control" id="designation" name="designation">
                            <option value="">All Designations</option>
                            @foreach($designations as $designation)
                                <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Add more filter fields here if necessary -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Apply Filter</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- <!-- Employee Display Section -->
<div class="row staff-grid-row">
    @if($employees->count())
        @foreach($employees as $employee)
        <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            <div class="profile-widget">
                <div class="profile-img">
                    <a href="javascript:void(0)" class="avatar">
                        <img alt="avatar" src="@if(!empty($employee->avatar)) {{asset('storage/employees/'.$employee->avatar)}} @else assets/img/profiles/default.jpg @endif">
                    </a>
                </div>
                <div class="dropdown profile-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a data-id="{{$employee->id}}" class="dropdown-item editbtn" href="javascript:void(0)" data-toggle="modal"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                        <a data-id="{{$employee->id}}" class="dropdown-item deletebtn" href="javascript:void(0)" data-toggle="modal"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                    </div>
                </div>
                <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="javascript:void(0)">{{ $employee->firstname }} {{ $employee->lastname }}</a></h4>
                <h5 class="user-name m-t-10 mb-0 text-ellipsis"><a href="javascript:void(0)">{{ $employee->designation ? $employee->designation->name : 'No Designation' }}</a></h5>
            </div>
        </div>
        @endforeach
    @else
        <p>No employees found with the selected filters.</p>
    @endif
</div> --}}



@endsection

@section('scripts')
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>


@endsection