@extends('layouts.main-layout')

@section('content')
    
    <h1>Movies</h1>


    <ul>

        @foreach ($movies as $movie)
            
            <li>
                <p>

                    Title: {{ $movie -> name }}
                </p>

                <p>

                    Released in: {{ $movie -> year }}
                </p>

                <p>

                    Box office: {{ $movie -> boxOffice }} Mlns
                </p>

                {{-- <p>
                    Genre: {{ $movie -> $genres -> $genre -> name }}
                </p> --}}
            </li>    
    
        @endforeach
    </ul>

@endsection