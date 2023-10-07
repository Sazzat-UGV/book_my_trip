@extends('backend.layout.master')
@section('title')
    Admin Create
@endsection
@push('admin_style')
@endpush
@section('content')
    @include('backend.layout.inc.breadcump', ['page_name' => 'Admin Create'])
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-start mb-3">
                            <a href="{{ route('admin.index') }}" class=" btn btn-primary shadow-sm"><i
                                    class="fas fa-arrow-left text-white-50"></i> Back to Admin List</a>
                        </div>

                        <form action="{{ route('admin.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Select Role<span class="text-danger">*</span></label>
                                <select class="custom-select @error('role_id') is-invalid @enderror" name="role_id">
                                    <option value="">Select a role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                            {{ $role->role_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    placeholder="Enter admin name"
                                    class="form-control @error('name')
                                is-invalid
                                @enderror">
                                @error('name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Email<span class="text-danger">*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    placeholder="Enter admin email"
                                    class="form-control @error('email')
                                is-invalid
                                @enderror">
                                @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Phone<span class="text-danger">*</span></label>
                                <input type="text" name="phone" value="{{ old('phone') }}"
                                    placeholder="Enter admin phone"
                                    class="form-control @error('phone')
                                is-invalid
                                @enderror">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Address<span class="text-danger">*</span></label>
                                <input type="text" name="address" value="{{ old('address') }}"
                                    placeholder="Enter admin address"
                                    class="form-control @error('address')
                                is-invalid
                                @enderror">
                                @error('address')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Password<span class="text-danger">*</span></label>
                                <input type="password" name="password" value="{{ old('password') }}"
                                    placeholder="Enter admin password"
                                    class="form-control @error('password')
                                is-invalid
                                @enderror">
                                @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <button class="btn btn-primary" type="submit">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('admin_script')
@endpush
