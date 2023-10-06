@extends('backend.layout.master')
@section('title')
    Create Role
@endsection
@push('admin_style')
@endpush
@section('content')
    @include('backend.layout.inc.breadcump', ['page_name' => 'Create Role'])
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-start mb-3">
                            <a href="{{ route('role.index') }}" class=" btn btn-primary shadow-sm"><i
                                    class="fas fa-arrow-left text-white-50"></i> Back to Role List</a>
                        </div>

                        <form action="{{ route('role.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Role Name<span
                                        class="text-danger">*</span></label>
                                <input type="text" name="role_name"
                                    class="form-control @error('role_name')
                                is-invalid
                                @enderror"
                                    id="basic-default-fullname" placeholder="enter role name"
                                    value="{{ old('role_name') }}">
                                @error('role_name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-rolenote">Role Note</label>
                                <input type="text" name="role_note" value="{{ old('role_note') }}"
                                    class="form-control @error('role_note')
                                is-invalid
                                @enderror"
                                    id="basic-default-fullname" placeholder="enter role note">
                                @error('role_note')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mt-4 mb-2">
                                <strong
                                    class="@error('permissions')
                                is-invalid
                                @enderror">Manage
                                    Permissions for Role</strong>
                                @error('permissions')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="select-all">
                                <label class="form-check-label" for="defaultCheck1">Select All</label>
                            </div>

                            <div class="my-5">

                                @foreach ($modules->chunk(2) as $key => $chunks)
                                    <div class="row">
                                        @foreach ($chunks as $module)
                                            <div class="col mb-4">
                                                <h5 class="text-primary ">Module: {{ $module->module_name }}</h5>

                                                <!--module permissions list -->
                                                @foreach ($module->permissions as $permission)
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="permission-{{ $permission->id }}" name="permissions[]"
                                                            value="{{ $permission->id }}">
                                                        <label class="form-check-label"
                                                            for="permission-{{ $permission->id }}">{{ $permission->permission_name }}</label>
                                                    </div>
                                                @endforeach
                                                <!--module permissions list -->
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-warning">Save Change</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('admin_script')
    <script>
        //Listen for click on select all checkbox
        $('#select-all').click(function(event) {
            if (this.checked) {
                //loop each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                })
            } else {
                //loop each checkbox
                $(':checkbox').each(function() {
                    this.checked = false;
                })
            }
        });
    </script>
@endpush
