@extends('layouts.main-layout')

@section('content')
    
    <h1>CREATION FORM GOES HERE</h1>

    <form action="{{ route('home.movies.store')}}" method="POST">
        @csrf
        
        <label for="name">Movie title:</label>
        <input type="text" name="name">

        <br>

        <label for="year">Movie release year:</label>
        <input type="number" name="year">

        <br>

        <label for="boxOffice">Movie box office:</label>
        <input type="number" name="boxOffice">

        <br>

        <label for="genre_id">Pick a genre:</label>
        <select name="genre_id">
            @foreach ($genres as $genre)
                <option value="{{ $genre -> id }}">
                    {{ $genre -> name }}
                </option>
            @endforeach
        </select>

        <p>Pick a tag:</p>        

        @foreach ($tags as $tag)
            <input type="checkbox" name="tags[]" value="{{ $tag -> id}}">
            <label for="tags">{{ $tag -> name }}</label>
        @endforeach

        <br>

        <input type="submit" value="SUBMIT">

    </form>

@endsection