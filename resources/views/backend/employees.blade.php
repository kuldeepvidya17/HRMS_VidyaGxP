@extends('layouts.backend')

@section('styles')
<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.min.css')}}">
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>

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
          <!-- Filter Button -->
          {{-- <a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" data-target="#filter_modal" style="margin-right: 30px">
            <i class="fa fa-filter"></i> Filter
        </a> --}}
        
        <a href="{{ route('NewEmployeeslist.create') }}" class="btn add-btn">
            <i class="fa fa-plus"></i> Add Employee
        </a> 		<div class="view-icons">
			<a href="{{route('NewEmployeeslist.empdashborad')}}" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
			<a href="{{route('NewEmployeeslist.index')}}" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
		</div>
	</div>
</div>
<!-- Filter Dropdowns -->
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
    // Add event listeners to filter dropdowns
    document.getElementById('filterEmployeeType').addEventListener('change', filterCards);
    document.getElementById('filterDesignation').addEventListener('change', filterCards);

    function filterCards() {
        // Get selected filter values
        var selectedEmployeeType = document.getElementById('filterEmployeeType').value.toLowerCase();
        var selectedDesignation = document.getElementById('filterDesignation').value.toLowerCase();

        // Get all employee cards
        var employeeCards = document.getElementsByClassName('employee-card');

        // Loop through the employee cards and filter based on selected values
        for (var i = 0; i < employeeCards.length; i++) {
            var card = employeeCards[i];
            var employeeType = card.getAttribute('data-employee-type');
            var designation = card.getAttribute('data-designation');

            // Apply filter logic
            if (
                (selectedEmployeeType === '' || employeeType === selectedEmployeeType) &&
                (selectedDesignation === '' || designation === selectedDesignation)
            ) {
                card.style.display = ''; // Show card
            } else {
                card.style.display = 'none'; // Hide card
            }
        }
    }

    // Trigger initial filter on page load to show all cards by default
    window.onload = function() {
        filterCards();
    };
</script>
@endsection

<script>
    function searchEmployees() {
        // Get the value from the search box
        let input = document.getElementById('searchBox').value.toLowerCase();
        let cards = document.querySelectorAll('.employee-card'); // Select employee cards

        // Loop through all employee cards and hide/show based on the search input
        cards.forEach(card => {
            let name = card.querySelector('.card-title').textContent.toLowerCase(); // Get the full name
            if (name.includes(input)) {
                card.style.display = ''; // Show card
            } else {
                card.style.display = 'none'; // Hide card
            }
        });
    }
</script>
@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <label for="Serch">Search Employee Name</label>
        <input type="text" id="searchBox" class="form-control" placeholder="Search Employee by Name" onkeyup="searchEmployees()">
    </div>
</div>
<div class="row">
  <!-- Employee Cards -->
<div class="row" style="display: contents">
    @foreach($employees as $employee)
        <div class="col-md-4 mb-4 employee-card" 
            data-employee-type="{{ strtolower($employee->employee_type) }}" 
            data-designation="{{ strtolower(optional($designations->where('id', $employee->designation_id)->first())->name) }}">
            
            <div class="card">
                <a href="#" class="action-icon dropdown-toggle float-left" style="position: absolute; margin-left: 90%" data-toggle="dropdown" aria-expanded="false">
                    <i class="material-icons">more_vert</i>
                </a>

                <div class="card-body text-center">
                    <div class="profile-img">
                        <a href="javascript:void(0)" class="avatar" data-toggle="modal" data-target="#imageModal" onclick="openImageModal('{{ asset('storage/employees/'.$employee->avatar) }}')">
                            <img alt="avatar" src="@if(!empty($employee->avatar)) {{ asset('storage/employees/'.$employee->avatar) }} @else {{ asset('assets/img/profiles/default.jpg') }} @endif">
                        </a>
                    </div>
                    
                    <h5 class="card-title">{{ $employee->first_name }} {{ $employee->last_name }}</h5>
                    <p class="card-text">{{ $employee->designation_id ? optional($designations->where('id', $employee->designation_id)->first())->name : 'No Designation' }}</p>
                    <a href="{{ route('NewEmployeeslist.edit', $employee->id) }}" class="btn btn-primary">Edit</a>
                    <button type="button" class="btn btn-danger" onclick="showDeleteConfirmation('{{ route('NewEmployeeslist.destroy', $employee->id) }}')">Delete</button>
                </div>
            </div>
        </div>
    @endforeach
</div>
    
</div>
<!-- Modal for showing full image -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <img src="" id="modal-image" class="img-fluid" alt="Full Image">
            </div>
        </div>
    </div>
</div>

<script>
    function openImageModal(imageUrl) {
        document.getElementById('modal-image').src = imageUrl;
    }
</script>


	






@endsection