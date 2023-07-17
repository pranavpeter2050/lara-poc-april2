<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Movies extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'studio', 'year_of_release'];

    public static function listMovies() {
        try {

            $listMovies = Movies::orderBy('id','asc')->paginate(15);

            if (!$listMovies) {
                return response()->json(['message' => 'Unable to fetch movies from database. Please try after some time.'], 500);
            }
            return $listMovies;

        } catch(\Exception $e) {
            $errorMessage = 'Error occurred in the listMovie method: ' . $e->getMessage();
            Log::error($errorMessage);

            // Handle the error or return an appropriate response
            return response()->json(['error' => 'An error occurred while listing the movies from database.'], 500);
        }
    }


    public static function insertMovie($request) {
        try {

            $request->validate([
                'name' => 'required',
                'studio' => 'required',
                'yor' => 'required',
            ]);

            $movie = new Movies();
            $movie->name = $request['name'];
            $movie->studio = $request['studio'];
            $movie->year_of_release = $request['yor'];
            $saveMovie = $movie->save();

            if (!$saveMovie) {
                // Unable to save the movie in database. Return an error message.
                return response()->json(['message' => 'Unable to save Movie in database. Please try after some time.'], 500);
            }
            return response()->json(['message' => 'Movie added to database!']);

        } catch (\Exception $e) {
            // Log the error with source and message
            $errorMessage = 'Error occurred in the insertMovie method: ' . $e->getMessage();
            Log::error($errorMessage);

            // Handle the error or return an appropriate response
            return response()->json(['error' => 'An error occurred while storing the movie.'], 500);
        }
    }

    public static function fetchMovie($id) {
        try {

            $movie = Movies::findOrFail($id);

            if (!$movie) {
                return response()->json(['message' => 'Unable to fetch the movie from database. Please try after some time.'], 500);
            }
            return $movie;

        } catch (\Exception $e) {
            $errorMessage = 'Error occurred in the fetchMovie method: ' . $e->getMessage();
            Log::error($errorMessage);

            // Handle the error or return an appropriate response
            return response()->json(['error' => 'An error occurred while fetching the movie from database.'], 500);
        }
    }


    public static function updateMovie($request, $id) {
        try {

            $request->validate([
                'name' => 'required',
                'studio' => 'required',
                'yor' => 'required',
            ]);

            $movie = Movies::findOrFail($id);
            $movie->name = $request['name'];
            $movie->studio = $request['studio'];
            $movie->year_of_release = $request['yor'];
            $updateMovie = $movie->save();

            if (!$updateMovie) {
                // Unable to update the movie in database. Return an error message.
                return response()->json(['message' => 'Unable to update Movie in database. Please try after some time.'], 500);
            }
            return response()->json(['message' => 'Movie updated in database!']);

        } catch (\Exception $e) {
            // Log the error with source and message
            $errorMessage = 'Error occurred in the updateMovie method: ' . $e->getMessage();
            Log::error($errorMessage);

            // Handle the error or return an appropriate response
            return response()->json(['error' => 'An error occurred while updating the movie.'], 500);
        }
    }


    public static function deleteMovie($id) {
        try {

            $movie = Movies::findOrFail($id);
            $deleteStatus = $movie->delete();

            if (!$deleteStatus) {
                return response()->json(['message' => 'Unable to delete Movie in database. Please try after some time.'], 500);
            }
            return response()->json(['message' => 'Movie deleted from database!']);

        } catch (\Exception $e) {
            $errorMessage = 'Error occurred in the deleteMovie method: ' . $e->getMessage();
            Log::error($errorMessage);

            // Handle the error or return an appropriate response
            return response()->json(['error' => 'An error occurred while fetching movie from database.'], 500);
        }
    }

}
