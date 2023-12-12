@extends('frontend.layout.master')
@section('title')
    Hotel
@endsection
@push('user_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')
    <section id="chart">
        <div class="container">
            <div class="row">
                <form id="search" action="{{ route('hotelSearch') }}" method="POST">
                    @csrf
                    <div class="chart_1 clearfix">
                        <div class="book col-sm-8">
                            <div class="col-sm-6 space_left book_1">
                                <p>Location</p>
                                <select name="location" id="location" class="form-control input-lg">
                                    <option>Select</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->hotel_location }}">{{ $location->hotel_location }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="col-sm-4 more_2">
                            <div class="col-sm-3 space_left search_inner"><a href="#"
                                    onclick="document.getElementById('search').submit();">Search</a></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    @if (!empty($hotels) && $hotels->count() > 0)
        @foreach ($hotels as $hotel)
            <section id="package">
                <div class="container">
                    <div class="row">
                        <div class="click clearfix">
                            <div class="col-sm-3 trip_detail_left_main">
                                <div class="trip_detail_main clearfix">
                                    <div class="trip_detail_image"><a
                                            href="{{ route('hotelDetail', ['id' => $hotel->id]) }}"><img
                                                src="{{ asset('uploads/hotel') }}/{{ $hotel->hotel_image }}" width="100%"
                                                height="170px"></a></div>
                                </div>
                            </div>
                            <div class="col-sm-9 trip_detail_right_main_custom">
                                <div class="trip_detail_right clearfix">
                                    <div class="col-sm-9 clearfix trip_detail_right_inner">
                                        <h3><a href="{{ route('hotelDetail', ['id' => $hotel->id]) }}"><i
                                                    class="fa fa-building"></i>{{ $hotel->hotel_name }}</a></h3>
                                        <h5><i class="fa fa-map-marker"></i> Location :<span>
                                                {{ $hotel->hotel_location }}</span></h5>
                                    </div>
                                    <div class="col-sm-3 clearfix trip_detail_right_inner_1">
                                        <h2 class="text-right">৳ {{ $hotel->room_price }}</h2>
                                        <h5 class="text-right">{{ $hotel->room_type }}</h5>
                                        <h4 class="text-right">
                                            <a href="{{ route('hotelDetail', ['id' => $hotel->id]) }}">View Details</a>
                                        </h4>
                                    </div>
                                </div>
                                <div class="trip_detail_last clearfix">
                                    <div class="col-sm-12 trip_detail_last_1">

                                        <span class="span_star">
                                            @for ($i = 0; $i < $hotel->hotel_rating; $i++)
                                                <i class="fa fa-star"></i>
                                            @endfor
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endforeach
    @else
        @foreach ($all_hotels as $hotel)
            <section id="package">
                <div class="container">
                    <div class="row">
                        <div class="click clearfix">
                            <div class="col-sm-3 trip_detail_left_main">
                                <div class="trip_detail_main clearfix">
                                    <div class="trip_detail_image"><a
                                            href="{{ route('hotelDetail', ['id' => $hotel->id]) }}"><img
                                                src="{{ asset('uploads/hotel') }}/{{ $hotel->hotel_image }}"
                                                width="100%" height="170px"></a></div>
                                </div>
                            </div>
                            <div class="col-sm-9 trip_detail_right_main_custom">
                                <div class="trip_detail_right clearfix">
                                    <div class="col-sm-9 clearfix trip_detail_right_inner">
                                        <h3><a href="{{ route('hotelDetail', ['id' => $hotel->id]) }}"><i
                                                    class="fa fa-building"></i>{{ $hotel->hotel_name }}</a></h3>
                                        <h5><i class="fa fa-map-marker"></i> Location :<span>
                                                {{ $hotel->hotel_location }}</span></h5>
                                    </div>
                                    <div class="col-sm-3 clearfix trip_detail_right_inner_1">
                                        <h2 class="text-right">৳ {{ $hotel->room_price }}</h2>
                                        <h5 class="text-right">{{ $hotel->room_type }}</h5>
                                        <h4 class="text-right">
                                            <a href="{{ route('hotelDetail', ['id' => $hotel->id]) }}">View Details</a>
                                        </h4>
                                    </div>
                                </div>
                                <div class="trip_detail_last clearfix">
                                    <div class="col-sm-12 trip_detail_last_1">

                                        <span class="span_star">
                                            @for ($i = 0; $i < $hotel->hotel_rating; $i++)
                                                <i class="fa fa-star"></i>
                                            @endfor
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endforeach
    @endif
@endsection
@push('user_script')
@endpush
