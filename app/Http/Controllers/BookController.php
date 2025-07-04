<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'cover_url' => 'nullable|url',
        ]);

        Book::create([
            'name' => $request->name,
            'description' => $request->description,
            'cover_url' => $request->cover_url,
        ]);

        return redirect('/books/create')->with('success', 'Book created successfully!');
    }

    public function index()
    {
        $books = Book::latest()->get();
        return view('books.index', compact('books'));
    }
}