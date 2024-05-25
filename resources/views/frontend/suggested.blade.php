@extends('frontend.layouts.layout')
@section('content')
    <div class="container movies-section">
        <h2>Suggested Movies</h2>
        <hr>
        <div class="row">
            <div class="col-sm-4">
                <div class="card movie-card">
                    <img src="{{ asset('assets/images/movie1.jpg') }}" alt="Movie 12">
                    <div class="card-body">
                        <h5 class="card-title">Movie 12</h5>
                        <p class="card-text">Rating: 8.6/10</p>
                        <a href="#" class="btn btn-primary">Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
