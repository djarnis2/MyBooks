<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Genre;
use App\Models\User;
use Database\Seeders\GenresTableSeeder;
use Database\Seeders\TypesTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_loads(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }


    public function test_books_page_loads(): void
    {
        // Making a user
        $user = User::factory()->create();

        // Simulating login
        $this->actingAs($user);

        // Visit the books page
        $response = $this->get('/books');

        $response->assertStatus(200);
    }
    public function test_can_find_author_and_genre(): void
    {
        // Opret en forfatter og en genre med factories
        $author = \App\Models\Author::factory()->create([
            'name' => 'Test Author',
        ]);

        $genre = \App\Models\Genre::factory()->create([
            'name' => 'Test Genre',
        ]);

        // Kontrollér, at forfatteren findes i databasen
        $this->assertDatabaseHas('authors', [
            'id' => $author->id,
            'name' => 'Test Author',
        ]);

        // Kontrollér, at genren findes i databasen
        $this->assertDatabaseHas('genres', [
            'id' => $genre->id,
            'name' => 'Test Genre',
        ]);
    }

    public function test_add_books_page_loads(): void
    {
        $this->seed(GenresTableSeeder::class); // Seed genres
        $this->seed(TypesTableSeeder::class); // Seed types
        // Opret en forfatter og en genre med factories
        $author = \App\Models\Author::factory()->create([
            'name' => 'Test Author',
        ]);

        $genre = \App\Models\Genre::factory()->create([
            'name' => 'Test Genre',
        ]);
        $this->withoutMiddleware(); // Deaktiver CSRF-middleware

        $user = User::factory()->create();
        $this->actingAs($user);

        $author = Author::factory()->create([
            'name' => 'John Doe',
        ]);
        $genre = Genre::factory()->create();


        $data = [
            'title' => 'Test Book Title',
            'author_id' => $author->id,
            'genre' => [$genre->id], // Array af genre-ID'er
        ];
        $file = \Illuminate\Http\UploadedFile::fake()->image('test_image.jpg');


        $response = $this->get('/books/create');
        $response->assertStatus(200);

        $response = $this->post('/books/store', array_merge($data, [
            'author_image' => $file,
            ]));

        $response->assertStatus(302); // redirect after success

        // Tjek om bogen blev gemt i databasen
        $this->assertDatabaseHas('books', [
            'title' => 'Test Book Title',
        ]);

    }
}
