<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // Read all data
    public function index()
    {
        $authors = Author::all();

        return response()->json([
            "success" => true,
            "message" => "Get all resources",
            "data" => $authors
        ], 200);
    }

    // Create data
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
}
