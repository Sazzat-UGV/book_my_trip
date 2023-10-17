@extends('frontend.layout.master')
@section('title')
Package
@endsection
@push('user_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
@endpush
@section('content')
    <section id="package">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="trip_detail clearfix">
                        <ul class="nav nav-tabs tab_trip">
                            <li class="active"><a data-toggle="tab" href="#all">All Package</a></li>
                            @foreach ($categories as $category)
                                <li><a data-toggle="tab" href="#{{ $category->id }}">{{ $category->category_name }}</a></li>
                            @endforeach
                        </ul>

                        <div class="tab-content clearfix">
                            <div id="all" class="tab-pane fade in active clearfix">
                                @foreach ($all_package as $package)
                                    <div class="click clearfix">
                                        <div class="col-sm-3 trip_detail_left_main">
                                            <div class="trip_detail_main clearfix">
                                                <div class="trip_detail_image"><a
                                                        href="{{ route('detail', ['id' => $package->id]) }}"><img
                                                            src="{{ asset('uploads/package') }}/{{ $package->package_image }}"
                                                            width="100%" height="237px"></a></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-9 trip_detail_right_main">
                                            <div class="trip_detail_right clearfix">
                                                <div class="col-sm-9 clearfix trip_detail_right_inner">
                                                    <h3><a href="{{ route('detail', ['id' => $package->id]) }}"><i
                                                                class="fa fa-umbrella"></i>{{ $package->package_name }}</a>
                                                    </h3>
                                                    <p>Trip Period: <strong>{{ $package->package_period }} Days</strong></p>
                                                    <p>Validity: <strong>
                                                            {{ date('d F Y', strtotime($package->starting_date)) }} -
                                                            {{ date('d F Y', strtotime($package->ending_date)) }}</strong>
                                                    </p>
                                                    <div class="trip_menu clearfix">
                                                        <span class="deco_1"><a href="#"><i
                                                                    class="fa fa-bus"></i>Travels</a></span>
                                                        <span class="deco_1"><a href="#"><i
                                                                    class="fa fa-hotel"></i>Stays</a></span>
                                                        <span class="deco_1"><a href="#"><i
                                                                    class="fa fa-spoon"></i>Foods</a></span>
                                                        <span class="deco_1"><a href="#"><i
                                                                    class="fa fa-car"></i>Touring</a></span>
                                                        <span class="deco_1 border_none_1"><a href="#"><i
                                                                    class="fa fa-eye"></i>Viewsight</a></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 clearfix trip_detail_right_inner_1">

                                                    <h2 class="text-right">৳ {{ $package->package_price }}</h2>
                                                    <h5 class="text-right">One person / One Thing</h5>
                                                    <h4 class="text-right">
                                                        <a href="{{ route('detail', ['id' => $package->id]) }}">View
                                                            Details</a>

                                                    </h4>
                                                </div>
                                            </div>
                                            <div class="trip_detail_last  clearfix">
                                                <div class="col-lg-4 col-md-4 col-sm-10 trip_detail_last_1">
                                                    <span class="span_star">
                                                        @for ($i = 0; $i < $package->package_rating; $i++)
                                                            <i class="fa fa-star"></i>
                                                        @endfor
                                                    </span>
                                                </div>
                                                <div class="col-lg-8 col-md-8 col-sm-2 text-right trip_detail_last_2">
                                                    <h5><i class="fa fa-map-marker"></i>From
                                                        :<span>{{ $package->start_from }}</span></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            @foreach ($categories as $category)
                                <div id="{{ $category->id }}" class="tab-pane fade clearfix">
                                    @forelse ($category->package as $cpackage)
                                        <div class="click clearfix">
                                            <div class="col-sm-3 trip_detail_left_main">
                                                <div class="trip_detail_main clearfix">
                                                    <div class="trip_detail_image"><a href="#"><img
                                                                src="{{ asset('uploads/package') }}/{{ $cpackage->package_image }}"
                                                                width="100%" height="237px"></a></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-9 trip_detail_right_main">
                                                <div class="trip_detail_right clearfix">
                                                    <div class="col-sm-9 clearfix trip_detail_right_inner">
                                                        <h3><a href="#"><i
                                                                    class="fa fa-umbrella"></i>{{ $cpackage->package_name }}</a>
                                                        </h3>
                                                        <p>Trip Period: <strong>{{ $cpackage->package_period }}
                                                                Days</strong></p>
                                                        <p>Validity: <strong>
                                                                {{ date('d F Y', strtotime($cpackage->starting_date)) }} -
                                                                {{ date('d F Y', strtotime($cpackage->ending_date)) }}</strong>
                                                        </p>
                                                        <div class="trip_menu clearfix">
                                                            <span class="deco_1"><a href="#"><i
                                                                        class="fa fa-bus"></i>Travels</a></span>
                                                            <span class="deco_1"><a href="#"><i
                                                                        class="fa fa-hotel"></i>Stays</a></span>
                                                            <span class="deco_1"><a href="#"><i
                                                                        class="fa fa-spoon"></i>Foods</a></span>
                                                            <span class="deco_1"><a href="#"><i
                                                                        class="fa fa-car"></i>Touring</a></span>
                                                            <span class="deco_1 border_none_1"><a href="#"><i
                                                                        class="fa fa-eye"></i>Viewsight</a></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 clearfix trip_detail_right_inner_1">

                                                        <h2 class="text-right">৳ {{ $cpackage->package_price }}</h2>
                                                        <h5 class="text-right">One person / One Thing</h5>
                                                        <h4 class="text-right">
                                                            <a href="{{ route('detail', ['id' => $package->id]) }}"><i
                                                                    class="fa fa-info-circle"></i>View
                                                                Details</a>

                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="trip_detail_last  clearfix">
                                                    <div class="col-lg-4 col-md-4 col-sm-10 trip_detail_last_1">
                                                        <span class="span_star">
                                                            @for ($i = 0; $i < $cpackage->package_rating; $i++)
                                                                <i class="fa fa-star"></i>
                                                            @endfor
                                                        </span>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-2 text-right trip_detail_last_2">
                                                        <h5><i class="fa fa-map-marker"></i>From
                                                            :<span>{{ $cpackage->start_from }}</span></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <h2 class="text-center">No Package Found!</h2>
                                    @endforelse
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('user_script')
@endpush
