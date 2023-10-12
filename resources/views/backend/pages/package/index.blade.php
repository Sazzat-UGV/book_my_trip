@extends('backend.layout.master')
@section('title')
    Package List
@endsection
@push('admin_style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <style>
        .text-wrap {
            white-space: normal !important;
            /* Enable text wrapping */
            word-wrap: break-word;
            /* Wrap long words */
        }
    </style>
@endpush
@section('content')
    @include('backend.layout.inc.breadcump', ['page_name' => 'Package List'])
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        @can('package-create')
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('package.create') }}" class=" btn btn-primary shadow-sm"><i
                                        class="fas fa-plus-circle text-white-50"></i> Create New Package</a>
                            </div>
                        @endcan
                        <div class="table-responsive text-nowrap my-3">
                            <table id="example" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Created at</th>
                                        <th>Image</th>
                                        <th>Category</th>
                                        <th>Package Name</th>
                                        <th>Period</th>
                                        <th>Price</th>
                                        @can('package-edit')
                                            <th>Status</th>
                                        @endcan
                                        @if (Auth::user()->haspermission('package-edit') ||
                                                Auth::user()->haspermission('package-view') ||
                                                Auth::user()->haspermission('package-delete'))
                                            <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($packages as $index => $package)
                                        <tr>
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>{{ $package->created_at->format('d-M-Y') }}</td>
                                            <td><img src="{{ asset('uploads/package') }}/{{ $package->package_image }}"
                                                    alt="package image" class="w-50"></td>
                                            <td>{{ Str::limit($package->category->category_name, 25, '...') }}</td>
                                            <td>{{ Str::limit($package->package_name, 25, '...') }}</td>
                                            <td>{{ $package->package_period }} Day</td>
                                            <td>{{ $package->package_price }}</td>
                                            @can('package-edit')
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input class="custom-control-input toggle-class" type="checkbox"
                                                            data-id="{{ $package->id }}" id="package-{{ $package->id }}"
                                                            {{ $package->is_active ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="package-{{ $package->id }}"></label>
                                                    </div>
                                                </td>
                                            @endcan
                                            @if (Auth::user()->haspermission('package-edit') ||
                                                    Auth::user()->haspermission('package-view') ||
                                                    Auth::user()->haspermission('package-delete'))
                                                <td class="text-right">
                                                    <div class="actions d-flex justify-content-start">
                                                        @can('package-edit')
                                                            <a href="{{ route('package.edit', $package->id) }}"
                                                                class="btn btn-sm btn-outline-primary mr-1">
                                                                <i class="fas fa-pen"></i>
                                                            </a>
                                                        @endcan
                                                        @can('package-view')
                                                            <a href="{{ route('package.show', $package->id) }}"
                                                                class="btn btn-sm btn-outline-primary mr-1">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        @endcan
                                                        @can('package-delete')
                                                            <form action="{{ route('package.destroy', $package->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class=" btn btn-sm btn-outline-danger show_confirm">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @endcan
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
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
                    url: '/admin/package/is_active/' + item_id,
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
