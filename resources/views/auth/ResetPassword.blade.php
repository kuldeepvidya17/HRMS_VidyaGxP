<form method="post" action="{{ route('submitResetPasswordForm') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group">
        <label>Old password<span class="text-danger">*</span></label>
        <input name="oldpassword" type="password" class="form-control" required>
        @error('oldpassword')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label>New password<span class="text-danger">*</span></label>
        <input type="password" name="newpassword" class="form-control" required>
        @error('newpassword')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label>Confirm password<span class="text-danger">*</span></label>
        <input type="password" name="newpassword_confirmation" class="form-control" required>
        @error('newpassword_confirmation')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <button type="submit">Update Password</button>
    </div>
</form>
