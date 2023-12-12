@extends('frontend.layout.master')
@section('title')
    Package Details
@endsection
@push('user_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Style for the decrement button */
        .increment-decrement button:nth-child(1) {
            padding: 5px 10px;
            color: white;
            border: none;
            border-radius: 4px 0 0 4px;
            cursor: pointer;
        }

        /* Style for the input field */
        .increment-decrement input[type="number"] {
            width: 40px;
            text-align: center;
        }

        /* Style for the increment button */
        .increment-decrement button:nth-child(3) {
            padding: 5px 10px;
            color: white;
            border: none;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
        }
    </style>
@endpush
@section('content')
    <section id="details">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="detail_package clearfix">
                        <div class="col-sm-9 detail_package_left">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#term">INFORMATION</a></li>
                                <li><a data-toggle="tab" href="#gallery_1">GALLERY</a></li>
                            </ul>

                            <div class="tab-content clearfix">
                                <div id="term" class="tab-pane fade in active clearfix">
                                    <div class="click clearfix">
                                        <div class="col-sm-12 detail_package_left_inner">
                                            <div class="carousel-inner">
                                                <div class="item active">
                                                    <img src="{{ asset('uploads/package') }}/{{ $package->package_image }}"
                                                        alt="Package Image">
                                                </div>
                                            </div>

                                            <div class="duration clearfix">
                                                <div class="col-md-4 col-lg-4 col-sm-4 duration_left">
                                                    <p><i class="fa fa-times-circle-o"></i>Trip Period :
                                                        <span>{{ $package->package_period }} Days</span>
                                                    </p>
                                                </div>
                                                <div class="col-md-8 col-lg-8 col-sm-4 duration_left">
                                                    <p><i class="fa fa-calendar"></i>Trip Validity <span>
                                                            {{ date('d F Y', strtotime($package->starting_date)) }} -
                                                            {{ date('d F Y', strtotime($package->ending_date)) }}</span></p>
                                                </div>
                                            </div>
                                            <div class="conclusion clearfix">
                                                <div class="col-lg-12 col-md-12 col-sm-6 conclusion_left border_2">
                                                    <h5>Details</h5>
                                                    {!! $package->package_details !!}
                                                </div>
                                            </div>
                                            <div class="blank clearfix"></div>
                                        </div>
                                    </div>
                                </div>

                                <div id="gallery_1" class="tab-pane fade clearfix gallery_1m">
                                    <div class="gallery_1i clearfix">
                                        @foreach ($images as $image)
                                            <div class="col-sm-4">
                                                <div class="box_inner clearfix">
                                                    <img src="{{ asset('uploads/package') }}/{{ $image->package_multiple_image }}"
                                                        alt="multiple image" style="width:100%; margin-bottom: 20px;">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 detail_package_right">
                            <div class="detail_package_right_top">
                                <h4><i class="fa fa-umbrella"></i> {{ $package->package_name }}</h4>
                                <h5><i class="fa fa-times-circle-o"></i>{{ $package->package_period }} Days</h5>
                                <h5><i class="fa-solid fa-bangladeshi-taka-sign"></i>{{ $package->package_price }} /person
                                </h5>
                            </div>
                            <div class="detail_package_right_1 text-center">
                                <marquee behavior="" direction=""><span style="color: red">Only age less than 10 are
                                        free</span></marquee>
                                <h3><span>৳</span> <span id="totalPrice">{{ $package->package_price }}</span></h3>
                                <!-- Display the number of members -->
                                <div class="number-of-members">for <span id="memberCount">1 </span> person </div>
                                <div class="d-flex justify-content-center pt-3">
                                    <form id="myForm" action="{{ route('payment') }}" method="POST">
                                        @csrf
                                        <div class="increment-decrement text-center">
                                            <input type="hidden" name="module_id" value="1">
                                            <input type="hidden" name="package_id" value="{{ $package->id }}">
                                            <button type="button" class="btn btn-danger"
                                                onclick="decrementValue()">-</button>
                                            <input type="number" name="number_of_member" id="number_of_member"
                                                value="1" oninput="calculateTotalPrice" disabled>
                                            <button type="button" class="btn btn-success"
                                                onclick="incrementValue()">+</button>
                                        </div>
                                        <div class="book_3 clearfix">
                                            @auth
                                                @if (Auth::user()->phone && Auth::user()->address)
                                                    <a href="#" onclick="submitForm()">Book</a>
                                                @else
                                                    <h4 style="color: red">Please add your phone number add address before book
                                                    </h4>
                                                @endif
                                            @endauth
                                            @guest
                                                <h4 style="color: red">To booked the package you must login first</h4>
                                            @endguest

                                        </div>
                                    </form>
                                </div>


                                <div class="book_4 clearfix"><a href="{{ route('contact') }}"><i
                                            class="fa fa-envelope"></i>For Enquiry</a></div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('user_script')
    <script>
        function incrementValue() {
            var inputElement = document.getElementById('number_of_member');
            inputElement.value = parseInt(inputElement.value) + 1;
            calculateTotalPrice();
            updateMemberCount();
        }

        function decrementValue() {
            var inputElement = document.getElementById('number_of_member');
            if (inputElement.value > 1) {
                inputElement.value = parseInt(inputElement.value) - 1;
                calculateTotalPrice();
                updateMemberCount();
            }
        }

        function calculateTotalPrice() {
            var inputElement = document.getElementById('number_of_member');
            var priceElement = document.getElementById('totalPrice');
            var totalPrice = parseFloat(inputElement.value) * {{ $package->package_price }};
            priceElement.innerText = totalPrice;
        }

        function updateMemberCount() {
            var inputElement = document.getElementById('number_of_member');
            var memberCountElement = document.getElementById('memberCount');
            memberCountElement.innerText = inputElement.value;
        }

        function submitForm() {
            var memberCount = 0;
            document.getElementById('memberCount').value = memberCount;
            document.getElementById('number_of_member').removeAttribute('disabled');
            document.getElementById('myForm').submit();
        }
    </script>
@endpush
