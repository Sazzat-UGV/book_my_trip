@extends('frontend.layout.master')
@section('title')
Hotel Details
@endsection
@push('user_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
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
                                                    <img src="{{ asset('uploads/hotel') }}/{{ $hotel->hotel_image }}"
                                                        alt="Hotel Image">
                                                </div>
                                            </div>


                                            <div class="conclusion clearfix">
                                                <div class="col-lg-12 col-md-12 col-sm-6 conclusion_left border_2">
                                                    <h5>Details</h5>
                                                    {!! $hotel->hotel_details !!}
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
                                                    <img src="{{ asset('uploads/hotel') }}/{{ $image->hotel_multiple_image }}"
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
                                <h4><i class="fa fa-building"></i> {{ $hotel->hotel_name }}</h4>
                                <h5><i class="fa-solid fa-location-dot"></i>{{ $hotel->hotel_location }}</h5>
                                <h5><i class="fa-solid fa-bed"></i>{{ $hotel->room_type }}</h5>

                            </div>
                            <div class="detail_package_right_1 text-center">
                                <div class="d-flex justify-content-center pt-3">
                                    <form id="myForm" action="your_action_url_here" method="POST">
                                        <h3><span>৳</span>{{ $hotel->room_price }}</h3>
                                        <div class="book_3 clearfix">
                                            <a href="#" onclick="document.getElementById('myForm').submit();">Book</a>
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
@endpush
