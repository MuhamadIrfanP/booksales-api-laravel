<?php

namespace App\Models;

class Author
{
    public function getAll()
    {
        return [
            ['id' => 1, 'name' => 'Andrea Hirata'],
            ['id' => 2, 'name' => 'Tere Liye'],
            ['id' => 3, 'name' => 'Dee Lestari'],
            ['id' => 4, 'name' => 'Pidi Baiq'],
            ['id' => 5, 'name' => 'J. K. Rowling'],
        ];
    }
}