@extends('frontend.layout.master')
@section('title')
Contact
@endsection
@push('user_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')
    <section id="contact_us">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="con_top clearfix">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7497570.695915548!2d85.04486728701312!3d23.42714161097665!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30adaaed80e18ba7%3A0xf2d28e0c4e1fc6b!2sBangladesh!5e0!3m2!1sen!2sbd!4v1696864773881!5m2!1sen!2sbd"
                            style="width:100%; height:400px; border:0" allowfullscreen="">
                        </iframe>


                    </div>
                </div>
                <div class="col-sm-12 aniview" data-av-animation="slideInDown">
                    <div class="contact_us_top text-center">
                        <h2> Follow Us</h2>
                        <div class="col-md-12 contact_icon">
                            <ul class="social-network social-circle">
                                <li><a href="#" class="icoRss" title="Rss"><i
                                            class="fa-brands fa-instagram"></i></a></li>
                                <li><a href="#" class="icoFacebook" title="Facebook"><i
                                            class="fa-brands fa-facebook"></i></a></li>
                                <li><a href="#" class="icoTwitter" title="Twitter"><i
                                            class="fa-brands fa-twitter"></i></a></li>
                                <li><a href="#" class="icoGoogle" title="Google +"><i
                                            class="fa-brands fa-google-plus"></i></a></li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 aniview" data-av-animation="slideInLeft">

                    <div class="col-sm-4">
                        <div class="contact_us_1 text-center">
                            <p><a href="#"><i class="fa-solid fa-phone"></i></a></p>
                            <h4>Contact Us Here</h4>
                            <h5>Here you can reach us</h5>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="contact_us_1 text-center">
                            <p><a href="#"><i class="fa-solid fa-location-dot"></i></a></p>
                            <h4>Find Us On Map</h4>
                            <h5> we are here</h5>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="contact_us_1 text-center">
                            <p><a href="#"><i class="fa fa-envelope"></i></a></p>
                            <h4>Subscribe Here</h4>
                            <h5> you can subscribe us</h5>
                        </div>
                    </div>
                </div>
                <form action="{{ route('contact_post') }}" method="POST">
                    @csrf
                    <div class="col-sm-12 form_main aniview" data-av-animation="slideInRight">
                        <div class="col-sm-6"> <input class="custom_text form-control" name="name"
                                value="{{ old('name') }}" placeholder="Name" type=" text"></div>
                        <div class="col-sm-6"> <input class="custom_text form-control" name="email"
                                value="{{ old('email') }}" placeholder="Email" type=" text"></div>
                        <div class="col-sm-6"> <input class="custom_text form-control" name="phone"
                                value="{{ old('phone') }}" placeholder="Phone" type=" text"></div>
                        <div class="col-sm-6"> <input class=" custom_text form-control" name="city"
                                value="{{ old('city') }}" placeholder="City" type=" text"></div>
                        <div class="col-sm-12">
                            <textarea class="form-control text_1" name="message" placeholder="Message">{{ old('message') }}</textarea>
                        </div>
                        <div class="col-sm-12">
                            <input type="submit" class="btn btn-danger btn-lg text-white" style="background-color: red"
                                value="Send Message">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('user_script')
@endpush
