@extends('frontend.layout.master')
@section('title')
@endsection
@push('user_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')
    <section id="center">
        <div class="center_1">
            <div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
                <!-- Overlay -->
                <div class="overlay"></div>

                <!-- Indicators -->
                <ol class="carousel-indicators">
                    @foreach ($sliders as $key => $slider)
                        <li data-target="#bs-carousel" data-slide-to="{{ $key }}"
                            class="{{ $key == 0 ? 'active' : '' }}"></li>
                    @endforeach
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    @foreach ($sliders as $key => $slider)
                        <div class="item slides {{ $key == 0 ? 'active' : '' }}">
                            <div class="slide-1">
                                <img src="{{ asset('uploads/slider') }}/{{ $slider->slider_image }}" alt="">
                            </div>
                            <div class="hero">
                                <div class="col-12">
                                    <hgroup>
                                        <h1>{{ $slider->slider_heading }}</h1>
                                        <h4>{{ $slider->slider_details }}</h4>
                                    </hgroup>
                                    <button class="btn btn-hero btn-lg" role="button">Trip Now</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section id="routes">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 routes_main">
                    <h2> <i class="fa fa-hiking"></i>Our New Trip *</h2>

                    <div class="col-sm-3">
                        <div class="routes_inner pb-5">
                            <a href="#"><img src="img/4.jpg" width="100%"></a>
                            <div class="routes_inner_1 clearfix">
                                <h4>India to America</h4>
                                <p><i class="fa-solid fa-sm fa-bangladeshi-taka-sign"></i> 2000 </p>
                                <span> <a href="#">View Details</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="routes_inner pb-5">
                            <a href="#"><img src="img/4.jpg" width="100%"></a>
                            <div class="routes_inner_1 clearfix">
                                <h4>India to America</h4>
                                <p><i class="fa-solid fa-sm fa-bangladeshi-taka-sign"></i> 2000 </p>
                                <span> <a href="#">View Details</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="routes_inner pb-5">
                            <a href="#"><img src="img/4.jpg" width="100%"></a>
                            <div class="routes_inner_1 clearfix">
                                <h4>India to America</h4>
                                <p><i class="fa-solid fa-sm fa-bangladeshi-taka-sign"></i> 2000 </p>
                                <span> <a href="#">View Details</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="routes_inner pb-5">
                            <a href="#"><img src="img/4.jpg" width="100%"></a>
                            <div class="routes_inner_1 clearfix">
                                <h4>India to America</h4>
                                <p><i class="fa-solid fa-sm fa-bangladeshi-taka-sign"></i> 2000 </p>
                                <span> <a href="#">View Details</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="routes_inner pb-5">
                            <a href="#"><img src="img/4.jpg" width="100%"></a>
                            <div class="routes_inner_1 clearfix">
                                <h4>India to America</h4>
                                <p><i class="fa-solid fa-sm fa-bangladeshi-taka-sign"></i> 2000 </p>
                                <span> <a href="#">View Details</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="routes_inner pb-5">
                            <a href="#"><img src="img/4.jpg" width="100%"></a>
                            <div class="routes_inner_1 clearfix">
                                <h4>India to America</h4>
                                <p><i class="fa-solid fa-sm fa-bangladeshi-taka-sign"></i> 2000 </p>
                                <span> <a href="#">View Details</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="routes_inner pb-5">
                            <a href="#"><img src="img/4.jpg" width="100%"></a>
                            <div class="routes_inner_1 clearfix">
                                <h4>India to America</h4>
                                <p><i class="fa-solid fa-sm fa-bangladeshi-taka-sign"></i> 2000 </p>
                                <span> <a href="#">View Details</a></span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-12 routes_bottom">
                    <p> * According to Our Term and Condition</p>
                </div>
            </div>
        </div>
    </section>



    <section id="customer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-4 customer_1">
                        <img src="img/12.jpg" width="100%">
                    </div>
                    <div class="col-sm-8 customer_2">
                        <h3> Lorem ipsum dolor sit consectetur adipiscing </h3>
                        <div class="customer_2_inner clearfix">
                            <div class="col-sm-8 customer_2_inner_1">
                                <h4>Download Our app & </h4>
                                <p>Get upto <span>100 OFF*</span> per travel on Airways</p>
                                <p>Full <span>10% OFF*</span> on Travel Tickets</p>
                            </div>
                            <div class="col-sm-4 customer_2_inner_2 text-center">
                                <h4> Use Recharge code</h4>
                                <p>DAPIBUS</p>
                            </div>

                        </div>
                        <div class="customer_last">
                            <a href="#"><img src="img/13.png"></a>
                            <a href="#"><img src="img/13.png"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="destination">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2> <i class="fa fa-map-marker"></i> Our Holiday Packages</h2>
                </div>
                <div class="col-sm-12 destination">
                    <div class="col-sm-2 destination_1">
                        <a href="#"><img src="img/14.jpg" width="100%"></a>
                        <h3>Singapore</h3>
                    </div>
                    <div class="col-sm-2 destination_1">
                        <a href="#"><img src="img/15.jpg" width="100%"></a>
                        <h3>America</h3>
                    </div>
                    <div class="col-sm-2 destination_1">
                        <a href="#"><img src="img/16.jpg" width="100%"></a>
                        <h3>Thiland</h3>
                    </div>
                    <div class="col-sm-2 destination_1">
                        <a href="#"><img src="img/17.jpg" width="100%"></a>
                        <h3>Nepal</h3>
                    </div>
                    <div class="col-sm-2 destination_1">
                        <a href="#"><img src="img/18.jpg" width="100%"></a>
                        <h3>Jakarta</h3>
                    </div>
                    <div class="col-sm-2 destination_1">
                        <a href="#"><img src="img/19.jpg" width="100%"></a>
                        <h3>Australia</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="booking">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 booking">
                    <h2> <i class="fa fa-paper-plane"></i> Why Book <span> Us</span> ?</h2>
                    <div class="clearfix">
                        <div class="col-sm-4 booking_inner">
                            <p class="text-center"><i class="fa-solid fa-person-shelter"></i></p>
                            <h5>Convenience</h5>
                            <h4> Booking with us is hassle-free. We take care of all the details, from transportation and
                                accommodation to activity reservations, so you can focus on making memories.</h4>
                        </div>
                        <div class="col-sm-4 booking_inner">
                            <p class="text-center"><i class="fa-solid fa-users"></i></p>
                            <h5>Expertise</h5>
                            <h4>Our team consists of experienced travelers and experts in the travel industry. We've scoured
                                the globe to curate the best destinations and activities, ensuring you get the most out of
                                your trip.</h4>
                        </div>
                        <div class="col-sm-4 booking_inner">
                            <p class="text-center"><i class="fa-solid fa-shield"></i></p>
                            <h5>Safety and Reliability</h5>
                            <h4>Your safety is our top priority. We partner with trusted suppliers and adhere to strict
                                safety standards to ensure you have a secure and worry-free journey.</h4>
                        </div>
                    </div>


                    <div class="clearfix">
                        <div class="col-sm-4 booking_inner">
                            <p class="text-center"><i class="fa-solid fa-bangladeshi-taka-sign"></i></p>
                            <h5>Value for Money</h5>
                            <h4> We believe that exceptional travel experiences shouldn't break the bank. We offer
                                competitive prices without compromising on quality, so you get the best value for your
                                money.</h4>
                        </div>
                        <div class="col-sm-4 booking_inner">
                            <p class="text-center"><i class="fa-regular fa-credit-card"></i></p>
                            <h5>Easy Booking</h5>
                            <h4>Our user-friendly website and mobile app make booking a breeze. You can plan your dream
                                getaway with just a few clicks.</h4>
                        </div>
                        <div class="col-sm-4 booking_inner">
                            <p class="text-center"><i class="fa-solid fa-headset"></i></p>
                            <h5>24/7 Support</h5>
                            <h4>Our dedicated customer support team is available around the clock to assist you with any
                                questions or concerns before, during, or after your trip.</h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
@push('user_script')
@endpush
