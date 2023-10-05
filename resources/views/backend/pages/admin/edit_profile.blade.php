@extends('backend.layout.master')
@section('title')
    Edit Profile
@endsection
@push('admin_style')
@endpush
@section('content')
    @include('backend.layout.inc.breadcump', ['page_name' => 'Edit Profile'])
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <form action="{{ route('admin.editProfile') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="full_name">Full Name<span class="text-danger text-bold">*</span></label>
                        <input type="text" value="{{ Auth::user()->name }}"
                            class="form-control @error('full_name')
                is-invalid
                @enderror"
                            id="full_name" name="full_name" placeholder="Enter your full name">
                        @error('full_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email<span class="text-danger text-bold">*</span></label>
                        <input type="text"
                            class="form-control @error('email')
                is-invalid
                @enderror"
                            id="email" name="email" value="{{ Auth::user()->email }}" placeholder="Enter your email">
                        @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone<span class="text-danger text-bold">*</span></label>
                        <input type="text"
                            class="form-control @error('phone')
                is-invalid
                @enderror"
                            id="phone" name="phone" value="{{ Auth::user()->phone }}"
                            placeholder="Enter your phone number">
                        @error('phone')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address">Address<span class="text-danger text-bold">*</span></label>
                        <input type="text" value="{{ Auth::user()->address }}"
                            class="form-control @error('address')
                is-invalid
                @enderror"
                            id="address" name="address" placeholder="Enter your address number">
                        @error('address')
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
