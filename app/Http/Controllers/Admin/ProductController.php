<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('categories')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $product = Product::create($data);

        // OBJETIVO: Registro en tabla intermediaria muchos a muchos
        if ($request->has('categories')) {
            $product->categories()->attach($request->categories);
        }

        return redirect()->route('admin.products.index');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $product->update($data);

        // OBJETIVO: Sincronizar relación muchos a muchos
        if ($request->has('categories')) {
            $product->categories()->sync($request->categories);
        }
        else {
            $product->categories()->detach();
        }

        return redirect()->route('admin.products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back();
    }
}
