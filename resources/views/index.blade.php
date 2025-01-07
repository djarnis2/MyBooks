<x-layout>
    <div class="bg-custom">
        @if(session('success'))
            <h1 class="centered white top-text">{{ session('success') }}</h1>
        @endif

        @auth
            <h1 class="centered white middle-text">You are logged in as {{ auth()->user()->name }}</h1>
        @else
            <h1 class="centered white top-text">Login or register to start creating your own library of books</h1>
        @endauth
    </div>

</x-layout>
