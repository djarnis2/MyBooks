here are alt i x-header
    <x-slot:header>
        <h1>{{ $title }}</h1>
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
                        <input type="text" id="search" placeholder="search">

                    @else
                        <a href="{{ route('login') }}" id="login"><button>Login</button></a>
                        <a href="{{ route('register.create') }} " id="login"><button>Register</button></a>
                        <input type="text" id="search" placeholder="search">
                    @endauth

                </div>
            </div>
        </nav>
    </x-slot:>


