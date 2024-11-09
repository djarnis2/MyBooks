<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script defer src="{{ asset('scripts/script.js') }}"></script>
    <title>AddBook</title>
</head>

<body>
<header>
    <x-header title="New Book Registry"/>
</header>

<div class="form-container">
    <h2>Book Form</h2>
    <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="body-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div class="body-group">
            <label for="author">Author</label>
            <select id="author" name="author_id">
                @forelse($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                @empty
                    <option disabled>No Authors Found</option>
                @endforelse
                    <option value="new">Add new author</option>
            </select>
        </div>
        <div id="new-author-fields" class="body-group" style="display: none">
            <label for="new-author-name">New author name</label>
            <input type="text" name="new_author_name" id="new-author-name">

            <label for="new-author-dob">Date of birth</label>
            <input type="date" name="birth_date" id="new-author-dob">

            <label for="new-author-dob">Date of death</label>
            <input type="date" name="death_date" id="new-author-dod">


            <label for="new-author-description">Description of author</label>
            <textarea id="new-author-description" name="description" rows="15" placeholder="description..."></textarea>
        </div>
        <div class="body-group radio-group">
            <label><input type="radio" id="fiction" name="Type" value="Fiction"> Fiction</label>
            <label><input type="radio" id="non-fiction" name="Type" value="Non-fiction"> Non-Fiction</label>
        </div>
        <div class="body-group">
            <label for="language">Language</label>
            <select id="language" name="Language" size=1>
                <option value="English">English</option>
                <option value="French">French</option>
                <option value="German">German</option>
                <option value="Spanish">Spanish</option>
                <option value="Italian">Italian</option>
                <option value="Danish">Danish</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="body-group ">
            <fieldset>
                <legend>Select Genres</legend>
                <label><input type="checkbox" name="genre" value="short-stories"> Short Stories</label>
                <label><input type="checkbox" name="genre" value="novel"> Novels</label>
                <label><input type="checkbox" name="genre" value="poetry"> Poetry</label>
                <label><input type="checkbox" name="genre" value="science-fiction"> Science Fiction</label>
                <label><input type="checkbox" name="genre" value="historical"> Historical</label>
                <label><input type="checkbox" name="genre" value="fantasy"> Fantasy</label>
                <label><input type="checkbox" name="genre" value="fairytale"> Fairytale</label>

            </fieldset>
        </div>
        <div class="body-group">
            <label for="notes">Notes</label>
            <textarea id="notes" name="Notes" rows="15" placeholder="your own notes..."></textarea>
        </div>
        {{--        File button is created dynamically--}}
        {{--        Submit button--}}
        <div class="body-group file-class"></div>
        <div class="body-group">
            <input class="button" id="submit" type="submit" name="submit" value="Submit">
        </div>
    </form>
</div>
<footer>
    <x-footer/>
</footer>


</body>
</html>
