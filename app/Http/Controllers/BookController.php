<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
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
    public function edit(Book $book)
    {
        $title = "Dashboard | Edit Book";
        $categories = Category::all();
        $authors = Author::all();

        return view('dashboard.book.edit', compact('title','book', 'categories', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $rules = [
            'name' => "required|max:255",
            "cover" => "file|image|max:1024",
            "body" => "required",
            "published_at" => "date",
            "category_id" => "required",
            "author_id" => "required",
        ];

        if ($request->slug != $book->slug) {
            $rules['slug'] = 'required|unique:books';
        }

        $validateData = $request->validate($rules);

        if ($request->hasFile('cover')) {
            if ($book->cover && Storage::disk('public')->exists($book->cover)) {
                Storage::disk('public')->delete($book->cover);
            }

            $validateData['cover'] = $request->file('cover')->store('book-covers', 'public');
        }

        Book::where('id', $book->id)->update($validateData);

        return redirect('/dashboard/book')->with('success', 'Book has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if ($book->cover && Storage::disk('public')->exists($book->cover)) {
            Storage::disk('public')->delete($book->cover);
        }

        Book::destroy($book->id);

        return redirect('/dashboard/book', )->with('success', 'Book deleted successfully!');
    }
}
