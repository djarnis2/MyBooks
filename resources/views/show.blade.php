<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <script defer src="{{ asset('scripts/script.js') }}"></script>
        <title>Books</title>
    </head>

    <body>
         <header>
        <x-header title='List of Books'></x-header>
        </header>
        <div class="form-container">
        <h1>Long list of books</h1>


        @if(isset($error))
            <p> {{$error}}</p>

        @else
        <p>Title: {{ $book->title }}</p>
        @endif
    </div>

    <footer>
        <x-footer></x-footer>
    </footer>

    </body>
</html>
