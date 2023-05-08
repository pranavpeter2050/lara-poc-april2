<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MovieController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $movies = Movies::orderBy('id','asc')->paginate(5);
        return $movies;
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'studio' => 'required',
            'yor' => 'required',
        ]);

        $movie = new Movies();
        $movie->name = $request['name'];
        $movie->studio = $request['studio'];
        $movie->year_of_release = $request['yor'];
        $movie->save();

        return $movie;
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        // $movie_id = Crypt::decrypt($id);
        $movie_id = $id;
        $movies = Movies::findOrFail($movie_id);

        return $movies;
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'name' => 'required',
            'studio' => 'required',
            'yor' => 'required',
        ]);

        $movie = Movies::findOrFail($id);
        $movie->name = $request['name'];
        $movie->studio = $request['studio'];
        $movie->year_of_release = $request['yor'];
        $movie->save();

        return $movie;
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $movie = Movies::findOrFail($id);
        $movie->delete();

        return response()->json('Movie deleted successfully!');
    }
}
