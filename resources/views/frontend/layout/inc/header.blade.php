<section id="header">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <nav class="navbar navbar-default" role="navigation">

                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#navbar-brand-centered">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="{{ route('homepage') }}">Book<span>My Trip</span></a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="navbar-brand-centered">
                        <ul class="nav navbar-nav">
                            <li><a class="text_2" href="{{ route('homepage') }}">Home</a></li>
                            <li><a class="text_2" href="{{ route('package') }}">Package</a></li>
                            <li><a class="text_2" href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="right_tag"><a href="#"><i class="fa fa-envelope"></i>info@gmail.com</a>
                            </li>
                        </ul>
                    </div><!-- /.navbar-collapse -->

                </nav>
            </div>
        </div>
    </div>
</section>
