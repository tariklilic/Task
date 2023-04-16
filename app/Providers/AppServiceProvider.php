<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Movies;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::creating(function ($user) {
            $user->slug = Str::slug($user->username);
        });

        Movies::creating(function ($movie) {
            $movie->slug = Str::slug($movie->title);
        });
    }
}
