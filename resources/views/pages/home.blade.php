@extends('layouts.main-layout')

@section('content')
    
    <h1>HOME CONTENT GOES HERE</h1>

    <h1>Genres</h1>

    <a href="{{ route('home.movies')}}">Browse for movie</a>

    @foreach ($genres as $genre)
        
        <h2> {{ $genre -> name }}</h2>

        <ul>
            @foreach ($genre -> movies as $movie)
                
                <li>
                    {{$movie -> id}} - {{ $movie -> name}}, {{ $movie -> year}}, {{ $movie -> boxOffice}}
                </li>

            @endforeach
        </ul>
    @endforeach

@endsection