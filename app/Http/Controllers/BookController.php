<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Dashboard | Book";
        $books = Book::latest()->paginate(10);

        return view('dashboard.book.index', compact('title', 'books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Dashboard | Create Book";
        $categories = Category::all();
        $authors = Author::all();

        return view('dashboard.book.create', compact('title', 'categories', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => "required|max:255",
            "slug" => "required|unique:books",
            "cover" => "required|image|max:1024",
            "body" => "required",
            "published_at" => "date",
            "category_id" => "required",
            "author_id" => "required",
        ]);

        if ($request->file('cover')) {
            $validateData['cover'] = $request->file('cover')->store('book-covers', 'public');
        }

        Book::create($validateData);

        return redirect('/dashboard/book')->with('success', 'New book has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
