@extends('layouts.backend')
    @section('styles')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
    @endsection

    @section('page-header')
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Contacts</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Contacts</li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add_contact"><i class="fa fa-plus"></i> Add Contact</a>
        </div>
    </div>
    @endsection

    @section('content')
    <div class="row">
        <div class="col-md-12">
            <div>
                <table id="datatable" class="table table-striped custom-table mb-0 datatable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($contacts->count()))
                            @foreach ($contacts as $department)
                                <tr>
                                    <td>{{$department->name}}</td>
                                    <td>{{$department->number}}</td>
                                    <td>{{$department->email}}</td>
                                    <td>{{$department->status}}</td>
                                    <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a data-id="{{$department->id}}" data-name="{{$department->name}}" data-email="{{$department->email}}" data-phone="{{$department->number}}" data-status="{{$department->status}}" class="dropdown-item editbtn" href="#"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                           
                                            <a data-id="{{$department->id}}" class="dropdown-item deletebtn" href="javascript:void(0);" data-toggle="modal"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <x-modals.delete :route="'contact.destroy'" :title="'Contact'" />
                            <!-- Edit Department Modal -->
                            <div id="edit_department" class="modal custom-modal fade" role="dialog">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Contact</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{route('contacts')}}">
                                                @csrf
                                                @method("PUT")
                                                <input type="hidden" id="edit_id" name="id">
                                                <div class="form-group">
                                                    <label>Name <span class="text-danger">*</span></label>
                                                    <input name="name" id="edit_name" class="form-control" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email Address</label>
                                                    <input name="email" class="form-control" id="edit_email" type="email">
                                                </div>
                                                <div class="form-group">
                                                    <label>Contact Number <span class="text-danger">*</span></label>
                                                    <input name="number" class="form-control" id="edit_phone" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label class="d-block">Status</label>
                                                    <div class="status-toggle">
                                                        <input name="status" id="contact_status" type="checkbox" checked id="contact_status" class="check">
                                                        <label for="contact_status" class="checktoggle">checkbox</label>
                                                    </div>
                                                </div>
                                                <div class="submit-section">
                                                    <button type="submit" class="btn btn-primary submit-btn">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Edit Department Modal -->
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Contact Modal -->
    <div class="modal custom-modal fade" id="add_contact" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Contact</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('contacts')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Name <span class="text-danger">*</span></label>
                            <input name="name" class="form-control" type="text">
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input name="email" class="form-control" type="email">
                        </div>
                        <div class="form-group">
                            <label>Contact Number <span class="text-danger">*</span></label>
                            <input name="number" class="form-control" type="text">
                        </div>
                        <div class="form-group">
                            <label class="d-block">Status</label>
                            <div class="status-toggle">
                                <input name="status" type="checkbox" checked id="contact_status" class="check">
                                <label for="contact_status" class="checktoggle">checkbox</label>
                            </div>
                        </div>

                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add Contact Modal -->

    <!-- Edit Contact Modal -->
  
    <!-- /Edit Contact Modal -->
    @endsection

    @section('scripts')
    <!-- Datatable JS -->
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>

      
    <script>
        $(document).ready(function(){
            // Handle click event for edit button
            $(".editbtn").click(function(){
                // Get contact data from the button's data attributes
                var id = $(this).data('id');
                var name = $(this).data('name');
                var email = $(this).data('email');
                var phone = $(this).data('phone');
                var status = $(this).data('status');
    
                // Populate the modal fields with contact data
                $("#edit_id").val(id);
                $("#edit_name").val(name);
                $("#edit_email").val(email);
                $("#edit_phone").val(phone);
                if(status == 'on'){
                    $("#contact_status").prop('checked', true);
                } else {
                    $("#contact_status").prop('checked', false);
                }
    
                // Open the edit modal
                $("#edit_department").modal('show');
            });
        });
    </script>
    
        
        
    @endsection