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
            <label>Employee Id</label>
            <input type="text" class="form-control" name="Employee_id" value="{{ $employee->Employee_id }}" >
        </div>
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
       
        <label>Phone</label>
            <div class="input-group-prepend">
                
                <select id="country_code" class="form-control" name="country_code" style="width: 125px">
                    <option value="+91">India (+91)</option> <!-- Default option for India -->
                </select>
                <input type="text" class="form-control" name="phone" value="{{$employee->phone}}">
            </div>
         <!-- JS for dynamic country codes -->
         <script>
            document.addEventListener("DOMContentLoaded", function () {
                const countryCodeSelect = document.getElementById('country_code');
                
                // Preserve the default option for India
                const defaultOption = `<option value="+91" selected>India (+91)</option>`;
                
                // Fetch country codes from the restcountries API
                fetch('https://restcountries.com/v3.1/all')
                    .then(response => response.json())
                    .then(data => {
                        let options = defaultOption; // Start with the default option for India
                        
                        // Loop through fetched country data and add other countries
                        data.forEach(country => {
                            if (country.idd && country.idd.root && country.idd.suffixes) {
                                let code = country.idd.root + country.idd.suffixes[0];
                                options += `<option value="${code}">${country.name.common} (${code})</option>`;
                            }
                        });
        
                        // Add all options to the dropdown (including India at the top)
                        countryCodeSelect.innerHTML = options;
                    })
                    .catch(error => {
                        console.error('Error fetching country codes:', error);
                        // If there's an error, just show India as the default option
                        countryCodeSelect.innerHTML = defaultOption;
                    });
            });
        </script>
        <!-- Department Dropdown -->
        <div class="form-group">
            <label>Department</label>
            <select name="department_id" class="form-control" >
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
            <select name="designation_id" class="form-control" >
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
                <label class="col-form-label">Employee CV</label>
                <input class="form-control" name="cv" type="file" accept=".pdf,.doc,.docx">
            </div>

            <div class="form-group">
                <label>Reporting Manager </label>
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
                <label>Area</label>
                <input type="text" class="form-control" name="area" value="{{ old('area', $employee->area) }}">
            </div>
    
            <div class="form-group">
                <label>Employee Type</label>
                <select name="employee_type" class="form-control">
                    <option value="">-- Select --</option>
                    <option value="Permanent" @if($employee->employee_type == 'Permanent') selected @endif>Permanent</option>
                    <option value="Temporary" @if($employee->employee_type == 'Temporary') selected @endif>Temporary</option>
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
                {{-- <input type="text" class="form-control" name="religion" value="{{ old('religion', $employee->religion) }}"> --}}
                <select class="form-control" name="religion">
                    <option value="">-- Select Religion --</option>
                    <option value="Hindu" {{ $employee->religion == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                    <option value="Muslim" {{ $employee->religion == 'Muslim' ? 'selected' : '' }}>Muslim</option>
                    <option value="Sikh" {{ $employee->religion == 'Sikh' ? 'selected' : '' }}>Sikh</option>
                    <option value="Christian" {{ $employee->religion == 'Christian' ? 'selected' : '' }}>Christian</option>
                </select>
            </div>
    
            <div class="form-group">
                <label>Pincode</label>
                <input type="text" class="form-control" name="pincode" value="{{ old('pincode', $employee->pincode) }}">
            </div>
    
            <div class="form-group">
                <label>Gender</label>
                <select name="gender" class="form-control">
                    <option value="">Select</option>
                    <option value="Male" @if($employee->gender == 'Male') selected @endif>Male</option>
                    <option value="Female" @if($employee->gender == 'Female') selected @endif>Female</option>
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
    
            {{-- <div class="form-group">
                <label>City</label>
                <input type="text" class="form-control" name="city" value="{{ old('city', $employee->city) }}">
            </div> --}}
            <div class="form-group">
                <label>Country</label>
                <select id="country" class="form-control" name="country" >
                    <option value="">Select Country</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}" {{ $country->id == $employee->country ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
            </div>
    
            <div class="form-group">
                <label>State</label>
                <select id="state" class="form-control" name="state" >
                    <option value="">Select State</option>
                    @foreach ($states as $state)
                        <option value="{{ $state->id }}" {{ $state->id == $employee->state ? 'selected' : '' }}>
                            {{ $state->name }}
                        </option>
                    @endforeach
                </select>
            </div>
    
            <div class="form-group">
                <label>City</label>
                <select id="city" class="form-control" name="city" >
                    <option value="">Select City</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}" {{ $city->id == $employee->city ? 'selected' : '' }}>
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <script>
                // Load states when country is selected
                document.getElementById('country').addEventListener('change', function() {
                    let countryId = this.value;
            
                    fetch(`/api/states/${countryId}`)
                        .then(response => response.json())
                        .then(data => {
                            let stateSelect = document.getElementById('state');
                            stateSelect.innerHTML = `<option value="">Select State</option>`;
                            
                            data.forEach(state => {
                                stateSelect.innerHTML += `<option value="${state.id}">${state.name}</option>`;
                            });
            
                            // Trigger change event to load cities for selected state if already selected
                            if ({{ $employee->state_id }}) {
                                stateSelect.value = "{{ $employee->state_id }}";
                                stateSelect.dispatchEvent(new Event('change'));
                            }
                        });
                });
            
                // Load cities when state is selected
                document.getElementById('state').addEventListener('change', function() {
                    let stateId = this.value;
            
                    fetch(`/api/cities/${stateId}`)
                        .then(response => response.json())
                        .then(data => {
                            let citySelect = document.getElementById('city');
                            citySelect.innerHTML = `<option value="">Select City</option>`;
                            
                            data.forEach(city => {
                                citySelect.innerHTML += `<option value="${city.id}">${city.name}</option>`;
                            });
            
                            // Trigger to select the city if already selected
                            citySelect.value = "{{ $employee->city_id }}"; // Pre-select city if exists
                        });
                });
            </script>
    
        

        <button type="submit" class="btn btn-success">Update Employee</button>
    </form>
</div>
@endsection
