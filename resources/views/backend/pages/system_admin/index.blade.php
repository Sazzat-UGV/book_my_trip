@extends('backend.layout.master')
@section('title')
    Admin List
@endsection
@push('admin_style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush
@section('content')
    @include('backend.layout.inc.breadcump', ['page_name' => 'Admin List'])
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        @can('admin-create')
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('admin.create') }}" class=" btn btn-primary shadow-sm"><i
                                        class="fas fa-plus-circle text-white-50"></i> Create New Admin</a>
                            </div>
                        @endcan
                        <div class="table-responsive text-nowrap my-3">
                            <table id="example" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Created at</th>
                                        <th>Role</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        @can('admin-edit')
                                            <th>Active</th>
                                        @endcan
                                        @if (Auth::user()->haspermission('admin-edit') || Auth::user()->haspermission('admin-delete'))
                                            <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $index => $admin)
                                        <tr>
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>{{ $admin->created_at->format('d-M-Y') }}</td>
                                            <td>{{ $admin->role->role_name }}</td>
                                            <td><img src="{{ asset('uploads/user') }}/{{ $admin->image }}" alt="admin image"
                                                    class="w-25 rounded-circle"></td>
                                            <td>{{ Str::limit($admin->name, 15, '...') }}</td>
                                            <td>{{ Str::limit($admin->email, 15, '...') }}</td>
                                            @can('admin-edit')
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input class="custom-control-input toggle-class" type="checkbox"
                                                            data-id="{{ $admin->id }}" id="admin-{{ $admin->id }}"
                                                            {{ $admin->is_active ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="admin-{{ $admin->id }}"></label>
                                                    </div>
                                                </td>
                                            @endcan
                                            @if (Auth::user()->haspermission('admin-edit') || Auth::user()->haspermission('admin-delete'))
                                                <td class="text-right">
                                                    <div class="actions d-flex justify-content-start">
                                                        @if ($admin->is_deleteable && Auth::user()->haspermission('admin-edit'))
                                                            <a href="{{ route('admin.edit', $admin->id) }}"
                                                                class="btn btn-sm btn-outline-primary mr-1">
                                                                <i class="fas fa-pen"></i>
                                                            </a>
                                                        @endif
                                                        @can('admin-view')
                                                            <a href="" class="btn btn-sm btn-outline-info mr-1"
                                                                data-toggle="modal" data-target="#myModal-{{ $admin->id }}">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        @endcan
                                                        @if ($admin->is_deleteable && Auth::user()->haspermission('admin-delete'))
                                                            <form action="{{ route('admin.destroy', $admin->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class=" btn btn-sm btn-outline-danger show_confirm">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @endif

                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                        <div class="modal fade" id="myModal-{{ $admin->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModal-{{ $admin->id }}Label"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModal-{{ $admin->id }}Label">
                                                            Details</h5>
                                                        <button class="close" type="button" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><span>Name: {{ $admin->name }}</span></p>
                                                        <p><span>Role: {{ $admin->role->role_name }}</span></p>
                                                        <p><span>Email: {{ $admin->email }}</span></p>
                                                        <p><span>Phone: {{ $admin->phone }}</span></p>
                                                        <p><span>Address: {{ $admin->address }}</span></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-dismiss="modal">Close</button>

                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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


            $('.toggle-class').change(function() {
                var is_active = $(this).prop('checked') == true ? 1 : 0;
                var item_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/admin/check/is_active/' + item_id,
                    success: function(response) {
                        console.log(response);
                        Swal.fire(
                            'Status Updated!',
                            'Click ok button!',
                            'success'
                        )
                    },
                    errro: function(err) {
                        if (err) {
                            console.log(err);
                        }
                    }
                });
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
            })



        });
    </script>
@endpush
