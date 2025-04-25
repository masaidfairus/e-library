<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $title = "Dashboard | Category";
        $categories = Category::latest()->paginate(10);

        return view('dashboard.category.index', compact('title', 'categories'));
    }

    public function create()
    {
        $title = 'Category | Create';

        return view('dashboard.category.create', compact('title'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:categories',
        ]);

        Category::create($validateData);

        return redirect('/dashboard/category')->with('success', 'New category has been added!');
    }

    public function edit(Category $category)
    {
        $title = 'Dashboard | Edit Category';

        return view('dashboard.category.edit', compact('title', 'category'));
    }

    public function update(Request $request, Category $category)
    {

        $rules = [
            'name' => 'required|max:255',
        ];

        if ($request->slug != $category->slug) {
            $rules['slug'] = 'required|unique:categories';
        }

        $validateData = $request->validate($rules);

        Category::where('id', $category->id)->update($validateData);

        return redirect('/dashboard/category')->with('success', 'Category has been updated!');
    }

    public function destroy(Category $category)
    {
        Category::destroy($category->id);
        return redirect('/dashboard/category')->with('success', 'Category has been deleted');
    }
}
