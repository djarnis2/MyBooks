<x-layout>
    <div class="results-container">
        <h2>Search Results</h2>
        @if($books->isEmpty())
            <p>No documents found matching your query.</p>
        @else
            <p>These are the results from your query:</p>
            @foreach($books as $book)
                <div class="body-group book-group">
                    <a class="body-links" data-id="{{ $book->id }}"
                       href="{{ url('/books/' . $book->id) }}">Title: {{ $book->title }}</a>
                    <span id="buttons_span" class="buttons"></span>
                </div>
            @endforeach
        @endif
    </div>
</x-layout>
