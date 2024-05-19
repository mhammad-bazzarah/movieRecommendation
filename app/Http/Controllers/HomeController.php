<?php

namespace App\Http\Controllers;

use App\Models\Gener;
use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(){
        $movies  = Movie::limit(30);
        $ratings = Rating::all();
        $geners = Gener::all();

        return  view('frontend.index',compact('movies','ratings','geners'));
    }

    public function topRating(){
        return view('frontend.topRating');
    }

    public function suggested(){
        return view('frontend.suggested');
    }

    public function favorite(){
        return view('frontend.favorite');
    }

}
