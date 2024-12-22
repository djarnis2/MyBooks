<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = ['short-stories', 'novel', 'poetry', 'science-fiction', 'historical', 'fantasy','fairytale'];

        foreach ($genres as $genre) {
            DB::table('genres')->insert([
                'name' => $genre
            ]);
        }
    }
}
