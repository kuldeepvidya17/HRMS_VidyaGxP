@extends('layouts.backend-settings')
@section('content')
<form method="post" action="{{route('change-password')}}">
    @csrf
    <div class="form-group">
        <label>Old password<span class="text-danger">*</span></label>
        <input name="old_password"type="password" class="form-control" required>
    </div>
    <div class="form-group">
        <label>New password<span class="text-danger">*</span></label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Confirm password<span class="text-danger">*</span></label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>
    <div class="submit-section">
        <button class="btn btn-primary submit-btn">Update Password</button>
    </div>
</form>
@endsection
