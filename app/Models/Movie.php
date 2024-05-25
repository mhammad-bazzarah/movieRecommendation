<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Movie extends Model
{
    use HasFactory;
    protected $primaryKey = 'movieId';
    public $timestamps = false;

    /**
     * the genere of the movie
     * @return BelongsToMany
     */
    public function geners() : BelongsToMany{
        return $this->belongsToMany(Gener::class,'gener_movie','movieId','generId');
    }
    public function rates(){
        return $this->hasMany(Rating::class,'movieId');
    }

    public function tags(){
        return $this->hasMany(Tag::class,'movieId');
    }

}
