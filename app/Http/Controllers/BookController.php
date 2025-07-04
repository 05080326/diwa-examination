<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle file image upload
        $image_name = time() . '.' . $request->file('cover_image')->extension();
        Storage::disk('public')->putFileAs('images', $request->file('cover_image'), $image_name);

        Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'cover_image' => 'images/' . $image_name,
        ]);

        return redirect('/books/create')->with('success', 'Book created successfully!');
    }

    public function index()
    {
        $books = Book::latest()->get();
        return view('books.index', compact('books'));
    }

    public function assign()
    {
        $books = Book::select('id', 'title')->latest()->get();
        $students = User::where('role', 'student')->select('id', 'fullname')->latest()->get();

        return view('books.assign', compact('books', 'students'));
    }

    public function assignBook(Request $request)
    {
        $book = Book::where('id', '=', $request->book_id)->first();
        $student = User::where('id', '=', $request->user_id)->where('role', 'student')->first();

        // Check if a student already owns the book
        $bookExists = $student->books()->where('book_id', $book->id)->exists();

        if ($bookExists) {
            return redirect('/books/assign')->with('error', 'This student already has this book!');
        }

        // Assign the book to the student
        $student->books()->attach($book);

        return redirect('/books/assign')->with('success', 'Book assigned successfully!');
    }

    public function assignments(Request $request)
    {
        $filterStudentId = $request->filter;

        $students = User::where('role', 'student')->get();
        $items = BookUser::when($filterStudentId, function (Builder $query, $filterStudentId) {
            $query->where('user_id', '=', $filterStudentId);
        })->with(['user', 'book'])->latest()->get();

        return view('books.assignments', compact('items', 'students'));
    }

    public function unassignBook(string $id)
    {
        BookUser::where('id', '=', $id)->delete();

        return redirect('/books/assignments')->with('success', 'Book unassigned successfully!');
    }
}
