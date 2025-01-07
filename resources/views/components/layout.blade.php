<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>MyBooks</title>
</head>

<body>
<header>

    <nav>
        <div class="menu">
            <div id="header-links">
                <a href="{{ route('index') }}">Home</a>
                <a href="{{ route('books.create') }}">New Book</a>
                <a href="{{ route('books.index') }}">My Library</a>

            </div>
            <div id="left-nav">
                @auth
                    <button>{{ auth()->user()->name }}</button>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button>Logout</button>
                    </form>
                    <form action="{{ route('books.search') }}" method="GET">
                        <input class="searchbar" type="text" name="query" id="search" placeholder="search in books">
                        <button type="submit">Search</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" id="login">
                        <button>Login</button>
                    </a>
                    <a href="{{ route('register.create') }} " id="login">
                        <button>Register</button>
                    </a>
                    <form action="{{ route('books.search') }}" method="GET">
                        <input type="text" class="searchbar" name="query" id="search" placeholder="search in books" disabled>
                        <button type="submit" disabled>Search</button>
                    </form>
                @endauth

            </div>
        </div>
    </nav>
</header>
<div id="main">

    {{$slot}}
</div>
<footer>
    <nav>
        <div class="menu">
            <div id="footer-links">
                <a href="#">Go to the top</a>
            </div>
        </div>
    </nav>
</footer>
</body>
</html>
