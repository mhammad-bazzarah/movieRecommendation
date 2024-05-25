<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = ['movieId','userId','rating'];
    public $timestamps = false;
    protected $table = 'ratings';
    protected $primaryKey = 'rateId';
    public function save(array $options = [])
    {
        $this->timestamps = false;
        $saved = parent::save($options);
        $this->timestamps = true;
        return $saved;
    }



}
