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

                <p>
                    Genre: {{ strtoupper($movie -> genre -> name) }}
                </p>

                <p>
                    Tags: 
                    @foreach ($movie -> tags as $tag)
                        #{{ $tag -> name }}
                    @endforeach
                    {{-- @dump($movie -> tags) --}}
                </p>
            </li>    
    
        @endforeach
    </ul>

@endsection