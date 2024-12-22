{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport"--}}
{{--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">--}}
{{--    <script defer src="{{ asset('scripts/script.js') }}"></script>--}}
{{--    <title>MyBooks</title>--}}
{{--</head>--}}

{{--<body>--}}
{{--<header>--}}
{{--    <x-header title="Welcome to MyBooks Library"/>--}}
{{--</header>--}}
<x-layout>
    @if(session('success'))
        <h2 class="centered">{{ session('success') }}</h2>
    @endif

    @auth
        <h2>You are logged in as {{ auth()->user()->name }}</h2>
    @else
        <h2 class="centered">Login or register to start creating your own library of books</h2>
    @endauth
</x-layout>

{{--    <footer>--}}
{{--        <x-footer/>--}}
{{--    </footer>--}}

{{--</body>--}}
{{--</html>--}}
