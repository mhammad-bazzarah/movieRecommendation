<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Movie extends Model
{
    use HasFactory;
    protected $primaryKey = 'movieId';
    /**
     * the genere of the movie
     * @return BelongsToMany
     */
    public function geners() : BelongsToMany{
        return $this->belongsToMany(Gener::class);
    }

}
