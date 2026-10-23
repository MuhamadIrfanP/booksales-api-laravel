<?php

namespace App\Http\Controllers;

use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        $model = new Genre();
        $genres = $model->getAll();

        return view('genres.index', compact('genres'));
    }
}