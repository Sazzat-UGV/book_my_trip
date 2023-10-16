@extends('backend.layout.master')
@section('title')
    Hotel List
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
    @include('backend.layout.inc.breadcump', ['page_name' => 'Hotel List'])
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        @can('hotel-create')
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('hotel.create') }}" class=" btn btn-primary shadow-sm"><i
                                        class="fas fa-plus-circle text-white-50"></i> Add New Hotel</a>
                            </div>
                        @endcan
                        <div class="table-responsive text-nowrap my-3">
                            <table id="example" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Created at</th>
                                        <th>Image</th>
                                        <th>Hotel Name</th>
                                        <th>Location</th>
                                        <th>Room Type</th>
                                        <th>Price</th>
                                        @can('hotel-edit')
                                            <th>Status</th>
                                        @endcan
                                        @if (Auth::user()->haspermission('hotel-edit') ||
                                                Auth::user()->haspermission('hotel-view') ||
                                                Auth::user()->haspermission('hotel-delete'))
                                            <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hotels as $index => $hotel)
                                        <tr>
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td class="text-wrap">{{ $hotel->created_at->format('d-M-Y') }}</td>
                                            <td class="text-wrap"><img src="{{ asset('uploads/hotel') }}/{{ $hotel->hotel_image }}"
                                                    alt="hotel image" class="w-50"></td>
                                            <td class="text-wrap">{{ $hotel->hotel_name }}</td>
                                            <td class="text-wrap">{{ $hotel->hotel_location }}</td>
                                            <td class="text-wrap">{{ $hotel->room_type }}</td>
                                            <td class="text-wrap">{{ $hotel->room_price }}</td>
                                            @can('hotel-edit')
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input class="custom-control-input toggle-class" type="checkbox"
                                                            data-id="{{ $hotel->id }}" id="hotel-{{ $hotel->id }}"
                                                            {{ $hotel->is_active ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="hotel-{{ $hotel->id }}"></label>
                                                    </div>
                                                </td>
                                            @endcan
                                            @if (Auth::user()->haspermission('hotel-edit') ||
                                                    Auth::user()->haspermission('hotel-view') ||
                                                    Auth::user()->haspermission('hotel-delete'))
                                                <td class="text-right">
                                                    <div class="actions d-flex justify-content-start">
                                                        @can('hotel-edit')
                                                            <a href="{{ route('hotel.edit', $hotel->id) }}"
                                                                class="btn btn-sm btn-outline-primary mr-1">
                                                                <i class="fas fa-pen"></i>
                                                            </a>
                                                        @endcan
                                                        @can('hotel-view')
                                                            <a href="{{ route('hotel.show', $hotel->id) }}"
                                                                class="btn btn-sm btn-outline-primary mr-1">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        @endcan
                                                        @can('hotel-delete')
                                                            <form action="{{ route('hotel.destroy', $hotel->id) }}"
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
                    url: '/admin/hotel/is_active/' + item_id,
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
