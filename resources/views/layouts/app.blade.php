@php use App\Helper; @endphp
        <!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('storage/' . Helper::setting('SETTING_SITE_FAVICON')) }}" type="image/x-icon">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free-6.5.2-web/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
@include('layouts.nav')

@yield('content')

@include('layouts.footer')

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>

@stack('scripts')
</body>
</html>