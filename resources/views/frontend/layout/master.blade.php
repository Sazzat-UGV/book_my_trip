<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @include('frontend.layout.inc.style')
</head>

<body>

    @include('frontend.layout.inc.top_nav')

    @include('frontend.layout.inc.header')

    @yield('content')

    @include('frontend.layout.inc.footer')

    @include('frontend.layout.inc.script')

</body>

</html>
