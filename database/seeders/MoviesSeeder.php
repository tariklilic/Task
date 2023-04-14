<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use App\Models\Movies;
use File;

class MoviesSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
                "imdbID" => $value->imdbID,
                "type" => $value->type,
                "poster" => $value->poster
            ]);
        }
    }
}
