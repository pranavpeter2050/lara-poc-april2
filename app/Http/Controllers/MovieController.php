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
        $movies = Movies::orderBy('id','asc')->paginate(15);
        return response()->json($movies);
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

        Movies::insertMovie($request);

        return response()->json('Movie added to database!');
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $movie = Movies::fetchMovie($id);

        return $movie;
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

        Movies::updateMovie($request, $id);

        return response()->json('Movie updated in database!');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        Movies::deleteMovie($id);

        return response()->json('Movie deleted from database!');
    }
}
