{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport"--}}
{{--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--    <title>Document</title>--}}
{{--</head>--}}
{{--<body>--}}
{{--<header>--}}
{{--    <x-header title="New User"/>--}}
{{--</header>--}}
<x-layout>
    <h1 class="centered">Register new User</h1>
    @if($errors->all())
        <div class="error-message centered">
            @foreach($errors->all() as $error)
                {{ $error }}
            @endforeach

        </div>
    @endif
    <div class="centered form-container">
        <form action="{{ route('register.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input class="button-class" type="text" name="name" placeholder="name">
            <input class="button-class" type="text" name="email" placeholder="email">
            <input class="button-class" type="password" name="password" placeholder="password">
            <button class="button-class">Register</button>
        </form>
    </div>
</x-layout>

{{--</body>--}}
{{--</html>--}}
