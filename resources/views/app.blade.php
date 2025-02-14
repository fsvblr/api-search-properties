<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/properties.css', 'resources/js/properties.js'])
</head>
<body>
    @yield('content')
    @stack('scripts')
</body>
</html>
