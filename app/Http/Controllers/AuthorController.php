<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Dashboard | Author";
        $authors = Author::latest()->paginate(10);

        return view('dashboard.author.index', compact('title', 'authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Dashboard | Create Author";

        return view('dashboard.author.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            "name" => "required|max:255",
            "slug" => "required|unique:authors"
        ]);

        Author::create($validateData);

        return redirect('/dashboard/author',)->with('success', 'Author created successfully');
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
    public function edit(Author $author)
    {
        $title = "Author | Edit";

        return view('dashboard.author.edit', compact('title', 'author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {

        $rules = [
            'name' => 'required|max:255',
        ];

        if ($request->slug != $author->slug) {
            $rules['slug'] = 'required|unique:authors';
        }

        $validateData = $request->validate($rules);

        Author::where('id', $author->id)->update($validateData);

        return redirect('/dashboard/author')->with('success', 'Author has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        Author::destroy($author->id);
        return redirect('/dashboard/author')->with('success', 'Author has been deleted');
    }
}
