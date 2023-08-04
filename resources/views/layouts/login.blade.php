<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="author" content="Kodinger" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('frontend/images/logo-no-background.png') }}" />
    <title>SPK | @yield('title')</title>
    {{-- style --}}
    @include('includes.login.style')
</head>

<body class="my-login-page">
    {{-- Navbar --}}
    @include('includes.login.navbar')

    {{-- main --}}
    @yield('content')

    {{-- background --}}
    @include('includes.login.background')

    {{-- script --}}
    @include('includes.login.script')
</body>

</html>
