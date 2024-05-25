@extends('frontend.layouts.layout')
@section('content')
    <!-- Movies Sections -->

    <div class="container movies-section ">
        <h2>Latest Movies</h2>
        <hr>
        <div class="row">
            @foreach ($movies as $movie)
                <div class="col-md-4">
                    <div class="card rating-card">
                        <img src="{{ asset('assets/images/1.jpg') }}" alt="Movie 1">
                        <div class="card-body">
                            <h5 class="card-title">{{ $movie->title }}</h5>
                            {{-- Current Rating --}}
                            <div class="container current-rate">
                                <div class="row">
                                    <div class="col mt-4">
                                        <div class="form-group row">
                                            <div class="col">
                                                <div class="rated">
                                                    @for ($i = 1; $i <= $movie->rate; $i++)
                                                        <label class="star-rating-complete"
                                                            title="text">{{ $i }} stars</label>
                                                    @endfor
                                                </div>
                                                <div class="num">{{ $movie->numOfRatings }} Ratings </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('show', $movie) }}" class="btn btn-red-black">Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $movies->links() }}
    </div>
@endsection

