@extends('backend.layout.master')
@section('title')
    Flight List
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
    @include('backend.layout.inc.breadcump', ['page_name' => 'Flight List'])
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        @can('flight-create')
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('flight.create') }}" class=" btn btn-primary shadow-sm"><i
                                        class="fas fa-plus-circle text-white-50"></i> Add New Flight</a>
                            </div>
                        @endcan
                        <div class="table-responsive text-nowrap my-3">
                            <table id="example" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Airlines Name</th>
                                        <th>Model</th>
                                        <th>Departure</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th  class="text-wrap">Available/Total Sit</th>
                                        <th>Price</th>
                                        <th>Flight Date</th>

                                        @can('flight-edit')
                                            <th>Status</th>
                                        @endcan
                                        @if (Auth::user()->haspermission('flight-edit') || Auth::user()->haspermission('flight-delete'))
                                            <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($flights as $index => $flight)

                                        <?php $flight->departure_time = new DateTime($flight->departure_time); ?>
                                        <tr>
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td class="text-wrap">{{ $flight->airlines_name }}</td>
                                            <td class="text-wrap">{{ $flight->airlines_model }}</td>
                                            <td class="text-wrap">{{ $flight->departure_time->format('h:i A') }}</td>
                                            <td class="text-wrap">{{ $flight->from }}</td>
                                            <td class="text-wrap">{{ $flight->to }}</td>
                                            <td class="text-wrap"><span class="badge badge-success">{{ $flight->available_sit }}</span>/<span class="badge badge-danger">{{ $flight->total_sit }}</span></td>
                                            <td class="text-wrap">{{ $flight->price }}</td>
                                            <td class="text-wrap">{{ $flight->flight_date }}</td>
                                            @can('flight-edit')
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input class="custom-control-input toggle-class" type="checkbox"
                                                            data-id="{{ $flight->id }}" id="flight-{{ $flight->id }}"
                                                            {{ $flight->is_active ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="flight-{{ $flight->id }}"></label>
                                                    </div>
                                                </td>
                                            @endcan
                                            @if (Auth::user()->haspermission('flight-edit') || Auth::user()->haspermission('flight-delete'))
                                                <td class="text-right">
                                                    <div class="actions d-flex justify-content-start">
                                                        @can('flight-edit')
                                                            <a href="{{ route('flight.edit', $flight->id) }}"
                                                                class="btn btn-sm btn-outline-primary mr-1">
                                                                <i class="fas fa-pen"></i>
                                                            </a>
                                                        @endcan
                                                        @can('flight-delete')
                                                            <form action="{{ route('flight.destroy', $flight->id) }}"
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

            $('.toggle-class').change(function() {
                var is_active = $(this).prop('checked') == true ? 1 : 0;
                var item_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/admin/flight/is_active/' + item_id,
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

            });

        });
    </script>
@endpush
