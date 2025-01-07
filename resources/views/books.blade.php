<x-layout>
    <div class="bg-custom">
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
    </div>
</x-layout>



