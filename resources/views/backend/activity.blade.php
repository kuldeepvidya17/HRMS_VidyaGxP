@extends('layouts.backend')

@section('styles')
	
@endsection

@section('page-header')
<div class="row">
	<div class="col-sm-12">
		<h3 class="page-title">Activities</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
			<li class="breadcrumb-item active">Activities</li>
		</ul>
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
                        <th>Module </th>
                        <th>Action</th>
                        <th>Activity Date</th>
                        <th>Description</th>

                    </tr>
                </thead>
                <tbody>
                    @if (!empty($AcitivityLog->count()))
                        @foreach ($AcitivityLog as $activity)
                            <tr >
                                <td>{{$activity->module}}</td>
                                <td>{{$activity->action}}</td>
                                <td>{{date_format(date_create($activity->created_at),'d M Y')}}</td>
                                <td>{{$activity->status}}</td>
                               
                            </tr>
                        @endforeach
                    
                    @endif                    
                </tbody>
            </table>
        </div>
    </div>
</di
@endsection


@section('scripts')
	
@endsection