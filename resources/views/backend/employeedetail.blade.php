@extends('layouts.backend')

@section('page-header')
<div class="row align-items-center">
    <div class="col">
        <h3 class="page-title">Employee Details</h3>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Empmloyee</li>
        </ul>
    </div>
    <div class="col-auto float-right ml-auto">
        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_holiday"><i class="fa fa-plus"></i> Add Employee Detail</a>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped custom-table mb-0">
                <thead>
                    <tr>
                        <th>Sno </th>
                        <th>Employee Name</th>
                        <th>Contact No</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Permanent Add.</th>
                        <th>Gov.Id No</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                       @foreach ($employeedetail as $key => $employee) 
                       <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->address }}</td>
                        <td>{{ $employee->permanent_address }}</td>
                        <td>{{ $employee->gov_id }}</td>
                    </tr>
                       @endforeach
                    
                    </td>            
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Employee detail -->
<div class="modal custom-modal fade" id="add_holiday" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Employee Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('employeedetail.add')}}" method="POST">
                    @csrf
                    {{-- <div class="form-group">
                        <label>Employee Name <span class="text-danger">*</span></label>
                        <input name="name" class="form-control" type="text" value="">
                    </div> --}}

                    <div class="form-group">
                        <label>Employee</label>
                        <select name="employee" class="select2">
                            <option value="null">Select Employee</option>
                            @foreach (\App\Models\Employee::get() as $employee)
                                <option value="{{$employee->id}}">{{$employee->firstname.' '.$employee->lastname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Phone <span class="text-danger">*</span></label>
                        <input name="phone" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input name="email" class="form-control" type="email">
                    </div>
                    <div class="form-group">
                        <label>Address <span class="text-danger">*</span></label>
                        <input name="Address" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label>Permanent Address <span class="text-danger">*</span></label>
                        <input name="PAddress" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label>Gov Id <span class="text-danger">*</span></label>
                        <input name="gov_id" class="form-control" type="text">
                    </div>
                   
                    <div class="form-group"><span>
                        <label>Document Attachment </label>
                        <small>optional</small></span>
                        <div class="form-gr">
                        <input name="document_attachment" class="form-control" type="file"></div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Employee Detail -->


@endsection

@section('scripts')
<script>
    $(document).ready(function (){
        // mark as complete 
        $('.mark_as_complete').on('click',function (){
            var id = $(this).data('id');
            console.log(id);
            $('#.complete_id').val(id);
        })
        // edit holiday 
        $('.editbtn').on('click',function (){
            $('#edit_holiday').modal('show');
            var id = $(this).data('id');
            var name = $(this).data('name');
            var date = $(this).data('date');
            $('#edit_id').val(id);
            $('#edit_name').val(name);
            $('#edit_date').val(date);
        });
    });
</script>
@endsection