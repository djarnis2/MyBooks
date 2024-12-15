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
<header>
    <x-header title='List of Books'></x-header>
</header>
<body>
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
                <div class="body-group">
                    <a class="body-links" href="{{ url('/books/' . $book->id) }}">Title: {{ $book->title }}</a>
                    <!-- Display the associated file if it exists -->
                </div>

            @endforeach
        @endif

    </div>
</div>

<footer>
    <x-footer></x-footer>
</footer>

</body>
</html>
