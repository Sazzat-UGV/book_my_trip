@extends('backend.layout.master')
@section('title')
    Category List
@endsection
@push('admin_style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush
@section('content')
    @include('backend.layout.inc.breadcump', ['page_name' => 'Category List'])
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        @can('category-create')
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('category.create') }}" class=" btn btn-primary shadow-sm"><i
                                        class="fas fa-plus-circle text-white-50"></i> Create New Category</a>
                            </div>
                        @endcan
                        <div class="table-responsive text-nowrap my-3">
                            <table id="example" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Created at</th>
                                        <th>Category Name</th>
                                        @can('category-edit')
                                        <th>Status</th>
                                        @endcan
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $index => $category)
                                        <tr>
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>{{ $category->created_at->format('d-M-Y') }}</td>
                                            <td>{{ $category->category_name }}</td>
                                            @can('category-edit')
                                            <td>
                                                <div class="custom-control custom-switch">
                                                    <input class="custom-control-input toggle-class" type="checkbox"
                                                        data-id="{{ $category->id }}" id="category-{{ $category->id }}"
                                                        {{ $category->is_active ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="category-{{ $category->id }}"></label>
                                                </div>
                                            </td>
                                        @endcan
                                            <td class="text-right">
                                                <div class="actions d-flex justify-content-start">
                                                    <a href="{{ route('category.edit', $category->id) }}"
                                                        class="btn btn-sm btn-outline-primary mr-1">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    @can('contact-delete')
                                                        <form action="{{ route('category.destroy', $category->id) }}"
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
                        url: '/admin/category/is_active/' + item_id,
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
