@extends('frontend.layout.master')
@section('title')
    My Profile
@endsection
@push('user_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"
        integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .section {
            padding: 50px 0;
            position: relative;
        }

        .gray-bg {
            background-color: #f5f5f5;
        }

        img {
            max-width: 80%;
        }

        img {
            vertical-align: middle;
            border-style: none;
        }

        /* About Me
                    ---------------------*/
        .about-text h3 {
            font-size: 45px;
            font-weight: 700;
            margin: 0 0 6px;
        }

        @media (max-width: 767px) {
            .about-text h3 {
                font-size: 35px;
            }
        }

        .about-text h6 {
            font-weight: 600;
            margin-bottom: 15px;
        }

        @media (max-width: 767px) {
            .about-text h6 {
                font-size: 18px;
            }
        }

        .about-text p {
            font-size: 18px;
            max-width: 450px;
        }

        .about-text p mark {
            font-weight: 600;
            color: #20247b;
        }

        .about-list {
            padding-top: 10px;
        }

        .about-list .media {
            padding: 5px 0;
        }

        .about-list label {
            color: #20247b;
            font-weight: 600;
            width: 88px;
            margin: 0;
            position: relative;
        }

        .about-list label:after {
            content: "";
            position: absolute;
            top: 0;
            bottom: 0;
            right: 11px;
            width: 1px;
            height: 12px;
            background: #20247b;
            -moz-transform: rotate(15deg);
            -o-transform: rotate(15deg);
            -ms-transform: rotate(15deg);
            -webkit-transform: rotate(15deg);
            transform: rotate(15deg);
            margin: auto;
            opacity: 0.5;
        }

        .about-list p {
            margin: 0;
            font-size: 15px;
        }

        @media (max-width: 991px) {
            .about-avatar {
                margin-top: 30px;
            }
        }



        .dark-color {
            color: #20247b;
        }
    </style>
@endpush
@section('content')
    <section class="section about-section gray-bg" id="about">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">

                <div class="col-lg-6 text-center">
                    <div class="about-avatar">
                        <img src="{{ asset('uploads/user') }}/{{ Auth::user()->image }}" alt="Profile Image"
                            class="img-fluid">
                    </div>
                    <div class="row">
                        <div class="col-12 align-items-center"
                            style="display: flex; justify-content: center; margin-top: 20px;">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Change
                                Image</button>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6">
                    <div class="about-text go-to">
                        <h3 class="dark-color">About Me</h3>
                        <div class="row about-list">
                            <div class="col-md-12">
                                <div class="media">
                                    <p style="font-size: 20px" class="dark-color">Name: <span
                                            style="font-size: 18px; color:black">{{ Auth::user()->name }}</span></p>
                                </div>
                                <div class="media">
                                    <p style="font-size: 20px" class="dark-color">Email: <span
                                            style="font-size: 18px; color:black">{{ Auth::user()->email }}</span></p>
                                </div>
                                <div class="media">
                                    <p style="font-size: 20px" class="dark-color">Phone: <span
                                            style="font-size: 18px; color:black">{{ Auth::user()->phone }}</span></p>
                                </div>
                                <div class="media">
                                    <p style="font-size: 20px" class="dark-color">Address: <span
                                            style="font-size: 18px; color:black">{{ Auth::user()->address }}</span></p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 align-items-center"
                            style="display: flex; justify-content: center; margin-top: 20px;">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#profile">Edit Profile</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- Modal for image -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Change Image</h3>
                </div>
                <div class="modal-body">
                    <form action="{{ route('changeImage') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="file" name="image"
                            data-default-file="{{ asset('uploads/user') }}/{{ Auth::user()->image }}"
                            class="form-control dropify @error('image')
                        is-invalid
                        @enderror">
                        @error('image')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal for user -->
    <div class="modal fade" id="profile" tabindex="-1" aria-labelledby="profileLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="profileLabel">Edit Profile</h3>
                </div>
                <div class="modal-body">
                    <form action="{{ route('editProfile') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label class="" for="name">Name <span class="text-danger">*</span> </label>
                            <input type="text"
                                class="form-control @error('name')
                        is-invalid
                    @enderror"
                                id="name" placeholder="Enter your name" name="name"
                                value="{{ Auth::user()->name }}" required="">
                            @error('name')
                                <span style="font-size: 12px; color:red;"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="" for="phone">Phone <span class="text-danger">*</span> </label>
                            <input type="text"
                                class="form-control @error('phone')
                        is-invalid
                    @enderror"
                                id="phone" placeholder="Enter your phone" name="phone"
                                value="{{ Auth::user()->phone }}" required="">
                            @error('phone')
                                <span style="font-size: 12px; color:red;"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="" for="address">Address <span class="text-danger">*</span> </label>
                            <input type="text"
                                class="form-control @error('address')
                        is-invalid
                    @enderror"
                                id="address" placeholder="Enter your address" name="address"
                                value="{{ Auth::user()->address }}" required="">
                            @error('address')
                                <span style="font-size: 12px; color:red;"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('user_script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop your image here or click',
            }
        });
    </script>
@endpush
