@extends('layouts.backend')

@section('styles')
<!-- DataTable CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

@endsection

@section('page-header')
<div class="row align-items-center">
    <div class="col">
        <h3 class="page-title">Employee</h3>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Employee List</li>
        </ul>
    </div>
    {{-- <div class="col-auto float-right ml-auto">
        <a href="{{ route('NewEmployeeslist.create') }}" class="btn add-btn">
            <i class="fa fa-plus"></i> Add Employee
        </a>
    </div> --}}
    <div class="col-auto float-right ml-auto">
        <!-- Filter Button -->
        <a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" data-target="#filter_modal" style="margin-right: 30px">
         <i class="fa fa-filter"></i> Filter
     </a>
     
     <a href="{{ route('NewEmployeeslist.create') }}" class="btn add-btn">
        <i class="fa fa-plus"></i> Add Employee
    </a>     <div class="view-icons">
         <a href="{{route('NewEmployeeslist.empdashborad')}}" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
         <a href="{{route('NewEmployeeslist.index')}}" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
     </div>
 </div>
</div>
@endsection

@section('content')
<div class="container mt-5">
    <h2>Edit Employee</h2>
    <form method="post" action="{{ route('NewEmployeeslist.update', $employee->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>First Name</label>
            <input type="text" class="form-control" name="first_name" value="{{ $employee->first_name }}" >
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input type="text" class="form-control" name="last_name" value="{{ $employee->last_name }}" >
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" value="{{ $employee->email }}" >
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" class="form-control" name="phone" value="{{ $employee->phone }}" >
        </div>
        <!-- Department Dropdown -->
        <div class="form-group">
            <label>Department</label>
            <select name="department_id" class="form-control" required>
                <option disabled selected>Select Department</option>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}" 
                        @if ($employee->department_id == $department->id) selected @endif>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Designation Dropdown -->
        <div class="form-group">
            <label>Designation</label>
            <select name="designation_id" class="form-control" required>
                <option disabled selected>Select Designation</option>
                @foreach ($designations as $designation)
                    <option value="{{ $designation->id }}" 
                        @if ($employee->designation_id == $designation->id) selected @endif>
                        {{ $designation->name }}
                    </option>
                @endforeach
            </select>
        </div>

        
        <div class="form-group">
            <label>Salary</label>
            <input type="number" step="0.01" class="form-control" name="salary" value="{{ $employee->salary }}" >
        </div>
            <div class="form-group">
                <label class="col-form-label">Employee Picture</label>
                <input class="form-control" name="avatar" type="file">
            </div>

            <div class="form-group">
                <label>Reporting Manager <span class="text-danger">*</span></label>
                <select name="reporting_managers[]" class="form-control select2" multiple>
                    <option disabled>Select Reporting Manager</option>
                    @foreach ($employees as $manager)
                        <option value="{{ $manager->id }}" 
                            @if(in_array($manager->id, old('reporting_managers', explode(',', $employee->reporting_manager)))) selected @endif>
                            {{ $manager->first_name }} {{ $manager->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label>Area<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="area" value="{{ old('area', $employee->area) }}">
            </div>
    
            <div class="form-group">
                <label>Employee Type</label>
                <select name="employee_type" class="form-control">
                    <option value="">-- Select --</option>
                    <option value="permanent" @if($employee->employee_type == 'permanent') selected @endif>Permanent</option>
                    <option value="temporary" @if($employee->employee_type == 'temporary') selected @endif>Temporary</option>
                </select>
            </div>
    
            <div class="form-group">
                <label>Date of Joining</label>
                <input type="date" class="form-control" name="date_of_joining" value="{{ old('date_of_joining', $employee->date_of_joining) }}">
            </div>
    
            <div class="form-group">
                <label>Aadhaar No</label>
                <input type="text" class="form-control" name="aadhaar_no" value="{{ old('aadhaar_no', $employee->aadhaar_no) }}">
            </div>
    
            <div class="form-group">
                <label>Passport No</label>
                <input type="text" class="form-control" name="passport_no" value="{{ old('passport_no', $employee->passport_no) }}">
            </div>
    
            <div class="form-group">
                <label>Card No</label>
                <input type="text" class="form-control" name="card_no" value="{{ old('card_no', $employee->card_no) }}">
            </div>
    
            <div class="form-group">
                <label>Permanent Address</label>
                <input type="text" class="form-control" name="permanent_address" value="{{ old('permanent_address', $employee->permanent_address) }}">
            </div>
    
            <div class="form-group">
                <label>Birthday</label>
                <input type="date" class="form-control" name="birthday" value="{{ old('birthday', $employee->birthday) }}">
            </div>
    
            <div class="form-group">
                <label>Nick Name</label>
                <input type="text" class="form-control" name="nick_name" value="{{ old('nick_name', $employee->nick_name) }}">
            </div>
    
            <div class="form-group">
                <label>Office Tel</label>
                <input type="text" class="form-control" name="office_tel" value="{{ old('office_tel', $employee->office_tel) }}">
            </div>
    
            <div class="form-group">
                <label>Religion</label>
                <input type="text" class="form-control" name="religion" value="{{ old('religion', $employee->religion) }}">
            </div>
    
            <div class="form-group">
                <label>Pincode</label>
                <input type="text" class="form-control" name="pincode" value="{{ old('pincode', $employee->pincode) }}">
            </div>
    
            <div class="form-group">
                <label>Gender</label>
                <select name="gender" class="form-control">
                    <option value="">Select</option>
                    <option value="male" @if($employee->gender == 'male') selected @endif>Male</option>
                    <option value="female" @if($employee->gender == 'female') selected @endif>Female</option>
                </select>
            </div>
    
            <div class="form-group">
                <label>Motorcycle License</label>
                <input type="text" class="form-control" name="motorcycle_lic" value="{{ old('motorcycle_lic', $employee->motorcycle_lic) }}">
            </div>
    
            <div class="form-group">
                <label>Automobile License</label>
                <input type="text" class="form-control" name="automobile_lic" value="{{ old('automobile_lic', $employee->automobile_lic) }}">
            </div>
    
            <div class="form-group">
                <label>City</label>
                <input type="text" class="form-control" name="city" value="{{ old('city', $employee->city) }}">
            </div>
    
        

        <button type="submit" class="btn btn-success">Update Employee</button>
    </form>
</div>
@endsection
