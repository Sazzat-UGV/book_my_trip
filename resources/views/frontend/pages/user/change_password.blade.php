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

                <div class="col-lg-3 col-md-3 col-sm-3"></div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <form action="{{ route('changePassword') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label class="" for="old_password">Old Password <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                class="form-control @error('old_password')
                        is-invalid
                             @enderror"
                                id="old_password" placeholder="Enter your old password" name="old_password" required="">
                            @error('old_password')
                                <span style="font-size: 12px; color:red;"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="" for="new_password">New Password <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                class="form-control @error('new_password')
                        is-invalid
                    @enderror"
                                id="new_password" placeholder="Enter your new password" name="new_password" required="">
                            @error('new_password')
                                <span style="font-size: 12px; color:red;"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="" for="retype_password">Retype Password <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                class="form-control @error('retype_password')
                        is-invalid
                    @enderror"
                                id="retype_password" placeholder="Enter your retype password" name="retype_password"
                                required="">
                            @error('retype_password')
                                <span style="font-size: 12px; color:red;"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <input type="submit" class="btn btn-primary" value="Change Password">
                    </form>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3"></div>

            </div>
        </div>
    </section>
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
