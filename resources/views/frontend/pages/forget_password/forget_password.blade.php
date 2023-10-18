@extends('frontend.layout.master')
@section('title')
    Forget Password
@endsection
@push('user_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .section {
            padding: 50px 0;
            position: relative;
        }

        .gray-bg {
            background-color: #f5f5f5;
        }
    </style>
@endpush
@section('content')
    <section class="section about-section gray-bg" id="about">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">

                <div class="col-lg-3 col-md-3 col-sm-3"></div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <form action="{{ route('forgetPassword') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label class="" for="email">Enter your email<span class="text-danger">*</span>
                            </label>
                            <input type="email"
                                class="form-control @error('email')
                        is-invalid
                             @enderror"
                                id="email" placeholder="Enter your email" name="email" required="">
                            @error('email')
                                <span style="font-size: 12px; color:red;"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <input type="submit" class="btn btn-primary" value="Send Reset Link">
                    </form>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3"></div>

            </div>
        </div>
    </section>
@endsection
@push('user_script')
@endpush
