@extends('frontend.layout.master')
@section('title')
    My Booking
@endsection
@push('user_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <style>
        .section {
            padding: 50px 0;
            position: relative;
        }

        .gray-bg {
            background-color: #f5f5f5;
        }

        .text-wrap {
            white-space: normal !important;
            /* Enable text wrapping */
            word-wrap: break-word;
            /* Wrap long words */
        }
    </style>
@endpush
@section('content')
    <section class="section about-section gray-bg" id="about">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-12">
                    <div class="table-responsive text-nowrap my-3">
                        <table id="example" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Booking Date</th>
                                    <th>Booking Type</th>
                                    <th>Item Name</th>
                                    <th>Booked For</th>
                                    <th>Payment Status</th>
                                    <th>Booked Date</th>
                                    <th>Booking Status</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $index => $order)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td class=".text-wrap">{{ $order->created_at->format('d-M-Y') }}</td>
                                        <td class=".text-wrap">{{ $order->booking_package_type }}</td>
                                        <td class=".text-wrap">{{ $order->booking_package_name }}</td>
                                        <td class=".text-wrap">{{ $order->member }}</td>
                                        <td class=".text-wrap"><span
                                                style="border: 1px solid green; padding:0 8px; background: green; color: white;  border-radius: 20px">{{ $order->payment_status }}</span>
                                        </td>
                                        <td class=".text-wrap">{{ date('d F Y', strtotime($order->booking_from)) }}</td>

                                        <td class=".text-wrap">
                                            @if ($order->booking_status == 'Pending')
                                                <span
                                                    style="border: 1px solid red; padding:0 8px; background: red; color: white;  border-radius: 20px">{{ $order->booking_status }}</span>
                                            @else
                                                <span
                                                    style="border: 1px solid green; padding:0 8px; background: green; color: white;  border-radius: 20px">{{ $order->booking_status }}</span>
                                            @endif
                                        </td>

                                        <td class=".text-wrap">{{ $order->amount }} {{ $order->currency }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('user_script')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                pagingType: 'first_last_numbers',

            });
        });
    </script>
@endpush
