<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

    <!-- title -->
    <title>Details</title>
    <!-- search icon --> <!-- search icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">

    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }} ">
    <!-- owl carousel -->
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }} ">

    <!-- main style -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }} ">

    <!-- responsive -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }} ">

    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</head>

<body>

    <header id="header">
        <div class="container">

            <div id="logo" class="pull-left">
                <h1><a href="{{ route('home') }}" class="scrollto">Movies Website</a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="#intro"><img src="img/logo.png" alt="" title="" /></img></a> -->
            </div>

            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('topRating') }}">Top Rating </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('suggested') }}">Suggested </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('favorite') }}"> favorite</a>
                    </li>
                    <li class="nav-item">

                        <div class="search-container">
                            <input type="text" class="search-box" placeholder="Search...">
                            <button type="submit" class="search-button"><i class="fas fa-search"></i></button>
                        </div>
                    </li>
                </ul>
            </nav><!-- #nav-menu-container -->
        </div>
    </header><!-- #header -->

    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        
                        <p>See more Details</p>
                        <h1>{{ $movie->title }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- single product -->
    <div class="single-product mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="single-product-img">
                        <img src="{{ asset('assets/images/3.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="single-product-content">
                        <h3>{{ $movie->title }}</h3>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta sint dignissimos, rem commodi
                            cum voluptatem quae reprehenderit repudiandae ea tempora incidunt ipsa, quisquam animi
                            perferendis eos eum modi! Tempora, earum.</p>
                        <div class="geners">
                            <p><strong>Geners: </strong>
                                @foreach ($movie->geners as $gener)
                                    {{ $gener->name }} ,
                                @endforeach
                            </p>
                        </div>
                        <div class="tags">
                            <p><strong>Tags: </strong>
                                @foreach ($movie->tags as $tag)
                                    {{ $tag->tag }} ,
                                @endforeach
                            </p>
                        </div>
                        <div>
                            <a href="https://www.imdb.com/title/tt{{ $link->imdbId }}" target="_blank"
                                class="btn btn-red-black mt-5 mr-4 p-4">More Info On Imdb </a>
                            <a href="https://www.themoviedb.org/movie/{{ $link->imdbId }}" target="_blank"
                                class="btn btn-red-black mt-5 p-4">More Info On Tmdb </a>
                        </div>

                    </div>
                </div>
                {{-- Add rate by user --}}
                <div class="rating-card col-12 mt-5">

                    <div class="container rating-operation">
                        <div class="row">
                            <div class="col mt-12">
                                <form class="py-2 px-4" action="{{ route('rating.store') }}"
                                    style="box-shadow: 0 0 10px 0 #D03634;" method="POST" autocomplete="off">
                                    @csrf
                                    <p class="font-weight-bold ">Review</p>
                                    <div class="form-group row">
                                        <input type="hidden" name="movieId" value="{{ $movie->movieId }}">
                                        <div class="col">
                                            <div class="rate">
                                                <label for="star5" title="text">5 stars</label>
                                                <input type="radio" id="star5" class="rate" name="rating"
                                                    value="5" />
                                                <label for="star4" title="text">4 stars</label>
                                                <input type="radio" id="star4" class="rate" name="rating"
                                                    value="4" />
                                                <label for="star3" title="text">3 stars</label>
                                                <input type="radio" id="star3" class="rate" name="rating"
                                                    value="3" />
                                                <label for="star2" title="text">2 stars</label>
                                                <input type="radio" id="star2" class="rate" name="rating"
                                                    value="2">
                                                <label for="star1" title="text">1 star</label>
                                                <input type="radio" id="star1" class="rate" name="rating"
                                                    value="1" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-4">
                                        <div class="col">
                                            <textarea class="form-control" name="tag" rows="3 " placeholder="Add your Tag" maxlength="200"></textarea>
                                        </div>
                                    </div>
                                    <div class="mt-3 text-right">
                                        <button type="submit" class="btn btn-red-black">Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end single product -->

    <!-- more products -->
    {{-- <div class="more-products mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Related</span> FILMS</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet
                            beatae optio.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 text-center">
                    <div class="single-product-item">
                        <div class="product-image">
                            <a href="single-product.html"><img src="images/7.jpg"></a>
                            <h3>movie</h3>
                            <p class="card-text">Rating: 8.4/10</p>
                            <a href="#" class="btn-primary">Details</a>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-6 text-center">
                    <div class="single-product-item">
                        <div class="product-image">
                            <a href="single-product.html"><img src="images/7.jpg" alt=""></a>
                        </div>
                        <h3>movie</h3>
                        <p class="card-text">Rating: 8.4/10</p>
                        <a href="#" class="btn-primary">Details</a>

                    </div>
                </div>
                <div class="col-lg-4 col-md-6 offset-lg-0 offset-md-3 text-center">
                    <div class="single-product-item">
                        <div class="product-image">
                            <a href="single-product.html"><img src="images/7.jpg" alt=""></a>
                        </div>
                        <h3>movie</h3>
                        <p class="card-text">Rating: 8.4/10</p>
                        <a href="#" class="btn-primary">Details</a>

                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- end more products -->


    <footer class="text-centerr py-3">
        <p>&copy; 2023 Movies Website. All rights reserved.</p>
    </footer>
</body>

</html>
