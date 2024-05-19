@extends('frontend.layouts.layout')
@section('content')
    <div class="container movies-section">
        <h2>Top Rating Movies</h2>
        <hr>
        <div class="row">
            <div class="col-sm-4">
                <div class="card movie-card">
                    <img src="images/5.jpg" alt="Movie 5">
                    <div class="card-body">
                        <h5 class="card-title">Movie 5</h5>
                        <p class="card-text">Rating: 9.5/10</p>
                        <a href="detailes.html" class="btn btn-primary">Details</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card movie-card">
                    <img src="images/6.jpg" alt="Movie 6">
                    <div class="card-body">
                        <h5 class="card-title">Movie 6</h5>
                        <p class="card-text">Rating: 9.0/10</p>
                        <a href="detailes.html" class="btn btn-primary">Details</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card movie-card">
                    <img src="images/7.jpg" alt="Movie 7">
                    <div class="card-body">
                        <h5 class="card-title">Movie 7</h5>
                        <p class="card-text">Rating: 8.7/10</p>
                        <a href="detailes.html" class="btn btn-primary">Details</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card movie-card">
                    <img src="images/8.jpg" alt="Movie 8">
                    <div class="card-body">
                        <h5 class="card-title">Movie 8</h5>
                        <p class="card-text">Rating: 8.9/10</p>
                        <a href="detailes.html" class="btn btn-primary">Details</a>
                    </div>
                </div>
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