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
        // Forzamos la carga de productos con sus categorías
        // Si sigue sin salir nada, cambia 'get()' por 'all()' para probar
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
        // Validación básica (buena práctica de TIC)
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $product = Product::create($data);

        if ($request->has('categories')) {
            $product->categories()->attach($request->categories);
        }

        return redirect()->route('admin.products.index')->with('success', 'Producto creado');
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

        if ($request->has('categories')) {
            $product->categories()->sync($request->categories);
        }
        else {
            $product->categories()->detach();
        }

        return redirect()->route('admin.products.index')->with('success', 'Producto actualizado');
    }

    public function destroy(Product $product)
    {
        // 1. Limpiamos relaciones en la tabla intermedia (importante)
        $product->categories()->detach();

        // 2. Borramos el producto
        $product->delete();

        // 3. Redirigimos al index con un mensaje de sesión
        return redirect()->route('admin.products.index')->with('eliminar', 'ok');
    }
}