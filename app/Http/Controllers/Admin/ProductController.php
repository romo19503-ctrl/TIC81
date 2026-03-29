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
        $products = Product::with('categories')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0', // Validamos el stock
            'description' => 'nullable',
            'image' => 'nullable'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $product = Product::create($data);

        if ($request->has('categories')) {
            $product->categories()->attach($request->categories);
        }

        return redirect()->route('admin.products.index')
            ->with('success', '¡Suplemento añadido al stock exitosamente!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0', // Validamos el stock aquí también
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $product->update($data);

        if ($request->has('categories')) {
            $product->categories()->sync($request->categories);
        } else {
            $product->categories()->detach();
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Información del producto actualizada correctamente.');
    }

    public function destroy(Product $product)
    {
        $product->categories()->detach();
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'El producto ha sido retirado del inventario.');
    }
}