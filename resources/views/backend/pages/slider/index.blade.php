@extends('backend.layout.master')
@section('title')
    Slider List
@endsection
@push('admin_style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <style>
        .text-wrap {
            white-space: normal !important; /* Enable text wrapping */
            word-wrap: break-word; /* Wrap long words */
        }
    </style>

@endpush
@section('content')
    @include('backend.layout.inc.breadcump', ['page_name' => 'Slider List'])
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        @can('slider-create')
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('slider.create') }}" class=" btn btn-primary shadow-sm"><i
                                        class="fas fa-plus-circle text-white-50"></i> Add New Slider</a>
                            </div>
                        @endcan
                        <div class="table-responsive text-nowrap my-3">
                            <table id="example" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Created at</th>
                                        <th>Image</th>
                                        <th>Heading</th>
                                        <th>Details</th>
                                        @can('slider-edit')
                                            <th>Status</th>
                                        @endcan
                                        @if (Auth::user()->haspermission('slider-edit') || Auth::user()->haspermission('slider-delete'))
                                            <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sliders as $index => $slider)
                                        <tr>
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>{{ $slider->created_at->format('d-M-Y') }}</td>
                                            <td><img src="{{ asset('uploads/slider') }}/{{ $slider->slider_image }}"
                                                alt="slider image" class="w-50"></td>
                                                <td class="text-wrap">{{ $slider->slider_heading }}</td>
                                                <td class="text-wrap">{{ $slider->slider_details }}</td>

                                                @can('slider-edit')
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input class="custom-control-input toggle-class" type="checkbox"
                                                            data-id="{{ $slider->id }}" id="slider-{{ $slider->id }}"
                                                            {{ $slider->is_active ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="slider-{{ $slider->id }}"></label>
                                                    </div>
                                                </td>
                                            @endcan
                                            @if (Auth::user()->haspermission('slider-edit') || Auth::user()->haspermission('slider-delete'))
                                                <td class="text-right">
                                                    <div class="actions d-flex justify-content-start">
                                                        @can('slider-edit')
                                                            <a href="{{ route('slider.edit', $slider->id) }}"
                                                                class="btn btn-sm btn-outline-primary mr-1">
                                                                <i class="fas fa-pen"></i>
                                                            </a>
                                                        @endcan
                                                        @can('slider-delete')
                                                            <form action="{{ route('slider.destroy', $slider->id) }}"
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

                $('.toggle-class').change(function() {
                    var is_active = $(this).prop('checked') == true ? 1 : 0;
                    var item_id = $(this).data('id');

                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: '/admin/slider/is_active/' + item_id,
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
        <script>
            $(document).ready(function() {
                $('#example').DataTable({
                    pagingType: 'first_last_numbers',
                    columnDefs: [
                        { width: '5%', targets: 0 },
                        { width: '10%', targets: 1 },
                        { width: '40%', targets: 2 },
                        { width: '15%', targets: 3 },
                        { width: '20%', targets: 4 },
                        { width: '5%', targets: 5 },
                        { width: '5%', targets: 6 },
                    ]
                });

            });
        </script>

    @endpush
