<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title', 'year', 'imdbID', 'type', 'poster'
    ];
}
