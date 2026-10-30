<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();

        return response()->json([
            "success" => true,
            "message" => "Get all resources",
            "data" => $authors
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'required|string|max:255',
            'bio' => 'required|string'
        ]);

        $author = Author::create($request->all());

        return response()->json([
            "success" => true,
            "message" => "Resource created successfully",
            "data" => $author
        ], 201);
    }

    public function show($id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                "success" => false,
                "message" => "Author not found"
            ], 404);
        }

        return response()->json([
            "success" => true,
            "message" => "Get resource successfully",
            "data" => $author
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                "success" => false,
                "message" => "Author not found"
            ], 404);
        }

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'photo' => 'sometimes|required|string|max:255',
            'bio' => 'sometimes|required|string'
        ]);

        $author->update($request->all());

        return response()->json([
            "success" => true,
            "message" => "Resource updated successfully",
            "data" => $author
        ], 200);
    }

    public function destroy($id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                "success" => false,
                "message" => "Author not found"
            ], 404);
        }

        $author->delete();

        return response()->json([
            "success" => true,
            "message" => "Resource deleted successfully"
        ], 200);
    }
}