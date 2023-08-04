<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('frontend/images/logo-no-background.png') }}" />
    <title>SPK | @yield('title')</title>
    {{-- style css --}}
    @include('includes.portal.style')
</head>

<body>
    {{-- navbar --}}
    @include('includes.portal.navbar')

    <!-- Main -->
    @yield('content')
    <!-- End Main -->

    {{-- Footer --}}
    @include('includes.portal.footer')

    {{-- Script --}}
    @include('includes.portal.script')
</body>

</html>
