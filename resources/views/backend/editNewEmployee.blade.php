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
            <li class="breadcrumb-item active">Employee</li>
        </ul>
    </div>
    <div class="col-auto float-right ml-auto">
        <a href="javascript:void(0)" class="btn add-btn" data-toggle="modal" data-target="#add_employee">
            <i class="fa fa-plus"></i> Add Employee
        </a>
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
        <div class="form-group">
            <label>Department</label>
            <input type="text" class="form-control" name="department" value="{{ $employee->department }}" >
        </div>
        <div class="form-group">
            <label>Salary</label>
            <input type="number" step="0.01" class="form-control" name="salary" value="{{ $employee->salary }}" >
        </div>
            <div class="form-group">
                <label class="col-form-label">Employee Picture</label>
                <input class="form-control" name="avatar" type="file">
            </div>
        

        <button type="submit" class="btn btn-success">Update Employee</button>
    </form>
</div>
@endsection
