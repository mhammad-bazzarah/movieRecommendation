@extends('frontend.layouts.layout')
@section('content')
    <!-- Movies Sections -->
    <div class="allsection">
        <div class="container movies-section">
            <h2>Latest Movies</h2>
            <hr>
            <div class="row">
                @foreach ($movies as $movie)
                    <div class="col-sm-4">
                        <div class="card movie-card">
                            <img src="{{ asset('assets/images/1.jpg') }}" alt="Movie 1">
                            <div class="card-body">
                                <h5 class="card-title">{{ $movie->title }}</h5>
                                <p class="card-text">Rating: 8.5/10</p>
                                <a href="detailes.html" class="btn btn-primary">Details</a>
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="container movies-section">

        <div class="row movie-row">
        </div>
        <div class="navigation-arrows">
            <button class="prev-btn"><i class="fas fa-chevron-left"></i></button>
            <button class="next-btn"><i class="fas fa-chevron-right"></i></button>
        </div>
    </div>
    </div><br><br>
@endsection
