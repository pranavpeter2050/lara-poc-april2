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
        // $movies = Movies::orderBy('id','asc')->paginate(5);
        // return view('movies.index', compact('movies'));
        $movies = Movies::orderBy('id','asc')->paginate(5);
        return $movies;
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('movies.create');
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

        return redirect()->route('movies.index')->with('success','Movies has been created successfully.');
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        // return view('movies.show', compact('movie'));
        // $movie_id = Crypt::decrypt($id);
        $movie_id = $id;
        $movies = Movies::findOrFail($movie_id);

        return $movies;
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Movies  $movie
    * @return \Illuminate\Http\Response
    */
    public function edit(Movies $movie)
    {
        return view('movies.edit', compact('movie'));
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

        // return redirect()->route('movies.index')->with('success','Movies Has Been updated successfully');
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
        // return redirect()->route('movies.index')->with('success','Movies has been deleted successfully');
        return response()->json('Movie deleted successfully!');
    }
}
