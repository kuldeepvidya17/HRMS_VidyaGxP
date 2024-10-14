@extends('layouts.backend')

@section('styles')
<!-- DataTable CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
        {{-- <a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" data-target="#filter_modal" style="margin-right: 30px">
         <i class="fa fa-filter"></i> Filter
     </a> --}}
     {{-- <a href="javascript:void(0)" class="btn btn-primary"   style="margin-right: 30px">
        <i class="fa fa-filter"></i> Filter
    </a> --}}
    
     
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
   
    <div style="margin-bottom: 20px;">
        <h4>Employee Filter</h4>
        <select id="filterEmployeeType" class="form-control" style="width: 300px; display: inline-block; margin-right: 20px;">
            <option value="">Select All Employee Type</option>
            <option value="permanent">Permanent</option>
            <option value="temporary">Temporary</option>
        </select>
    
        <select id="filterDesignation" class="form-control" style="width: 300px; display: inline-block;">
            <option value="">Select All Designation</option>
            @foreach($designations as $designation)
                <option value="{{ $designation->name }}">{{ $designation->name }}</option>
            @endforeach
        </select>
    </div>
    
    <script>
        // Filter functionality - runs when the user changes either dropdown
        document.getElementById('filterEmployeeType').addEventListener('change', filterTable);
        document.getElementById('filterDesignation').addEventListener('change', filterTable);
    
        function filterTable() {
            // Get selected filter values
            var employeeType = document.getElementById('filterEmployeeType').value.toLowerCase();
            var designation = document.getElementById('filterDesignation').value.toLowerCase();
    
            // Get all table rows
            var table = document.getElementById('employeeTable');
            var rows = table.getElementsByTagName('tr');
    
            // Loop through table rows and hide those that don't match the filters
            for (var i = 1; i < rows.length; i++) {
                var employeeTypeCell = rows[i].getElementsByTagName('td')[10].textContent.toLowerCase().trim(); // Employee Type
                var designationCell = rows[i].getElementsByTagName('td')[6].textContent.toLowerCase().trim(); // Designation
                
                // Apply filter logic
                if (
                    (employeeType === '' || employeeTypeCell === employeeType) &&
                    (designation === '' || designationCell === designation)
                ) {
                    rows[i].style.display = ''; // Show row
                } else {
                    rows[i].style.display = 'none'; // Hide row
                }
            }
        }
    
        // Optional: Trigger initial filter on page load to show all rows by default
        window.onload = function() {
            filterTable();
        };
    </script>
    
        
    <style>
        #employeeTable {
            overflow-x: auto;
            display: block;
            white-space: nowrap;
        }
    </style>
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
                <th>Salary</th>
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
        <tbody id="audit-data">
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
                <td>
                    {{ $designations->firstWhere('id', $employee->designation_id)->name ?? 'No Designation' }}
                </td>
                <td>{{ $employee->salary }}</td>
                <td>{{ $employee->reporting_managers }}</td>
                <td>{{ $employee->area }}</td>
                <td>{{ $employee->employee_type }}</td>
                <td>{{ $employee->date_of_joining }}</td>
                <td>{{ $employee->aadhaar_no }}</td>
                <td>{{ $employee->passport_no }}</td>
                <td>{{ $employee->card_no }}</td>
                <td>{{ $employee->permanent_address }}</td>
                <td>{{ $employee->birthday }}</td>
                <td>{{ $employee->nick_name }}</td>
                <td>{{ $employee->office_tel }}</td>
                <td>{{ $employee->religion }}</td>
                <td>{{ $employee->pincode }}</td>
                <td>{{ $employee->gender }}</td>
                <td>{{ $employee->motorcycle_lic }}</td>
                <td>{{ $employee->automobile_lic }}</td>
                <td>{{ $employee->city }}</td>
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
<div class="modal fade table-responsive" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
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
<script type='text/javascript'>
    $(document).ready(function() {
        function fetchDataAudit() {
            var typedata = $('#typedata').val();
            var user = $('#user').val();
            var fromDate = $('#from_date').val();
            var toDate = $('#to_date').val();

            $.ajax({
                url: "{{ route('employees.filter') }}",
                method: "GET",
                data: {
                    typedata: typedata,
                    user: user,
                    from_date: fromDate,
                    to_date: toDate
                },
                success: function(response) {
                    $('#audit-data').html(response.html); // Update the table body with filtered data
                }
            });
        }

        $('#typedata, #user, #from_date, #to_date').on('change', function() {
            fetchDataAudit(); // Call fetchDataAudit whenever any filter changes
        });
    });
</script>
@endsection
