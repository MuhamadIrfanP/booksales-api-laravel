<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            'Andrea Hirata',
            'Tere Liye',
            'Dee Lestari',
            'Pidi Baiq',
            'J. K. Rowling',
        ];

        foreach ($authors as $name) {
            Author::create(['name' => $name]);
        }
    }
}