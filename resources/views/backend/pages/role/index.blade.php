@extends('backend.layout.master')
@section('title')
    Role List
@endsection
@push('admin_style')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush
@section('content')
    @include('backend.layout.inc.breadcump', ['page_name' => 'Role List'])
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        @can('role-create')
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('role.create') }}" class=" btn btn-primary shadow-sm"><i
                                        class="fas fa-plus-circle text-white-50"></i> Create New Role</a>
                            </div>
                        @endcan
                        <div class="table-responsive text-nowrap py-4 ">
                            <table id="example" class="table table-hover text-dark" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Last Updated</th>
                                        <th>Role Name</th>
                                        <th>Permissions</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse ($roles as $index=>$role)
                                        <tr>
                                            <td><strong>{{ $index + 1 }}</strong></td>
                                            <td>{{ $role->updated_at->format('d-M-Y') }}</td>
                                            <td>{{ $role->role_name }}</td>
                                            <td>
                                                @foreach ($role->permissions->chunk(4) as $key => $chunks)
                                                    <div class="row">
                                                        <div class="col">
                                                            @foreach ($chunks as $permission)
                                                                <span
                                                                    class="badge badge-dark">{{ $permission->permission_slug }}</span>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </td>
                                            <td>
                                                <div class="actions d-flex justify-content-start">
                                                    @if ($role->is_deleteable && Auth::user()->haspermission('role-edit'))
                                                        <div class="">
                                                            <a href="{{ route('role.edit', $role->id) }}"
                                                                class="btn btn-primary mr-1">
                                                                <i class="fas fa-pen"></i>
                                                            </a>
                                                        </div>
                                                    @endif


                                                    @if ($role->is_deleteable && Auth::user()->haspermission('role-delete'))
                                                        <form action="{{ route('role.destroy', $role->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class=" btn btn-danger show_confirm">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>No Permission Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('admin_script')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {

            $('#example').DataTable({
                pagingType: 'first_last_numbers',
            });

            $('.show_confirm').click(function(event) {
                let form = $(this).closest('form');

                event.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            });
        });
    </script>
@endpush
