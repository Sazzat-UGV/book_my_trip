@extends('backend.layout.master')
@section('title')
    Hotel View
@endsection
@push('admin_style')

    <style>
        .preview {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column;
        }

        @media screen and (max-width: 996px) {
            .preview {
                margin-bottom: 20px;
            }
        }

        .preview-pic {
            -webkit-box-flex: 1;
            -webkit-flex-grow: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
        }

        .preview-thumbnail.nav-tabs {
            border: none;
            margin-top: 15px;
        }

        .preview-thumbnail.nav-tabs li {
            width: 10%;
            margin-right: 2.5%;
        }

        .preview-thumbnail.nav-tabs li img {
            max-width: 100%;
            display: block;
        }

        .preview-thumbnail.nav-tabs li a {
            padding: 0;
            margin: 0;
        }

        .preview-thumbnail.nav-tabs li:last-of-type {
            margin-right: 0;
        }

        .tab-content {
            overflow: hidden;
        }

        .tab-content img {
            width: 100%;
            -webkit-animation-name: opacity;
            animation-name: opacity;
            -webkit-animation-duration: .3s;
            animation-duration: .3s;
        }


        @media screen and (min-width: 997px) {
            .wrapper {
                display: -webkit-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
            }
        }

        .details {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column;
        }

        .colors {
            -webkit-box-flex: 1;
            -webkit-flex-grow: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
        }

        .product-title,
        .price,
        .sizes,
        .colors {
            text-transform: UPPERCASE;
            font-weight: bold;
        }

        .checked,
        .price span {
            color: #ff9f1a;
        }

        .product-title,
        .rating,
        .product-description,
        .price,
        .vote,
        .sizes {
            margin-bottom: 15px;
        }

        .product-title {
            margin-top: 0;
        }

        .size {
            margin-right: 10px;
        }

        .size:first-of-type {
            margin-left: 40px;
        }

        .color {
            display: inline-block;
            vertical-align: middle;
            margin-right: 10px;
            height: 2em;
            width: 2em;
            border-radius: 2px;
        }

        .color:first-of-type {
            margin-left: 20px;
        }

        .add-to-cart,
        .like {
            background: #ff9f1a;
            padding: 1.2em 1.5em;
            border: none;
            text-transform: UPPERCASE;
            font-weight: bold;
            color: #fff;
            -webkit-transition: background .3s ease;
            transition: background .3s ease;
        }

        .add-to-cart:hover,
        .like:hover {
            background: #b36800;
            color: #fff;
        }

        .not-available {
            text-align: center;
            line-height: 2em;
        }

        .not-available:before {
            font-family: fontawesome;
            content: "\f00d";
            color: #fff;
        }

        .orange {
            background: #ff9f1a;
        }

        .green {
            background: #85ad00;
        }

        .blue {
            background: #0076ad;
        }

        .tooltip-inner {
            padding: 1.3em;
        }

        @-webkit-keyframes opacity {
            0% {
                opacity: 0;
                -webkit-transform: scale(3);
                transform: scale(3);
            }

            100% {
                opacity: 1;
                -webkit-transform: scale(1);
                transform: scale(1);
            }
        }

        @keyframes opacity {
            0% {
                opacity: 0;
                -webkit-transform: scale(3);
                transform: scale(3);
            }

            100% {
                opacity: 1;
                -webkit-transform: scale(1);
                transform: scale(1);
            }
        }
    </style>
@endpush
@section('content')
    @include('backend.layout.inc.breadcump', ['page_name' => 'Hotel View'])
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-start mb-3">
                            <a href="{{ route('hotel.index') }}" class=" btn btn-primary shadow-sm"><i
                                    class="fas fa-arrow-left text-white-50"></i> Back to Hotel List</a>
                        </div>

                        <div class="wrapper row">
                            <div class="preview col-md-6">

                                <div class="preview-pic tab-content">
                                    <div class="tab-pane active" id="pic-1"><img
                                            src="{{ asset('uploads/hotel') }}/{{ $hotels->hotel_image }}" />
                                    </div>
                                </div>

                                <ul class="preview-thumbnail nav nav-tabs ">
                                    @foreach ($images as $image)
                                        <li class="mb-1"><a data-target="#pic-1" data-toggle="tab"><img
                                                    src="{{ asset('uploads/hotel') }}/{{ $image->hotel_multiple_image }}" /></a>
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                            <div class="details col-md-6">
                                <h3 class="product-title">{{ $hotels->hotel_name }}</h3>
                                <div class="rating">
                                    <div class="stars">
                                        @for ($i = 0; $i < $hotels->hotel_rating; $i++)
                                            <span class="fa fa-star checked"></span>
                                        @endfor
                                    </div>
                                </div>
                                <p class="product-description"><span class="review-no"><strong
                                            class="text-danger text-bold">Details:</strong></span>{!! $hotels->hotel_details !!}
                                </p>
                                <h4 class="price">price: <span>৳{{ $hotels->room_price }}</span></h4>
                                <p class="vote"><strong>Location: </strong>{{ $hotels->hotel_location }} </p>
                                <p class="vote"><strong>Room Type: </strong>{{ $hotels->room_type }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('admin_script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Attach a click event handler to the thumbnail images
            $('.preview-thumbnail a').click(function(e) {
                e.preventDefault(); // Prevent the default link behavior

                // Get the URL of the clicked thumbnail image
                var newImageUrl = $(this).find('img').attr('src');

                // Set the source of the main preview image to the clicked thumbnail image URL
                $('#pic-1 img').attr('src', newImageUrl);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var $thumbnails = $('.preview-thumbnail li');
            var currentIndex = 0;

            $('.next-image').click(function() {
                currentIndex = (currentIndex + 1) % $thumbnails.length;
                updatePreviewImage(currentIndex);
            });

            $('.prev-image').click(function() {
                currentIndex = (currentIndex - 1 + $thumbnails.length) % $thumbnails.length;
                updatePreviewImage(currentIndex);
            });

            function updatePreviewImage(index) {
                $thumbnails.removeClass('active');
                $thumbnails.eq(index).addClass('active');
                var newImageUrl = $thumbnails.eq(index).find('img').attr('src');
                $('#pic-1 img').attr('src', newImageUrl);
            }
        });
    </script>
@endpush
