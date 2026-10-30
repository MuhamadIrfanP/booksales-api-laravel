<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    // Read all data
    public function index()
    {
        $genres = Genre::all();

        return response()->json([
            "success" => true,
            "message" => "Get all resources",
            "data" => $genres
        ], 200);
    }

    // Create data
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $genre = Genre::create($request->all());

        return response()->json([
            "success" => true,
            "message" => "Resource created successfully",
            "data" => $genre
        ], 201);
    }
}
