<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\Movies;
use Illuminate\Support\Str;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;

    protected $fillable = [
        'username',
        'email',
        'slug',
        'password',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return ['id'=> $this->id,
        'username'=> $this->username,
        'slug'=> $this->slug,
        'email'=> $this->email
        ];
    }

    public function movies(){
        return $this->belongsToMany(Movies::class);
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    public static function boot()
    {
        parent::boot();

        static::updating(function ($user) {
        $user->slug = Str::slug($user->username);
    });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
