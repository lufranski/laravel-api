<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Tag;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Movie::factory() -> count(100) -> make() -> each(function($i) {

            // Foreign Key
            $genre = Genre::inRandomOrder() -> first();
            $i -> genre() -> associate($genre);

            $i -> save();

            // Many to Many
            $tags = Tag::inRandomOrder() -> limit(rand(1,5)) -> get();
            $i -> tags() -> attach($tags);
        });
    }
}
