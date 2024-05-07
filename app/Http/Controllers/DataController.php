<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function edit(){
        $action = Movie::all();
        return view('frontend.run',compact('action'));
    }
}
