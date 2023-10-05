@extends('backend.layout.master')
@section('title')
    Change Password
@endsection
@push('admin_style')
@endpush
@section('content')
    @include('backend.layout.inc.breadcump', ['page_name' => 'Change Password'])
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">

                <form action="{{ route('admin.changePassword') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="old_password">Old Password<span class="text-danger text-bold">*</span></label>
                        <input type="password"
                            class="form-control @error('old_password')
                    is-invalid
                    @enderror"
                            id="old_password" name="old_password" placeholder="Enter old password">
                        @error('old_password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="new_password">New Password<span class="text-danger text-bold">*</span></label>
                        <input type="password"
                            class="form-control @error('new_password')
                    is-invalid
                    @enderror"
                            id="new_password" name="new_password" placeholder="Enter new password">
                        @error('new_password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="retype_password">Retype Password<span class="text-danger text-bold">*</span></label>
                        <input type="password"
                            class="form-control @error('retype_password')
                    is-invalid
                    @enderror"
                            id="retype_password" name="retype_password" placeholder="Retype new password">
                        @error('retype_password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-warning">Save Change</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('admin_script')
@endpush
