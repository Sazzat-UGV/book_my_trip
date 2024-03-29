@extends('frontend.layout.master')
@section('title')
    My Profile
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

@endpush
