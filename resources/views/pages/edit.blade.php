@extends('layouts.main-layout')

@section('content')
    
    <h1>EDIT FORM GOES HERE</h1>

    <form action="{{ route('home.movies.update', $movie)}}" method="POST">
        @csrf
        
        <label for="name">Movie title:</label>
        <input type="text" name="name" value="{{ $movie -> name }}">

        <br>

        <label for="year">Movie release year:</label>
        <input type="number" name="year" value="{{ $movie -> year}}">

        <br>

        <label for="boxOffice">Movie box office:</label>
        <input type="number" name="boxOffice" value="{{ $movie -> boxOffice }}">

        <br>

        <label for="genre_id">Pick a genre:</label>
        <select name="genre_id">
            @foreach ($genres as $genre)
                <option value="{{ $genre -> id }}"
                    @if ($movie -> genre -> id == $genre -> id)
                        selected  
                    @endif
                    >
                    {{ $genre -> name }}
                </option>
            @endforeach
        </select>

        <p>Pick a tag:</p>        

        @foreach ($tags as $tag)
            <input type="checkbox" name="tags[]" value="{{ $tag -> id}}"
            @foreach ($movie -> tags as $movieTag)
                @if ($movieTag -> id == $tag -> id)
                    checked
                @endif
            @endforeach
            >
            <label for="tags">{{ $tag -> name }}</label>
        @endforeach

        <br>

        <input type="submit" value="UPDATE">

    </form>
@endsection