<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // GET: Menampilkan semua buku
    public function index()
    {
        $books = Book::all();

        return response()->json([
            "success" => true,
            "message" => "Get all books",
            "data" => $books
        ], 200);
    }

    // POST: Menambahkan buku
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'cover_photo' => 'required|string|max:255',
            'genre_id' => 'required|exists:genres,id',
            'author_id' => 'required|exists:authors,id'
        ]);

        $book = Book::create($request->all());

        return response()->json([
            "success" => true,
            "message" => "Book created successfully",
            "data" => $book
        ], 201);
    }

    // GET: Menampilkan satu buku
    public function show($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                "success" => false,
                "message" => "Book not found"
            ], 404);
        }

        return response()->json([
            "success" => true,
            "message" => "Get book successfully",
            "data" => $book
        ], 200);
    }

    // PUT/PATCH: Memperbarui buku
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                "success" => false,
                "message" => "Book not found"
            ], 404);
        }

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric|min:0',
            'stock' => 'sometimes|required|integer|min:0',
            'cover_photo' => 'sometimes|required|string|max:255',
            'genre_id' => 'sometimes|required|exists:genres,id',
            'author_id' => 'sometimes|required|exists:authors,id'
        ]);

        $book->update($request->all());

        return response()->json([
            "success" => true,
            "message" => "Book updated successfully",
            "data" => $book
        ], 200);
    }

    // DELETE: Menghapus buku
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                "success" => false,
                "message" => "Book not found"
            ], 404);
        }

        $book->delete();

        return response()->json([
            "success" => true,
            "message" => "Book deleted successfully"
        ], 200);
    }
}