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
<div class="form-container ">

    <ul>

        @if(isset($error))
            <p> {{$error}}</p>

        @else
            @if(isset($book))
                <h3>Title: {{ $book->title }}</h3>

                @if(isset($book->author->name))

                    <div>

                        <p>Author: {{ $book->author->name }}</p>
                        @endif
                        @if(isset($book->author->birth_date))

                            <p>Date of birth: {{ $book->author->birth_date }}</p>
                        @endif
                        @if(isset($book->author->death_date))

                            <p>Date of death: {{ $book->author->death_date }}</p>
                        @endif
                        @if(isset($book->author->description))

                            <p>{{ $book->author->description }}</p>
                    </div>

                @endif

                <p>Type: {{ $book->type ?? 'Unknown' }}</p>

                <p>Written in {{ $book->language ?? 'Unknown' }}</p>

                @if(isset($book->genres) && ($book->genres->count() > 0))
                    <p>Style:</p>
                    <ul>
                        @foreach($book->genres as $genre)
                            <li>
                                {{ $genre->name }}
                            </li>

                        @endforeach
                    </ul>
                @endif
                @if(isset($book->files) && $book->files->count() > 0)

                    <ul>
                        @foreach($book->files as $file)
                            <li style="list-style-type: none;">
                                @php
                                    $extension = strtolower(pathinfo($file->file_name, PATHINFO_EXTENSION));
                                @endphp
                                @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                    <a href="{{ asset('storage/' . $file->file_path)  }}" target="_blank">
                                        <img src="{{ asset('storage/' . $file->file_path) }}"
                                             alt="{{ $file->file_name }}"
                                             style="max-width:100px; height:auto;">
                                    </a>
                                @else
                                    <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                                        {{ $file->file_name }}
                                    </a>
                                @endif
                            </li>
                        @endforeach
                    </ul>

                @else
                    <p>No files available for this book.</p>
                @endif


                <p>{{$book->notes ?? 'No notes for this book.'}}</p>
            @endif

        @endif

    </ul>

</div>

<footer>
    <x-footer></x-footer>
</footer>

</body>
</html>
