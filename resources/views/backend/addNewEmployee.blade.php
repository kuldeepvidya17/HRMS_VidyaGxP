

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
    <h2>Add Employee</h2>
    <form method="post" action="{{ route('Newemployeeslist.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>First Name</label>
            <input type="text" class="form-control" name="first_name" required>
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input type="text" class="form-control" name="last_name" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" class="form-control" name="phone" required>
        </div>
        <div class="form-group">
            <label>Department</label>
            {{-- <input type="text" class="form-control" name="department"> --}}
            <select name="department_id" class="select">
                <option>--Select Department--</option>
                @foreach ($departments as $department)
                    <option value="{{$department->id}}">{{$department->name}}</option>
                @endforeach
            </select>

        </div>
        <div class="form-group">
            <label>Designation</label>
            {{-- <input type="text" class="form-control" name="department" required> --}}
            <select name="designation_id" class="select">
                <option>--Select Designation--</option>
                @foreach ($designations as $designation)
                    <option value="{{$designation->id}}">{{$designation->name}}</option>
                @endforeach
            </select>

        </div>
        <div class="form-group">
            <label>Salary</label>
            <input type="number" class="form-control" name="salary" required>
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
                        @if(in_array($manager->id, old('reporting_managers', []))) selected @endif>
                        {{ $manager->first_name }} {{ $manager->last_name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <div class="form-group">
                <label>Area<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="area">
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <label>Employee Type</label>
                <select name="employee_type" class="form-control">
                    <option value="">-- Select --</option>
                    <option value="permanent">Permanent</option>
                    <option value="temporary">Temporary</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <label>Date of Joining</label>
                <input type="date" class="form-control" name="date_of_joining">
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <label>Aadhaar No</label>
                <input type="text" class="form-control" name="aadhaar_no">
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <label>Passport No</label>
                <input type="text" class="form-control" name="passport_no">
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <label>Card No</label>
                <input type="text" class="form-control" name="card_no">
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <label>Permanent Address</label>
                <input type="text" class="form-control" name="permanent_address">
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <label>Birthday</label>
                <input type="date" class="form-control" name="birthday">
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <label>Nick Name</label>
                <input type="text" class="form-control" name="nick_name">
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <label>Office Tel</label>
                <input type="text" class="form-control" name="office_tel">
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <label>Religion</label>
                <input type="text" class="form-control" name="religion">
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <label>Pincode</label>
                <input type="text" class="form-control" name="pincode">
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <label>Gender</label>
                <select name="gender" class="form-control">
                    <option value="">Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <label>Motorcycle License</label>
                <input type="text" class="form-control" name="motorcycle_lic">
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <label>Automobile License</label>
                <input type="text" class="form-control" name="automobile_lic">
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <label>City</label>
                <input type="text" class="form-control" name="city">
            </div>
        </div>
        

        <button type="submit" class="btn btn-success">Add Employee</button>
    </form>
</div>
@endsection