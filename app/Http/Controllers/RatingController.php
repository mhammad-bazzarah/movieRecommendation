<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Rating;
use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.rate');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $tagMessage = "";
        if ($request->has('tag') && $request['tag'] != null) {
            try {
                $rate = new Rating();
                $rate->userId = Auth()->user()->id;
                $rate->rating = $request->rating;
                $rate->movieId = $request->movieId;
                $rate->timestamp = now();
                $rate->save();
                // Update The movie's rate
                $movie = Movie::findOrFail($request->movieId);
                $counter = 0;
                foreach ($movie->rates as $rate) {
                    $counter += $rate->rating;
                }
                $numOfRatings = count($movie->rates);
                $rate = round($counter / $numOfRatings);
                $movie->rate = $rate;
                $movie->numOfRatings = $numOfRatings;
                $movie->save();
            } catch (Exception $e) {
                // flash()->error("error" . $e->getMessage());
            }
        }
        // Add tag to the movie if provided
        if ($request->has('tag') && $request['tag'] != null) {
            $tag = new Tag();
            $tag->tag = $request->tag;
            $tag->movieId = $request->movieId;
            $tag->userId = Auth()->user()->id;
            $tag->timestamp = now();
            $tag->save();
            $tagMessage = "and your tag is add to the movie";
        }

        flash()->success('new rating add successfully' . $tagMessage);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
