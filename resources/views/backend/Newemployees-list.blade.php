@extends('layouts.backend')

@section('styles')
<!-- DataTable CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
<div>
    {{-- <h2 class="mb-4">Employee List</h2> --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
     <!-- Import Excel Form -->
     <form action="{{ route('NewEmployeeslist.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">Import Employees from Excel</label>
            <input type="file" name="file" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mb-2">Import</button>
    </form>
    <table id="employeeTable" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Reporting Manager</th>
                <th>Area</th>
                <th>Employee Type</th>
                <th>Date of Joining</th>
                <th>Aadhaar No</th>
                <th>Passport No</th>
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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->id }}</td>
                <td>{{ $employee->first_name }}</td>
                <td>{{ $employee->last_name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->phone }}</td>
                <td>
                    {{ $departments->firstWhere('id', $employee->department_id)->name ?? 'No Department' }}
                </td>
                {{-- <td>
                    {{ $designations->firstWhere('id', $employee->designation_id)->name ?? 'No Designation' }}
                </td> --}}
                <td>{{ $employee->department }}</td>
                <td>{{ $employee->department }}</td>
                <td>{{ $employee->department }}</td>
                <td>{{ $employee->department }}</td>
                <td>{{ $employee->department }}</td>
                <td>{{ $employee->department }}</td>
                <td>{{ $employee->department }}</td>
                <td>{{ $employee->department }}</td>
                <td>{{ $employee->department }}</td>
                <td>{{ $employee->department }}</td>

                <td>{{ $employee->salary }}</td>
                <td>
                    <a href="{{ route('NewEmployeeslist.edit', $employee->id) }}" class="btn btn-primary">Edit</a>
                    <button type="button" class="btn btn-danger" onclick="showDeleteConfirmation('{{ route('NewEmployeeslist.destroy', $employee->id) }}')">Delete</button>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this employee?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteForm" action="" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
function showDeleteConfirmation(actionUrl) {
    document.getElementById('deleteForm').action = actionUrl;
    $('#deleteConfirmationModal').modal('show');
}
</script>
@endsection

@section('scripts')
<!-- DataTables & Bootstrap JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script>
$(document).ready(function() {
    $('#employeeTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
        ],
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });
});
</script>
@endsection
