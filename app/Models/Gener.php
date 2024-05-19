<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Gener extends Model
{
    use HasFactory;
    protected $table = 'geners';
    protected $primaryKey = 'generId';
    /**
     * the movies related to this gener
     * @return BelongsToMany
     */
    public function movies() : BelongsToMany{
        return $this->belongsToMany(Movie::class);
    }


}
