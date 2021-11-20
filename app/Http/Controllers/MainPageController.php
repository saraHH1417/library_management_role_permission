<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function __invoke()
    {
        $books = Book::with('author' , 'publisher')->latest()->get();
        return view('index' , ['books' => $books]);
    }
}
