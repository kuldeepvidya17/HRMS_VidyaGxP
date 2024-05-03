<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="robots" content="noindex, nofollow">
		<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ucfirst(config('app.name'))}} - {{ucfirst($title="Employsalary")}}</title>
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{!empty(app(App\Settings\ThemeSettings::class)->favicon) ? asset('storage/settings/'.app(App\Settings\ThemeSettings::class)->favicon):asset('assets/img/logovidyagxp.png')}}">
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/line-awesome.min.css')}}">
		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
		
		<!-- Toastr Css -->
		<link rel="stylesheet" href="{{asset('assets/plugins/toastr/toastr.min.css')}}">
		<!-- Toastify css -->
		<link rel="stylesheet" href="{{asset('assets/plugins/toastify/src/toastify.css')}}">
		<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.min.css')}}">
		<!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
		<!-- Page Css -->
		{{-- @yield('styles') --}}
		<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.min.css')}}">

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<!-- Header -->
            @include('includes.backend.header')
			<!-- /Header -->
			
			<!-- Sidebar -->
            @include('includes.backend.sidebar')
			<!-- /Sidebar -->
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
				@yield('content_one')
				<!-- Page Content -->
                <div class="content container-fluid">
					
					<!-- Page Header -->
					<div class="page-header">
						{{-- @yield('page-header') --}}
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Employee Salary</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
									<li class="breadcrumb-item active">Employee Salary</li>
								</ul>
							</div>
							<div class="col-auto float-right ml-auto">
								<a href="javascript:void(0)" class="btn add-btn" data-toggle="modal" data-target="#add_employeeSalary"><i class="fa fa-plus"></i> Add Employee Salary</a>
								<div class="view-icons">
									<a href="{{route('employees')}}" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
									<a href="{{route('employees-list')}}" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
								</div>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					@if ($errors->any())
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							@foreach($errors->all() as $error)
							<strong>Error!</strong> {{$error}}.
							@endforeach
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					@endif
					@if(session('success'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>Success! </strong>{{session('success')}}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					@endif
					<!-- Content Starts -->
						{{-- @yield('content') --}}
{{-- ======================================add salary model======================= --}}

<!-- resources/views/add-employee-salary.blade.php -->
<div id="add_employeeSalary">
	<!-- resources/views/add-employee-salary.blade.php -->
<form method="POST" action="{{ url('/add-employee-salary') }}">
    @csrf
    <div class="form-group">
        <label for="employee_id">Employee ID</label>
        <input type="text" name="employee_id" class="form-control" id="employee_id" placeholder="Enter Employee ID">
    </div>
    <div class="form-group">
        <label for="salary">Salary</label>
        <input type="text" name="salary" class="form-control" id="salary" placeholder="Enter Salary">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

</div>


					<!-- /Content End -->
					
                </div>
				<!-- /Page Content -->
				
            </div>
			<!-- /Page Wrapper -->
        </div>
		<!-- /Main Wrapper -->
		
		
    </body>
	
	<!-- jQuery -->
	<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
	<!-- Bootstrap Core JS -->
	<script src="{{asset('assets/js/popper.min.js')}}"></script>
	<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
	<!-- Slimscroll JS -->
	<script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>
	<!-- Datetimepicker JS -->
	<script src="{{asset('assets/js/moment.min.js')}}"></script>
	<script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>
	<!-- Ck Editor -->
	<script src="{{asset('assets/plugins/ckeditor/ckeditor.js')}}"></script>
	<!-- Toastr JS -->
	<script src="{{asset('assets/plugins/toastr/toastr.min.js')}}"></script>
	<!-- Toastify JS -->
	<script src="{{asset('assets/plugins/toastify/src/toastify.js')}}"></script>
	<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
	<!-- Custom JS -->
	<script src="{{asset('assets/js/app.js')}}"></script>
	<script>
		$(document).ready(function (){
			$('body').on('click','.deletebtn',function (){
				$('#delete_modal').modal('show');
				var id = $(this).data('id');
				$('#delete_id').val(id);
			});
			$('.alert').delay(2000).fadeOut();
            @if(Session::has('message'))
                var type = "{{ Session::get('alert-type', '') }}";
                switch (type) {
                    case 'info':
                        toastr.info("{{ Session::get('message') }}");
                        break;
                    
                    case 'success':
                        toastr.success("{{ Session::get('message') }}");
                        break;
                    
                    case 'warning':
                        toastr.warning("{{ Session::get('message') }}");
                        break;
                    
                    case 'error':
                        toastr.error("{{ Session::get('message') }}");
                        break;
                    
                    case 'danger':
                        toastr.error("{{ Session::get('message') }}");
                        break;
                    
                }
            @endif
		});
	</script>
	@yield('scripts')
</html>