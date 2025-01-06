<x-layout>
    <div class="form-container">
        <h2>{{isset($book)? 'Edit book' : 'Book Form'}}</h2>
        <form
            action="{{ isset($book) ? route('books.update', $book->id) : route('books.store')}}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            @if (isset($book))
                @method('PUT')
            @endif
            <div class="body-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="{{old('title', $book->title ?? '')}}" required>
            </div>

            @if (!isset($book))
{{--            --only for new books----}}
            <div class="body-group">
                <label for="author">Author</label>
                <select id="author" name="author_id">
                    @forelse($authors as $author)
                        <option value="{{ $author->id }}" {{old('author_id') == $author->id ? 'selected' : ''}}>
                            {{ $author->name }}
                        </option>
                    @empty
                        <option disabled>No Authors Found</option>
                    @endforelse
                    <option value="new">Add new author</option>
                </select>
            </div>

            <div id="new-author-fields" class="body-group" style="display: none">
                <label for="new-author-name">New author name</label>
                <input type="text" name="new_author_name" id="new-author-name" value="{{old('new_author_name')}}">

                <label for="new-author-dob">Date of birth</label>
                <input type="date" name="birth_date" id="new-author-dob" value="{{old('birth_date')}}">

                <label for="new-author-dob">Date of death</label>
                <input type="date" name="death_date" id="new-author-dod" value="{{old('death_date')}}">


                <label for="new-author-description">Description of author</label>
                <textarea id="new-author-description" name="description" rows="15"
                          placeholder="description...">{{old('description')}}</textarea>
            </div>

            @else
{{--                for edit show current author--}}
                <div class="body-group">
                    <label for="author">Author</label>
                    <input type="text" id="author" name="author_name" value="{{ $book->author->name }}" disabled>
                </div>
            @endif

{{--            other fields--}}

                <div class="body-group radio-group">
                    <label>
                        <input type="radio" id="fiction" name="type" value="Fiction"
                            {{ old('type', $book->type ?? '') == 'Fiction' ? 'checked' : '' }}>
                        Fiction
                    </label>
                    <label>
                        <input type="radio" id="non-fiction" name="type" value="Non-fiction"
                            {{ old('type', $book->type ?? '') == 'Non-Fiction' ? 'checked' : '' }}>
                        Non-Fiction
                    </label>
                    <label>
                        <input type="radio" id="educational" name="type" value="Educational"
                            {{ old('type', $book->type ?? '') == 'Educational' ? 'checked' : '' }}>
                        Educational
                    </label>
                    <label>
                        <input type="radio" id="biography" name="type" value="Biography"
                            {{ old('type', $book->type ?? '') == 'Biography' ? 'checked' : '' }}>
                        Biography
                    </label>

                </div>
                <div class="body-group">
                    <label for="language">Language</label>
                    <select id="language" name="language" size="1">
                        @foreach (['English', 'French', 'German', 'Spanish', 'Italian', 'Danish', 'Other'] as $language)
                            <option value="{{ $language }}" {{ old('language', $book->language ?? '') == $language ? 'selected' : ''}}>
                                {{ $language }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="body-group ">
                    <fieldset>
                        <legend>Select Genres</legend>
                        @foreach ($genres as $genre)
                            <label>
                                <input type="checkbox" name="genre[]" value="{{ $genre->id }}"
                                          {{ in_array($genre->id, old('genre', isset($book) ? $book->genres->pluck('id')->toArray() : [])) ? 'checked' : ''}}
                                          data-genre-name="{{ $genre->name }}">
                                {{ $genre->name }}
                            </label>
                        @endforeach
                    </fieldset>
                </div>

                <div class="body-group">
                    <label for="notes">Notes</label>
                    <textarea id="notes" name="notes" rows="15" placeholder="your own notes...">{{old('notes', $book->notes ?? '')}}</textarea>
                </div>
                {{--        File button is created dynamically--}}
                <div class="body-group file-class">
                    <p>files</p>
                </div>
                <div class="body-group">
                    <button type="submit" class="button" id="submit"  name="submit">{{ isset($book) ? 'Update Book' : 'Submit Book'}}</button>
                </div>
        </form>
    </div>
    <script defer src="{{ asset('scripts/create.js') }}"></script>
</x-layout>
