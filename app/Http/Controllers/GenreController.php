<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();

        return response()->json([
            "success" => true,
            "message" => "Get all resources",
            "data" => $genres
        ], 200);
    }

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

    public function show($id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                "success" => false,
                "message" => "Genre not found"
            ], 404);
        }

        return response()->json([
            "success" => true,
            "message" => "Get resource successfully",
            "data" => $genre
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                "success" => false,
                "message" => "Genre not found"
            ], 404);
        }

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string'
        ]);

        $genre->update($request->all());

        return response()->json([
            "success" => true,
            "message" => "Resource updated successfully",
            "data" => $genre
        ], 200);
    }

    public function destroy($id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                "success" => false,
                "message" => "Genre not found"
            ], 404);
        }

        $genre->delete();

        return response()->json([
            "success" => true,
            "message" => "Resource deleted successfully"
        ], 200);
    }
}