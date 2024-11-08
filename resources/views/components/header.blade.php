<h1>{{ $title }}</h1>
<nav>
    <div class="menu">
        <div id="header-links">
            <a href="{{ route('index') }}">Home</a>
            <a href="{{ route('books.create') }}">New Book</a>
            <a href="{{ route('books.index') }}">My Library</a>

        </div>
        <div>
            <input type="text" id="search" placeholder="search">
        </div>
    </div>
</nav>

