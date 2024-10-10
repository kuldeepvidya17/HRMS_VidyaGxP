

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
            <input type="text" class="form-control" name="department" required>
        </div>
        <div class="form-group">
            <label>Salary</label>
            <input type="number" class="form-control" name="salary" required>
        </div>
        <div class="form-group">
                <label class="col-form-label">Employee Picture</label>
                <input class="form-control" name="avatar" type="file">
        </div>

        <button type="submit" class="btn btn-success">Add Employee</button>
    </form>
</div>
@endsection