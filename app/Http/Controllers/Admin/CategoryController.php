<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        Category::create($data);
        return redirect()->route('admin.categories.index')->with('success', 'Categoría creada');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $category->update($data);
        return redirect()->route('admin.categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back();
    }
}