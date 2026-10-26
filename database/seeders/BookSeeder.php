<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            ['title' => 'Laskar Pelangi', 'author' => 'Andrea Hirata', 'price' => 85000],
            ['title' => 'Bumi', 'author' => 'Tere Liye', 'price' => 90000],
            ['title' => 'Perahu Kertas', 'author' => 'Dee Lestari', 'price' => 80000],
            ['title' => 'Dilan 1990', 'author' => 'Pidi Baiq', 'price' => 75000],
            ['title' => 'Harry Potter', 'author' => 'J. K. Rowling', 'price' => 120000],
        ];

        foreach ($books as $book) {
            $author = Author::where('name', $book['author'])->firstOrFail();

            Book::create([
                'title' => $book['title'],
                'author_id' => $author->id,
                'price' => $book['price'],
            ]);
        }
    }
}