<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;

class ApriorController extends Controller
{
    function index()
    {

        $transactions = [];
        $users = User::all();
        foreach ($users as $user) {
            $ratings = $user->ratings;
            $transaction = [];
            foreach ($ratings as $rating) {
                $transaction[] = $rating->movieId;
            }
            $transactions[] = $transaction;
        }

        // $ratings[] = Auth()->user()->ratings;
        // $values = [];
        // foreach ($ratings as $rating) {
        //     $values[] = $rating->movieId;
        // }

        // $csv = implode(",",$values);



        return view('frontend.aprior', );
    }
}
