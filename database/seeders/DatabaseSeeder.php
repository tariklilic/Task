<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use App\Models\Movies;
use File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Movies::truncate();

        $json = File::get('database/moviesData/movies.json');
        $movies = json_decode($json);

        foreach ($movies as $key => $value){
            Movies::create([
                "title" => $value->title,
                "year" => $value->year,
                "slug" => $value->title,
                "imdbID" => $value->imdbID,
                "type" => $value->type,
                "poster" => $value->poster
            ]);
        }
    }
}
