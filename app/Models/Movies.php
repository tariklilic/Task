<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Str;

class Movies extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'year',
        'imdbID', 
        'type', 
        'poster'
    ];

    public function movies(){
        return $this->belongsToMany(User::class);
    }

    public function setSlugAttribute($value){
        $this->attributes['slug'] = Str::slug($value);
    }

    public static function boot(){
        parent::boot();

        static::updating(function ($movie) {
        $movie->slug = Str::slug($movie->title);
        });
    }

    public function getRouteKeyName(){
        return 'slug';
    }
}
