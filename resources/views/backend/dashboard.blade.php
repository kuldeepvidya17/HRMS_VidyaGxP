@extends('layouts.backend')

@section('styles')
    <!-- Chart CSS -->
	<link rel="stylesheet" href="assets/plugins/morris/morris.css">
@endsection

@section('page-header')
<div class="row">
    <div class="col-sm-12">
        <h3 class="page-title">Welcome {{auth()->user()->username}}!</h3>
        <ul class="breadcrumb">
            <li class="breadcrumb-item active">Dashboard</li>
        </ul>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>
                <div class="dash-widget-info">
                    <h3>{{$project_count}}</h3>
                    <span>Projects</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                <div class="dash-widget-info">
                    <h3>{{$clients_count}}</h3>
                    <span>Clients</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa fa-diamond"></i></span>
                <div class="dash-widget-info">
                    <h3>{{$task_count}}</h3>
                    <span>Tasks</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa fa-user"></i></span>
                <div class="dash-widget-info">
                    <h3>{{$employee_count}}</h3>
                    <span>Employees</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 text-center">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Total Revenue</h3>
                        <div id="bar-charts"></div>
                    </div>
                    
                </div>
            </div>


            <div class="col-lg-6 text-center">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Sales Overview</h3>
                        <div id="line-charts"></div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card-group m-b-30">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <span class="d-block">New Employees</span>
                        </div>
                        <div id="newEmployeePercentage">
                            <span class="text-success"></span>
                        </div>
                    </div>
                    <h3 class="mb-3">{{ $employee_count }}</h3>
                    @php
                        $totalEmployees = 100;
                        $newEmployeePercentage = ($employee_count / $totalEmployees) * 100;
                    @endphp
                    <div class="progress mb-2" style="height: 5px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $newEmployeePercentage }}%;" aria-valuenow="{{ $newEmployeePercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mb-0">Overall Employees<span id="overallEmployeesPlaceholder">Loading...</span></p>
                </div>
            </div>
        
        
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <span class="d-block">Earnings</span>
                        </div>
                        <div>
                            <!-- <span class="text-success">+12.5%</span> -->
                        </div>
                    </div>
                    <h3 class="mb-3">$0</h3>
                    <div class="progress mb-2" style="height: 5px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mb-0">Previous Month 
                        <!-- <span class="text-muted">$1,15,852</span></p> -->
                </div>
            </div>
        
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <span class="d-block">Expenses</span>
                        </div>
                        <div>
                            <!-- <span class="text-danger">-2.8%</span> -->
                        </div>
                    </div>
                    <h3 class="mb-3">$0</h3>
                    <div class="progress mb-2" style="height: 5px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mb-0">Previous Month 
                        <!-- <span class="text-muted">$7,500</span></p> -->
                        <span class="text-muted">$0</span></p>

                    </div>
            </div>
        
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <span class="d-block">Profit</span>
                        </div>
                        <div>
                            <!-- <span class="text-danger">-75%</span> -->
                        </div>
                    </div>
                    <h3 class="mb-3">$0</h3>
                    <div class="progress mb-2" style="height: 5px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mb-0">Previous Month <span class="text-muted">$0</span></p>
                </div>
            </div>
        </div>
    </div>	
</div>

<!-- Statistics Widget -->
<div class="row">
    <div class="col-md-12 col-lg-12 col-xl-4 d-flex">
        <div class="card flex-fill dash-statistics">
            <div class="card-body">
                <h5 class="card-title">Statistics</h5>
                <div class="stats-list">
                    <div class="stats-info">
                        <p>Today Leave <strong>{{ $absent_employee }}<small>/ {{ $employee_count }}</small></strong></p>
                        <div class="progress">
                            <div id="progress-bar" class="progress-bar bg-primary" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="stats-info">
                        <p>Pending Invoice <strong>{{ $invoice }}<small>/ {{ $invoice_count }}</small></strong></p>
                        <div class="progress">
                            <div id="invoice-progress-bar" class="progress-bar bg-warning" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="stats-info">
                        <p>Completed Projects <strong>0 <small>/ 0</small></strong></p>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="stats-info">
                        <p>Open Tickets <strong>{{ $open_ticket }} <small>/ {{ $ticket_count }}</small></strong></p>
                        <div class="progress">
                            <div id="open-ticket-bar" class="progress-bar bg-danger" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="stats-info">
                        <p>Closed Tickets <strong>{{ $close_ticket }} <small>/ {{ $ticket_count }}</small></strong></p>
                        <div class="progress">
                            <div id="close-ticket-bar" class="progress-bar bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-12 col-lg-6 col-xl-4 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <h4 class="card-title">Task Statistics</h4>
                <div class="statistics">
                    <div class="row">
                        <div class="col-md-6 col-6 text-center">
                            <div class="stats-box mb-4">
                                <p>Total Tasks</p>
                                <h3>{{ $task_count }}</h3>
                            </div>
                        </div>
                        <div class="col-md-6 col-6 text-center">
                            <div class="stats-box mb-4">
                                <p>Overdue Tasks</p>
                                <h3>0</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="progress mb-4">
                    <div class="progress-bar bg-purple" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">0%</div>
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 22%" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100">0%</div>
                    <div class="progress-bar bg-success" role="progressbar" style="width: 24%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100">0%</div>
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 26%" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100">0%</div>
                    <div class="progress-bar bg-info" role="progressbar" style="width: 10%" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
                <div>
                    <p><i class="fa fa-dot-circle-o text-purple mr-2"></i>Completed Tasks <span class="float-right">{{ $complete_task_count }}</span></p>
                    <p><i class="fa fa-dot-circle-o text-warning mr-2"></i>Inprogress Tasks <span class="float-right">{{ $inprogress_task_count }}</span></p>
                    <p><i class="fa fa-dot-circle-o text-success mr-2"></i>On Hold Tasks <span class="float-right">{{  $onhold_task_count }}</span></p>
                    <p><i class="fa fa-dot-circle-o text-danger mr-2"></i>Pending Tasks <span class="float-right">{{ $pending_task_count }}</span></p>
                    <p class="mb-0"><i class="fa fa-dot-circle-o text-info mr-2"></i>Review Tasks <span class="float-right">{{ $review_task_count }}</span></p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-12 col-lg-6 col-xl-4 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <h4 class="card-title">Today Absent <span class="badge bg-inverse-danger ml-2">{{ $absent_employee }}</span></h4>
                <!--<div class="leave-info-box">
                    <div class="media align-items-center">
                        <a href="profile.html" class="avatar"><img alt="" src="assets/img/user.jpg"></a>
                        <div class="media-body">
                            <div class="text-sm my-0">Martin Lewis</div>
                        </div>
                    </div>
                    <div class="row align-items-center mt-3">
                        <div class="col-6">
                            <h6 class="mb-0">4 Sep 2019</h6>
                            <span class="text-sm text-muted">Leave Date</span>
                        </div>
                        <div class="col-6 text-right">
                            <span class="badge bg-inverse-danger">Pending</span>
                        </div>
                    </div>
                </div>
                <div class="leave-info-box">
                    <div class="media align-items-center">
                        <a href="profile.html" class="avatar"><img alt="" src="assets/img/user.jpg"></a>
                        <div class="media-body">
                            <div class="text-sm my-0">Martin Lewis</div>
                        </div>
                    </div>
                    <div class="row align-items-center mt-3">
                        <div class="col-6">
                            <h6 class="mb-0">4 Sep 2019</h6>
                            <span class="text-sm text-muted">Leave Date</span>
                        </div>
                        <div class="col-6 text-right">
                            <span class="badge bg-inverse-success">Approved</span>
                        </div>
                    </div>
                </div>
                <div class="load-more text-center">
                    <a class="text-dark" href="javascript:void(0);">Load More</a>
                </div> -->
            </div>
        </div>
    </div>
</div>
<!-- /Statistics Widget -->

<script>
    // Update the percentage dynamically
    var newEmployeePercentage = {{ $newEmployeePercentage }};
    document.getElementById('newEmployeePercentage').innerHTML = '<span class="text-success">+' + newEmployeePercentage.toFixed(2) + '%</span>';
</script>

    <script>
        // Calculate the percentage of absent employees
        var absentEmployees = {{ $absent_employee }};
        var totalEmployees = {{ $employee_count }};
        var percentage = (absentEmployees / totalEmployees) * 100;

        // Update the width of the progress bar
        document.getElementById("progress-bar").style.width = percentage + "%";
        document.getElementById("progress-bar").setAttribute("aria-valuenow", percentage);
    </script>

    <script>
        // Calculate the percentage of pending invoices
        var pendingInvoices = {{ $invoice }};
        var totalInvoices = {{ $invoice_count }};
        var percentage = (pendingInvoices / totalInvoices) * 100;

        // Update the width of the progress bar
        document.getElementById("invoice-progress-bar").style.width = percentage + "%";
        document.getElementById("invoice-progress-bar").setAttribute("aria-valuenow", percentage);
    </script>

    <script>
        var openTickets = {{ $open_ticket }};
        var totalTickets = {{ $ticket_count }};
        var percentage = (openTickets / totalTickets) * 100;

        document.getElementById("open-ticket-bar").style.width = percentage + "%";
        document.getElementById("open-ticket-bar").setAttribute("aria-valuenow", percentage);
    </script>

    <script>
        var closeTickets = {{ $close_ticket }};
        var totalTickets = {{ $ticket_count }};
        var percentage = (closeTickets / totalTickets) * 100;

        document.getElementById("close-ticket-bar").style.width = percentage + "%";
        document.getElementById("close-ticket-bar").setAttribute("aria-valuenow", percentage);
    </script>
{{-- <script>
    
    fetch('/getTotalEmployees') 
        .then(response => response.json())
        .then(data => {
            document.getElementById('overallEmployeesPlaceholder').innerText = data.totalEmployees;
        })
        .catch(error => {
            console.error('Error fetching total employees:', error);
            document.getElementById('overallEmployeesPlaceholder').innerText = 'Error';
        });
</script> --}}

@endsection
@section('scripts')
<!-- Chart JS -->
<script src="assets/plugins/morris/morris.min.js"></script>
<script src="assets/plugins/raphael/raphael.min.js"></script>
<script src="assets/js/chart.js"></script>
@endsection