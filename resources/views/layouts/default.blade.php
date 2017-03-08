<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    @include('includes.head')
</head>
<body>
    <div id="app">
        @include('includes.header')

        @yield('content')
    </div>

    @include('includes.footer')
</body>
</html>