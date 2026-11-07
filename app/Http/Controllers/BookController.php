<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'cover_photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'genre_id' => 'required|exists:genres,id',
            'author_id' => 'required|exists:authors,id'
        ]);

        // Simpan gambar ke storage/app/public/books
        $coverPath = $request->file('cover_photo')->store('books', 'public');

        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'cover_photo' => $coverPath,
            'genre_id' => $request->genre_id,
            'author_id' => $request->author_id
        ]);

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
            'cover_photo' => 'sometimes|required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'genre_id' => 'sometimes|required|exists:genres,id',
            'author_id' => 'sometimes|required|exists:authors,id'
        ]);

        $data = $request->only([
            'title',
            'description',
            'price',
            'stock',
            'genre_id',
            'author_id'
        ]);

        // Jika ada gambar baru, simpan dan hapus gambar lama
        if ($request->hasFile('cover_photo')) {
            if ($book->cover_photo) {
                Storage::disk('public')->delete($book->cover_photo);
            }

            $data['cover_photo'] = $request->file('cover_photo')
                ->store('books', 'public');
        }

        $book->update($data);

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

        // Hapus gambar dari storage
        if ($book->cover_photo) {
            Storage::disk('public')->delete($book->cover_photo);
        }

        $book->delete();

        return response()->json([
            "success" => true,
            "message" => "Book deleted successfully"
        ], 200);
    }
}