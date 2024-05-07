<?php

use Illuminate\Support\Facades\DB;

/**
 * this funciton is to fill gener_movie table that represents the many-to-many
 *  relationsheep between `geners` and `movies` table
 */
function fill_gener_movie($tableModel,$gener_name,$generId){
    $action = $tableModel::where('geners','like',"%$gener_name%")->get();
        foreach($action as $ac){
            DB::table('gener_movie')->insert([
                'generId' => $generId,
                'movieId' => $ac->movieId,
            ]);
        }
}

function UpdateMoveisYear($allmovies){
    foreach($allMovies as $movie){
        DB::table('movies')->where('movieId',$movie->movieId)->update([
            'year' => \Str::take(\Str::of($movie->title)->afterLast('('),4),
        ]);
    }

}


