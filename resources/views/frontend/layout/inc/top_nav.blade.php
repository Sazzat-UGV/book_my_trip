<section id="top">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="top">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="border_1"><a class="text_1" href="{{ route('contact') }}"><i class="fa fa-phone"></i>
                                Contact Us </a>
                        </li>
                        @guest

                            <li class="dropdown">
                                <a class="text_1 dropdown-toggle" href="#" data-toggle="dropdown">Sign In <span
                                        class="caret"></span></a>
                                <ul id="login-dp" class="dropdown-menu">
                                    <li>
                                        <div class="row">
                                            <div class="col-md-12">
                                                Login via
                                                <div class="social-buttons">
                                                    <a href="{{ route('loginprovider', ['provider' => 'google']) }}"
                                                        class="btn btn-tw"><i class="fa-brands fa-google"></i>
                                                        Google</a>
                                                    <a href="{{ route('loginprovider', ['provider' => 'facebook']) }}"
                                                        class="btn btn-fb"><i class="fa-brands fa-facebook"></i>
                                                        Facebook</a>
                                                </div>
                                                or
                                                <form class="form" role="form" method="post"
                                                    action="{{ route('login') }}" accept-charset="UTF-8" id="login-nav">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label class="sr-only" for="exampleInputEmail2">Email
                                                            address</label>
                                                        <input type="email" class="form-control" id="exampleInputEmail2"
                                                            placeholder="Email address" name="email" required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="sr-only" for="exampleInputPassword2">Password</label>
                                                        <input type="password" name="password" class="form-control"
                                                            id="exampleInputPassword2" placeholder="Password"
                                                            required="">
                                                            <div class="help-block text-right"><a href="{{ route('forgetPasswordPage') }}">Forget
                                                                the password ?</a></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary btn-block">Sign
                                                            in</button>
                                                    </div>

                                                </form>
                                            </div>

                                        </div>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a class="text_1 dropdown-toggle" href="#" data-toggle="dropdown">Sign up <span
                                        class="caret"></span></a>
                                <ul id="login-dp" class="dropdown-menu">
                                    <li>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form class="form" role="form" method="POST"
                                                    action="{{ route('registration') }}" accept-charset="UTF-8"
                                                    id="login-nav">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label class="sr-only" for="name">Name
                                                        </label>
                                                        <input type="text"
                                                            class="form-control @error('name')
                                                    is-invalid
                                                @enderror"
                                                            id="name" name="name" value="{{ old('name') }}"
                                                            placeholder="Name" required="">
                                                        @error('name')
                                                            <span
                                                                style="font-size: 12px; color:red;"><strong>{{ $message }}</strong></span>
                                                        @enderror

                                                    </div>

                                                    <div class="form-group">
                                                        <label class="sr-only" for="email">Email
                                                        </label>
                                                        <input type="email"
                                                            class="form-control @error('email')
                                                    is-invalid
                                                @enderror"
                                                            id="email" name="email" value="{{ old('email') }}"
                                                            placeholder="Email " required="">
                                                        @error('email')
                                                            <span
                                                                style="font-size: 12px; color:red;"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="sr-only" for="phone">Phone
                                                            address</label>
                                                        <input type="text"
                                                            class="form-control @error('phone')
                                                    is-invalid
                                                @enderror"
                                                            id="phone" name="phone" value="{{ old('phone') }}"
                                                            placeholder="Phone" required="">
                                                        @error('phone')
                                                            <span
                                                                style="font-size: 12px; color:red;"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="sr-only" for="address">
                                                            Address</label>
                                                        <input type="text"
                                                            class="form-control @error('address')
                                                        is-invalid
                                                    @enderror"
                                                            id="address" name="address" value="{{ old('address') }}"
                                                            placeholder="Address" required="">
                                                        @error('address')
                                                            <span
                                                                style="font-size: 12px; color:red;"><strong>{{ $message }}</strong></span>
                                                        @enderror

                                                    </div>
                                                    <div class="form-group">
                                                        <label class="sr-only" for="password">Password</label>
                                                        <input type="password"
                                                            class="form-control @error('password')
                                                    is-invalid
                                                @enderror"
                                                            id="password" placeholder="Password" name="password"
                                                            required="">
                                                        @error('password')
                                                            <span
                                                                style="font-size: 12px; color:red;"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="sr-only" for="confir._password">Password</label>
                                                        <input type="password"
                                                            class="form-control @error('password_confirmation')
                                                    is-invalid
                                                @enderror"
                                                            id="confir._password" placeholder="Retype Password"
                                                            name="password_confirmation" required="">
                                                        @error('password_confirmation')
                                                            <span
                                                                style="font-size: 12px; color:red;"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary btn-block">Sign
                                                            up</button>
                                                    </div>
                                                </form>
                                                or
                                                <div class="social-buttons">
                                                    <a href="{{ route('loginprovider', ['provider' => 'google']) }}"
                                                        class="btn btn-tw"><i class="fa-brands fa-google"></i>
                                                        Google</a>
                                                    <a href="{{ route('loginprovider', ['provider' => 'facebook']) }}"
                                                        class="btn btn-fb"><i class="fa-brands fa-facebook"></i>
                                                        Facebook</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>


                        @endguest
                        @auth
                            <li class="dropdown">
                                <a class="text_1 dropdown-toggle" href="#"
                                    data-toggle="dropdown">{{ Auth::user()->name }}
                                    <span class="caret"></span></a>
                                <ul id="profile-dropdown" class="dropdown-menu">
                                    <li><a href="{{ route('profilepage') }}">My Profile</a></li>
                                    <li><a href="{{ route('mybooking') }}">My Booking</a></li>
                                    <li><a href="{{ route('changePassword') }}">Change Password</a></li>
                                    <li><a href="{{ route('logout') }}">Logout</a></li>
                                </ul>
                            </li>
                        @endauth
                    </ul>


                </div>

            </div>
        </div>
    </div>
</section>
