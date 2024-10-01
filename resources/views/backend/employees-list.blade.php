@extends('layouts.backend')

@section('styles')
<!-- Datatable CSS -->
<link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.min.css')}}">
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
		<a href="javascript:void(0)" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Employee</a>
		<div class="view-icons">
			<a href="{{route('employees')}}" class="grid-view btn btn-link {{route_is(['employees','employees-list']) ? 'active' : ''}}"><i class="fa fa-th"></i></a>
			<a href="{{route('employees-list')}}" class="list-view btn btn-link {{route_is(['employees','employees-list']) ? 'active' : '' }}"><i class="fa fa-bars"></i></a>
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
						<th>Name</th>
						<th>Employee ID</th>
						<th>Email</th>
						<th>Mobile</th>
						<th class="text-nowrap">Join Date</th>
						<th>Designation</th>
						{{-- <th>Department</th> --}}
						<th>Position</th>
						<th>Salary</th>
						<th>Reporting Manager</th>
						<th>Area</th>
						<th>Employee Type</th>
						<th>Date of Joining</th>
						<th>Employee Picture</th>
						<th>Aadhaar No</th>
						<th>Passport No</th>
						<th>Contact No</th>
						<th>Card No</th>
						<th>Permanent Address</th>
						<th>Birthday</th>
						<th>Nick Name</th>
						<th>Office Tel</th>
						<th>Religion</th>
						<th>Pincode</th>
						<th>Gender</th>
						<th>Motorcycle License</th>
						<th>Automobile License</th>
						<th>City</th>
						<th class="text-right no-sort">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($employees as $employee)
					<tr>
						<td>
							<h2 class="table-avatar">
								<a href="javascript:void(0)" class="avatar"><img alt="avatar" src="@if(!empty($employee->avatar)) {{asset('storage/employees/'.$employee->avatar)}} @else assets/img/profiles/default.jpg @endif"></a>
								<a href="javascript:void(0)">{{$employee->firstname}} {{$employee->lastname}}</a>
							</h2>
						</td>
						<td>{{$employee->uuid}}</td>
						<td>{{$employee->email}}</td>
						<td>{{$employee->phone}}</td>
						<td>{{date_format(date_create($employee->date_created),"d M,Y")}}</td>
						{{-- <td>
							{{$employee->designation->name}}
						</td> --}}
						<td>
						    @if ($employee->designation)
						        {{$employee->designation->name}}
						    @else
						        No Designation
						    @endif
						</td>
						{{-- <td>{{ $employee->department }}</td> --}}
						<td>{{ $employee->position }}</td>
						<td>{{ $employee->empsalary }}</td>
						<td>{{ $employee->reporting_manager }}</td>
						<td>{{ $employee->area }}</td>
						<td>{{ $employee->employee_type }}</td>
						<td>{{ $employee->date_of_joining }}</td>
						<td>{{ $employee->aadhaar_no }}</td>
						<td>{{ $employee->passport_no }}</td>
						<td>{{ $employee->contact_no }}</td>
						<td>{{ $employee->card_no }}</td>
						<td>{{ $employee->permanent_address }}</td>
						<td>{{ $employee->birthday }}</td>
						<td>{{ $employee->nick_name }}</td>
						<td>{{ $employee->office_tel }}</td>
						<td>{{ $employee->religion }}</td>
						<td>{{ $employee->Pincode }}</td>
						<td>{{ $employee->gender }}</td>
						<td>{{ $employee->Motorcycle_lic }}</td>
						<td>{{ $employee->automobile_lic }}</td>
						<td>{{ $employee->city }}</td>

						
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="javascript:void(0)" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a data-id="{{$employee->id}}" data-employee_id="{{$employee->Employee_id}}" data-position="{{$employee->position}}" data-empsalary="{{$employee->empsalary}}" data-reporting_manager="{{$employee->reporting_manager}}" data-area="{{$employee->area}}"     data-employee_type="{{ $employee->employee_type }}"
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
										data-city="{{ $employee->city }}" data-firstname="{{$employee->firstname}}" data-lastname="{{$employee->lastname}}" data-email="{{$employee->email}}" data-phone="{{$employee->phone}}" data-avatar="{{$employee->avatar}}" data-company="{{$employee->company}}" data-designation="{{$employee->designation}}" data-department="{{$employee->department}}" class="dropdown-item editbtn" href="javascript:void(0)" data-toggle="modal"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a data-id="{{$employee->id}}" class="dropdown-item deletebtn" href="javascript:void(0)" data-toggle="modal" ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>
						</td>
					</tr>
					@endforeach
					<x-modals.delete :route="'employee.destroy'" :title="'Employee'" />
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Add Employee Modal -->
<div id="add_employee" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Employee</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{route('employee.add')}}" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Employee Id<span class="text-danger">*</span></label>
								<input class="form-control  edit_Employee_id" name="Employee_id" type="text" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">First Name <span class="text-danger">*</span></label>
								<input class="form-control" name="firstname" type="text">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Last Name</label>
								<input class="form-control" name="lastname" type="text">
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Email <span class="text-danger">*</span></label>
								<input class="form-control" name="email" type="email">
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Phone </label>
								<input class="form-control" name="phone" type="text">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Company</label>
								<input type="text" class="form-control" name="company">
							</div>
						</div>
						<div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Position<span class="text-danger">*</span></label>
                                <input type="text" class="form-control edit_position" name="position" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Salary<span class="text-danger">*</span></label>
                                <input type="text" class="form-control edit_empsalary" name="empsalary" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Reporting Manager<span class="text-danger">*</span></label>
                                <input type="text" class="form-control edit_reporting_manager" name="reporting_manager">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Area<span class="text-danger">*</span></label>
                                <input type="text" class="form-control edit_area" name="area" >
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Employee Type</label>
                                <input type="text" class="form-control edit_employee_type" name="employee_type" >
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Date of Joining</label>
                                <input type="date" class="form-control edit_date_of_joining" name="date_of_joining" >
                            </div>
                        </div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Department <span class="text-danger">*</span></label>
								<select name="department" class="select">
									<option>Select Department</option>
									@foreach ($departments as $department)
										<option value="{{$department->id}}">{{$department->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Designation <span class="text-danger">*</span></label>
								<select name="designation" class="select">
									<option>Select Designation</option>
									@foreach ($designations as $designation)
										<option value="{{$designation->id}}">{{$designation->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-form-label">Employee Picture<span class="text-danger">*</span></label>
								<input class="form-control floating" name="avatar" type="file">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Aadhaar No</label>
								<input type="text" class="form-control" name="aadhaar_no">
							</div>
						</div>
                        <div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Passport No</label>
								<input type="text" class="form-control" name="passport_no">
							</div>
						</div>
                        <div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Contact No</label>
								<input type="text" class="form-control" name="contact_no">
							</div>
						</div>
                        <div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Card No</label>
								<input type="text" class="form-control" name="card_no">
							</div>
						</div>
                        <div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Permanent Address</label>
								<input type="text" class="form-control" name="permanent_address">
							</div>
						</div>
                        <div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Birthday</label>
								<input type="date" class="form-control" name="birthday">
							</div>
						</div>
                        <div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Nick Name</label>
								<input type="text" class="form-control" name="nick_name">
							</div>
						</div>
                      
                        <div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Office Tel</label>
								<input type="text" class="form-control" name="office_tel">
							</div>
						</div>
                        <div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Religion</label>
								<input type="text" class="form-control" name="religion">
							</div>
						</div>
                        <div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Pincode</label>
								<input type="text" class="form-control" name="Pincode">
							</div>
						</div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Gender</label>
                                <select name="gender" id="" class="form-control">
                                    <option value="">Select</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Motorcycle License</label>
								<input type="text" class="form-control" name="Motorcycle_lic">
							</div>
						</div> 
                        <div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">AutoMobil License</label>
								<input type="text" class="form-control" name="religion">
							</div>
						</div>
                        <div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">City</label>
								<input type="text" class="form-control" name="city">
							</div>
						</div>
					</div>

					<div class="submit-section">
						<button class="btn btn-primary submit-btn">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Add Employee Modal -->

<!-- Edit Employee Modal -->
{{-- <div id="edit_employee" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Employee</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{route('employee.update')}}" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="row">
						<input type="hidden" name="id" id="edit_id">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">First Name <span class="text-danger">*</span></label>
								<input class="form-control edit_firstname" name="firstname" type="text">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Last Name</label>
								<input class="form-control edit_lastname" name="lastname" type="text">
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Email <span class="text-danger">*</span></label>
								<input class="form-control edit_email" name="email" type="email">
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Phone </label>
								<input class="form-control edit_phone" name="phone" type="text">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Company</label>
								<input type="text" class="form-control edit_company" name="company">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Department <span class="text-danger">*</span></label>
								<select name="department" class="select edit_department">
									@foreach ($departments as $dept)
										<option value="{{$dept->id}}">{{$dept->name}}</option>
									@endforeach
								</select>
							</div>
						</div>						
						<div class="col-md-6">
							<div class="form-group">
								<label>Designation <span class="text-danger">*</span></label>
								<select name="designation" class="select edit_designation">
									@foreach ($designations as $designation)
										<option value="{{$designation->id}}">{{$designation->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-form-label">Employee Picture<span class="text-danger">*</span></label>
								<input class="form-control floating edit_avatar" name="avatar" type="file">
							</div>
						</div>
					</div>

					<div class="submit-section">
						<button class="btn btn-primary submit-btn">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div> --}}



<div id="edit_employee" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('employee.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <input type="hidden" name="id" id="edit_id">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">First Name <span class="text-danger">*</span></label>
                                <input class="form-control edit_firstname" name="firstname" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Last Name <span class="text-danger">*</span></label>
                                <input class="form-control edit_lastname" name="lastname" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                <input class="form-control edit_email" name="email" type="email">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Phone </label>
                                <input class="form-control edit_phone" name="phone" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Company<span class="text-danger">*</span></label>
                                <input type="text" class="form-control edit_company" name="company">
                            </div>
                        </div>
						<div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Position<span class="text-danger">*</span></label>
                                <input type="text" class="form-control edit_position" name="position" value="{{ $employee->position}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Salary<span class="text-danger">*</span></label>
                                <input type="text" class="form-control edit_empsalary" name="empsalary" value="{{ $employee->empsalary}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Reporting Manager<span class="text-danger">*</span></label>
                                <input type="text" class="form-control edit_reporting_manager" name="reporting_manager" value="{{ $employee->reporting_manager}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Area<span class="text-danger">*</span></label>
                                <input type="text" class="form-control edit_area" name="area" value="{{ $employee->area }}">
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Employee Type</label>
                                <input type="text" class="form-control edit_employee_type" name="employee_type" value="{{ $employee->employee_type }}">
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Date of Joining</label>
                                <input type="date" class="form-control edit_date_of_joining" name="date_of_joining" value="{{ $employee->date_of_joining }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Department <span class="text-danger">*</span></label>
                                <select name="department_id" class="select" id="edit_department">
                                    <option>Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Designation <span class="text-danger">*</span></label>
                                <select name="designation_id" class="select" id="edit_designation">
                                    <option>Select Designation</option>
                                    @foreach ($designations as $designation)
                                        <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Employee Picture<span class="text-danger">*</span></label>
                                <input class="form-control floating edit_avatar" name="avatar" type="file">
                            </div>
                        </div>
						<div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Aadhaar No</label>
                                <input type="text" class="form-control edit_aadhaar_no" name="aadhaar_no" value="{{ $employee->aadhaar_no }}">
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Passport No</label>
                                <input type="text" class="form-control edit_passport_no" name="passport_no" value="{{ $employee->passport_no }}">
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Contact No</label>
                                <input type="text" class="form-control edit_contact_no" name="contact_no" value="{{ $employee->contact_no }}">
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Card No</label>
                                <input type="text" class="form-control edit_card_no" name="card_no" value="{{ $employee->card_no }}">
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Permanent Address</label>
                                <input type="text" class="form-control edit_permanent_address" name="permanent_address" value="{{ $employee->permanent_address }}">
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Birthday</label>
                                <input type="date" class="form-control edit_birthday" name="birthday" value="{{ $employee->birthday }}">
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Nick Name</label>
                                <input type="text" class="form-control edit_nick_name" name="nick_name" value="{{ $employee->nick_name }}">
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Office Tel</label>
                                <input type="text" class="form-control edit_office_tel" name="office_tel" value="{{ $employee->office_tel }}">
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Religion</label>
                                <input type="text" class="form-control edit_religion" name="religion" value="{{ $employee->religion }}">
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Pincode</label>
                                <input type="text" class="form-control edit_Pincode" name="Pincode" value="{{ $employee->Pincode }}">
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Gender</label>
                                <select name="gender" id="" class="form-control edit_gender">
                                    <option value="">Select</option>
                                    <option value="male" {{ $employee->gender == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ $employee->gender == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Motorcycle License</label>
                                <input type="text" class="form-control edit_motorcycle_license" name="Motorcycle_lic" value="{{ $employee->Motorcycle_lic }}">
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">AutoMobil License</label>
                                <input type="text" class="form-control edit_autoMobil_license" name="autoMobil_license" value="{{ $employee->autoMobil_license }}">
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">City</label>
                                <input type="text" class="form-control edit_city" name="city" value="{{ $employee->city }}">
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Employee Modal -->
@endsection

@section('scripts')
<!-- Datatable JS -->
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<script>
	$(document).ready(function (){
		$('.editbtn').on('click',function (){
			$('#edit_employee').modal('show');
			var id = $(this).data('id');
            var Employee_id = $(this).data('employee_id');
			var firstname = $(this).data('firstname');
			var lastname = $(this).data('lastname');
			var email = $(this).data('email');
			var phone = $(this).data('phone');
			var avatar = $(this).data('avatar');
			var company = $(this).data('company');
			var designation = $(this).data('designation');
			var department = $(this).data('department');
			var position = $(this).data('edit_position');
            var empsalary = $(this).data('edit_empsalary');
            var reporting_manager = $(this).data('edit_reporting_manager');
            var area = $(this).data('edit_area');
            var employee_type = $(this).data('employee_type');
			var date_of_joining = $(this).data('date_of_joining');
			var aadhaar_no = $(this).data('aadhaar_no');
			var passport_no = $(this).data('passport_no');
			var contact_no = $(this).data('contact_no');
			var card_no = $(this).data('card_no');
			var permanent_address = $(this).data('permanent_address');
			var birthday = $(this).data('birthday');
			var nick_name = $(this).data('nick_name');
			var office_tel = $(this).data('office_tel');
			var religion = $(this).data('religion');
			var pincode = $(this).data('pincode');
			var gender = $(this).data('gender');
			var motorcycle_lic = $(this).data('motorcycle_lic');
			var automobil_license = $(this).data('automobil_license');
			var city = $(this).data('city');

			$('#edit_id').val(id);
            $('.edit_Employee_id').val(Employee_id);
			$('.edit_firstname').val(firstname);
			$('.edit_lastname').val(lastname);
			$('.edit_email').val(email);
			$('.edit_phone').val(phone);
			$('.edit_company').val(company);
			$('.edit_designation').val(designation.id);
			$('.edit_department').val(department.id);
			$('#edit_position').val(position);
            $('#edit_empsalary').val(empsalary);
            $('#edit_reporting_manager').val(reporting_manager);
            $('#edit_area').val(area);
            $('#edit_employee_type').val(employee_type);
			$('#edit_date_of_joining').val(date_of_joining);
			$('#edit_aadhaar_no').val(aadhaar_no);
			$('#edit_passport_no').val(passport_no);
			$('#edit_contact_no').val(contact_no);
			$('#edit_card_no').val(card_no);
			$('#edit_permanent_address').val(permanent_address);
			$('#edit_birthday').val(birthday);
			$('#edit_nick_name').val(nick_name);
			$('#edit_office_tel').val(office_tel);
			$('#edit_religion').val(religion);
			$('#edit_pincode').val(pincode);
			$('#edit_gender').val(gender);
			$('#edit_motorcycle_lic').val(motorcycle_lic);
			$('#edit_automobil_license').val(automobil_license);
			$('#edit_city').val(city);
			$('.edit_avatar').val(avatar);
		})
	})
</script>

@endsection