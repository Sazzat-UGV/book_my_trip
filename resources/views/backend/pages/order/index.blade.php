@extends('backend.layout.master')
@section('title')
    Order List
@endsection
@push('admin_style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
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
    @include('backend.layout.inc.breadcump', ['page_name' => 'Order List'])
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="table-responsive  my-3">
                            <table id="example" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Booking Date</th>
                                        <th>User Name</th>
                                        <th>Booking Type</th>
                                        <th>Item Name</th>
                                        <th>Booked For</th>
                                        <th>Payment Status</th>
                                        <th>Booked Date</th>
                                        <th>Booking Status</th>
                                        <th>Amount</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $index => $order)
                                        <tr>
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td class=".text-wrap">{{ $order->created_at->format('d-M-Y') }}</td>
                                            <td class=".text-wrap">{{ $order->name }}</td>
                                            <td class=".text-wrap">{{ $order->booking_package_type }}</td>
                                            <td class=".text-wrap">{{ $order->booking_package_name }}</td>
                                            <td class=".text-wrap">{{ $order->member }}</td>
                                            <td class=".text-wrap"><span
                                                    style="border: 1px solid green; padding:0 8px; background: green; color: white;  border-radius: 20px">{{ $order->payment_status }}</span>
                                            </td>
                                            <td class=".text-wrap">{{ date('d F Y', strtotime($order->booking_from)) }}</td>

                                            <td class=".text-wrap">
                                                <a href="{{ route('admin.orderStatus', ['id' => $order->id]) }}"
                                                    class="btn">
                                                    @if ($order->booking_status == 'Pending')
                                                        <span
                                                            style="border: 1px solid red; padding:0 8px; background: red; color: white;  border-radius: 20px">{{ $order->booking_status }}</span>
                                                    @else
                                                        <span
                                                            style="border: 1px solid green; padding:0 8px; background: green; color: white;  border-radius: 20px">{{ $order->booking_status }}</span>
                                                    @endif
                                                </a>
                                            </td>

                                            <td class=".text-wrap">{{ $order->amount }} {{ $order->currency }}</td>
                                            <td class="text-right">
                                                <div class="actions d-flex justify-content-start">
                                                    <a href="#" class="btn btn-sm btn-outline-primary mr-1"
                                                        data-toggle="modal" data-target="#myModal-{{ $order->id }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            </td>

                                        </tr>
                                        <div class="modal fade" id="myModal-{{ $order->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModal-{{ $order->id }}Label"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModal-{{ $order->id }}Label">
                                                            Details</h5>
                                                        <button class="close" type="button" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-wrap">
                                                            <p><span>User Name: {{ $order->name }}</span></p>
                                                            <p><span>Email: {{ $order->email }}</span></p>
                                                            <p><span>Phone: {{ $order->phone }}</span></p>
                                                            <p><span>Address: {{ $order->address }}</span></p>
                                                            <p><span>Booking Type:
                                                                    {{ $order->booking_package_type }}</span></p>
                                                            <p><span>Booking Item:
                                                                    {{ $order->booking_package_name }}</span></p>
                                                            <p><span>Booked For: {{ $order->member }}</span></p>
                                                            <p><span>Booked Date: {{ $order->booking_from }}</span></p>
                                                            <p><span>Booking Amount: {{ $order->amount }}
                                                                    {{ $order->currency }}</span></p>
                                                        </div>
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
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                pagingType: 'first_last_numbers',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
@endpush
