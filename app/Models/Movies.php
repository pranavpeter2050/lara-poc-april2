<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'studio', 'year_of_release'];


    public static function insertMovie($request) {

        $movie = new Movies();
        $movie->name = $request['name'];
        $movie->studio = $request['studio'];
        $movie->year_of_release = $request['yor'];
        $movie->save();

    }

    public static function fetchMovie($id) {

        $movie_id = $id;
        $movie = Movies::findOrFail($movie_id);

        return $movie;
    }


    public static function updateMovie($request, $id) {

        $movie = Movies::findOrFail($id);
        $movie->name = $request['name'];
        $movie->studio = $request['studio'];
        $movie->year_of_release = $request['yor'];
        $movie->save();

    }


    public static function deleteMovie($id) {

        $movie = Movies::findOrFail($id);
        $movie->delete();

    }

}
