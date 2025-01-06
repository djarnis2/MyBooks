{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport"--}}
{{--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">--}}
{{--    <script defer src="{{ asset('scripts/create.js') }}"></script>--}}
{{--    <title>Books</title>--}}
{{--</head>--}}
{{--<header>--}}
{{--    <x-header title='List of Books'></x-header>--}}
{{--</header>--}}
{{--<body>--}}

<x-layout>
    <div class="form-container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h2>My Library:</h2>

        <div class="form-container">
            @if(!$books)
                <p>No books yet</p>
            @else
                @foreach($books as $book)
                    <div class="body-group book-group">
                        <a class="body-links" data-id="{{ $book->id }}" href="{{ url('/books/' . $book->id) }}">Title: {{ $book->title }}</a>
                        <span id="buttons_span" class="buttons"></span>
                    </div>

                @endforeach
            @endif

        </div>
    </div>
    <script defer src="{{ asset('scripts/books.js') }}"></script>
</x-layout>

{{--<footer>--}}
{{--    <x-footer></x-footer>--}}
{{--</footer>--}}

{{--</body>--}}
{{--</html>--}}
