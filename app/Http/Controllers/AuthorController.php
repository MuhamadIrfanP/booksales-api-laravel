<?php

namespace App\Http\Controllers;

use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        $model = new Author();
        $authors = $model->getAll();

        return view('authors.index', compact('authors'));
    }
}