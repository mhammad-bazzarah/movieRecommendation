<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ApriorController extends Controller
{
    public static $numOfUsers = 10;
    const min_supp_count = 5;
    function index()
    {


        // $transactions = Cache::remember('transactions', 300, function () use($numOfUsers) {
        //     return $this->getTransactions($numOfUsers);
        // });
        $transactions = Cache::remember('transactions', 10, function () {
            return $this->getTransactions(10);
        });
        $freq = $this->level_1($transactions);
        $second = $this->level_2($transactions,$freq);
        return view('frontend.aprior', compact('transactions', 'freq','second'));
    }
    function getTransactions(int $numOfUsers)
    {
        $users = User::take($numOfUsers)->get();
        $transactions = [];
        foreach ($users as $user) {
            $userFavourites = [];
            $ratings  = $user->ratings;
            foreach ($ratings as $rate) {
                if ($rate->rating == 5) {
                    $movie_id = $rate->movieId;
                    $movie = Movie::findOrFail($movie_id);
                    $geners = $movie->geners()->pluck('name');
                    $numericGeners = $this->NumericMapping($geners);
                    $diff = collect($numericGeners)->diff($userFavourites);
                    $userFavourites = array_merge($userFavourites, $diff->toArray());
                }
            }
            sort($userFavourites);
            $transactions[] = $userFavourites;
        }



        return $transactions;
    }
    function NumericMapping($geners)
    {
        $numericGeners = [];
        foreach ($geners as $gener) {
            if ($gener == "Action") {
                $numericGeners[] = 0;
            } elseif ($gener == "Adventure") {
                $numericGeners[] = 1;
            } elseif ($gener == "Animation") {
                $numericGeners[] = 2;
            } elseif ($gener == "Children's") {
                $numericGeners[] = 3;
            } elseif ($gener == "Comedy") {
                $numericGeners[] = 4;
            } elseif ($gener == "Crime") {
                $numericGeners[] = 5;
            } elseif ($gener == "Documentary") {
                $numericGeners[] = 6;
            } elseif ($gener == "Drama") {
                $numericGeners[] = 7;
            } elseif ($gener == "Fantasy") {
                $numericGeners[] = 8;
            } elseif ($gener == "Film-Noir") {
                $numericGeners[] = 9;
            } elseif ($gener == "Horror") {
                $numericGeners[] = 10;
            } elseif ($gener == "Musical") {
                $numericGeners[] = 11;
            } elseif ($gener == "Mystery") {
                $numericGeners[] = 12;
            } elseif ($gener == "Romance") {
                $numericGeners[] = 13;
            } elseif ($gener == "Sci-Fi") {
                $numericGeners[] = 14;
            } elseif ($gener == "Thriller") {
                $numericGeners[] = 15;
            } elseif ($gener == "War") {
                $numericGeners[] = 16;
            } elseif ($gener == "Western") {
                $numericGeners[] = 17;
            }
        }
        return $numericGeners;
    }
    //
    function level_1($transactions, $min_supp_count = self::min_supp_count)
    {
        $trans = $transactions;
        $result = [];
        $frequency = array_fill(0, 18, 0);
        // join:
        foreach ($trans as $row) {
            foreach ($row as $element) {
                $frequency[$element]++;
            }
        }
        // prune :
        foreach ($frequency as $key => $f) {
            if ($f >= $min_supp_count)
                $result[] = $key;
        }
        return $result;
    }

    function level_2($transactions,$frequentItems, $min_supp_count = self::min_supp_count)
    {
        $result =[];
        $trans = $transactions;
        $items = $frequentItems;
        // join:
        $joins = [];
        for($i=0;$i<count($items);$i++){
            for($j=$i+1;$j<count($items);$j++){
                $first = $items[$i];
                $second = $items[$j];
                $joins[] = array($first,$second);
            }
        }
        //prune:
        foreach($trans as $row){

        }
        return $joins;
    }
    function process(Request $request)
    {
        dd($request);
    }
}
