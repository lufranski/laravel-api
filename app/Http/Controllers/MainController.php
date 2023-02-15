<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Tag;

class MainController extends Controller
{
    
    public function home(){

        $genres = Genre::all();

        return view('pages.home', compact('genres'));
    }

    public function movies(){

        $movies = Movie::all();

        return view('pages.movies', compact('movies'));
    }

    public function create(){

        $genres = Genre::all();
        $tags = Tag::all();

        return view('pages.create', compact('genres', 'tags'));
    }

    public function store(Request $request){

        $data = $request -> validate([

            'name' => 'required | string | max:64 ',
            'year' => 'required | integer ',
            'boxOffice' => 'required | integer',
            'genre_id' => 'required | integer',
            'tags' => 'required | array' 
        ]);

        $id = rand(10000,99999);
        $data['id'] = $id;

        $movie = Movie::make($data);
        $genre = Genre::find($data['genre_id']);

        $movie -> genre() -> associate($genre);
        $movie -> save();

        $tags = Tag::find($data['tags']);
        $movie -> tags() -> attach($tags);
        
        return redirect() -> route('home');
    }

    public function edit(Movie $movie){

        $genres = Genre::all();
        $tags = Tag::all();

        return view('pages.edit', compact('movie', 'genres', 'tags'));
    }

    public function update(Request $request, Movie $movie){

        $data = $request -> validate([

            'name' => 'required | string | max:64 ',
            'year' => 'required | integer ',
            'boxOffice' => 'required | integer',
            'genre_id' => 'required | integer',
            'tags' => 'required | array' 
        ]);

        $movie -> update($data);
        $genre = Genre::find($data['genre_id']);

        $movie -> genre() -> associate($genre);
        $movie -> save();

        $tags = Tag::find($data['tags']);
        $movie -> tags() -> sync($tags);

        return redirect() -> route('home');
    }

    public function destroy(Movie $movie){

        $movie -> tags() -> sync([]);
        $movie -> delete();

        return redirect() -> route('home');
    }
}
