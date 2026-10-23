<?php

namespace App\Models;

class Genre
{
    public function getAll()
    {
        return [
            ['id' => 1, 'name' => 'Fiksi'],
            ['id' => 2, 'name' => 'Teknologi'],
            ['id' => 3, 'name' => 'Pendidikan'],
            ['id' => 4, 'name' => 'Romance'],
            ['id' => 5, 'name' => 'Sejarah'],
        ];
    }
}