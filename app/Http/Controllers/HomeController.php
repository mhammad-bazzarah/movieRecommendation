<?php

namespace App\Http\Controllers;

use App\Models\Gener;
use App\Models\Link;
use App\Models\Movie;
use App\Models\Rating;
use App\Models\Tag;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $movies  = Movie::orderByDesc('year')->simplePaginate(6);
        $ratings = Rating::all();
        $geners = Gener::all();
        return  view('frontend.index', compact('movies', 'ratings', 'geners'));
    }

    public function showMovie($movie)
    {
        $movie = Movie::findOrFail($movie);
        $link = Link::findOrFail($movie->movieId);

        return view('frontend.detailes', compact('movie', 'link'));
    }

    public function topRating()
    {
        $movies = Movie::orderByDesc('rate')->orderByDesc('numOfRatings')->orderByDesc('year')->simplePaginate(6);
        return view('frontend.topRating', compact('movies'));
    }


    public function favorite()
    {
        $user_id = Auth()->user()->id;
        $ratedByUser = Rating::where('userId', '=', $user_id)->pluck('movieId');
        $movies = Movie::whereIn('movieId', $ratedByUser)->orderByDesc('rate')->get();
        return view('frontend.favorite', compact('movies'));
    }

    function search(Request $request)
    {
        $search = $request->validate([
            'search' => 'nullable'
        ]);

        $searchTerm = $search['search'];
        if (empty($searchTerm)) {
            Flash()->error('Please enter something to search.');
            return Redirect()->back();
        }
        $movies = Movie::where('title', 'like', "%$searchTerm%")->get();
        $sum = count($movies);
        return view('frontend.searchResult', compact('movies', 'searchTerm', 'sum'));
    }




    
}
