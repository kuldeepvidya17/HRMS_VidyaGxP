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
        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employeedetail"><i class="fa fa-plus"></i> Add Employee Detail</a>
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
                        <td>
                            <div class="action d-flex justify-content-end">
                                <!-- Edit button -->
                                <a href="#" class="btn btn-sm btn-primary mr-2 editbtn" 
                                    data-id="{{ $employee->id }}" 
                                    data-name="{{ $employee->name }}" 
                                    data-phone="{{ $employee->phone }}" 
                                    data-email="{{ $employee->email }}" 
                                    data-address="{{ $employee->address }}" 
                                    data-paddress="{{ $employee->permanent_address }}" 
                                    data-govid="{{ $employee->gov_id }}" 
                                    data-toggle="modal" 
                                    data-target="#edit_employee">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                                <!-- Delete button -->
                                <form action="{{ route('employeedetail.destroy', $employee->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this employee detail?')">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                       @endforeach
                    
                    </td>            
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Employee detail -->
<div class="modal custom-modal fade" id="add_employeedetail" role="dialog">
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


<!-- Edit Employee detail -->
{{-- <div class="modal custom-modal fade" id="edit_employee" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Employee Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('employeedetail.update', $employee->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Employee Name</label>
                        <input id="edit_name" name="name" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label>Phone <span class="text-danger">*</span></label>
                        <input id="edit_phone" name="phone" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input id="edit_email" name="email" class="form-control" type="email">
                    </div>
                    <div class="form-group">
                        <label>Address <span class="text-danger">*</span></label>
                        <input id="edit_address" name="Address" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label>Permanent Address <span class="text-danger">*</span></label>
                        <input id="edit_PAddress" name="PAddress" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label>Gov Id <span class="text-danger">*</span></label>
                        <input id="edit_gov_id" name="gov_id" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label>Document Attachment</label>
                        <input id="edit_document_attachment" name="document_attachment" class="form-control" type="file">
                    </div>
                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}
{{-- <div class="modal custom-modal fade" id="edit_holiday" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Holiday</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('holidays')}}" method="post">
                    @method("PUT")
                    @csrf
                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label>Holiday Name <span class="text-danger">*</span></label>
                        <input class="form-control" id="edit_name" name="name" type="text">
                    </div>
                    <div class="form-group">
                        <label>Holiday Date <span class="text-danger">*</span></label>
                        <div class="cal-icon"><input id="edit_date" class="form-control datetimepicker" name="holiday_date" type="text"></div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}

<!-- Edit Employee detail -->
<div class="modal custom-modal fade" id="edit_employee" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Employee Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_employee_form" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Employee Name</label>
                        <input id="edit_name" name="name" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label>Phone <span class="text-danger">*</span></label>
                        <input id="edit_phone" name="phone" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input id="edit_email" name="email" class="form-control" type="email">
                    </div>
                    <div class="form-group">
                        <label>Address <span class="text-danger">*</span></label>
                        <input id="edit_address" name="Address" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label>Permanent Address <span class="text-danger">*</span></label>
                        <input id="edit_PAddress" name="PAddress" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label>Gov Id <span class="text-danger">*</span></label>
                        <input id="edit_gov_id" name="gov_id" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label>Document Attachment</label>
                        <input id="edit_document_attachment" name="document_attachment" class="form-control" type="file">
                    </div>
                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')

@section('scripts')
<script>
    $(document).ready(function (){
        // Edit employee
        $('.editbtn').on('click',function (){
            $('#edit_employee').modal('show');
            var id = $(this).data('id');
            var name = $(this).data('name');
            var phone = $(this).data('phone');
            var email = $(this).data('email');
            var address = $(this).data('address');
            var paddress = $(this).data('paddress');
            var govid = $(this).data('govid');

            // Set the form action dynamically based on employee ID
            $('#edit_employee_form').attr('action', '/employeedetail/' + id);

            $('#edit_id').val(id);
            $('#edit_name').val(name);
            $('#edit_phone').val(phone);
            $('#edit_email').val(email);
            $('#edit_address').val(address);
            $('#edit_PAddress').val(paddress);
            $('#edit_gov_id').val(govid);
        });
    });
</script>

{{-- <script>
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
</script> --}}
{{-- @section('scripts')
<script>
    $(document).ready(function (){
        // Edit employee
        $('.editbtn').on('click',function (){
            $('#edit_employee').modal('show');
            var id = $(this).data('id');
            var name = $(this).data('name');
            var phone = $(this).data('phone');
            var email = $(this).data('email');
            var address = $(this).data('address');
            var paddress = $(this).data('paddress');
            var govid = $(this).data('govid');

            $('#edit_id').val(id);
            $('#edit_name').val(name);
            $('#edit_phone').val(phone);
            $('#edit_email').val(email);
            $('#edit_address').val(address);
            $('#edit_PAddress').val(paddress);
            $('#edit_gov_id').val(govid);
        });
    });
</script>
@endsection --}}



@endsection