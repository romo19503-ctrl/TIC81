<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Muestra el inventario de suplementos.
     */
    public function index()
    {
        // Cargamos productos con sus categorías usando Eager Loading para evitar errores en el @foreach
        $products = Product::with('categories')->latest()->get();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Muestra el formulario para añadir un nuevo suplemento.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Guarda el nuevo producto en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'image' => 'nullable' // Aquí puedes validar si es URL o archivo
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $product = Product::create($data);

        // Sincroniza las categorías seleccionadas en el checkbox/select múltiple
        if ($request->has('categories')) {
            $product->categories()->attach($request->categories);
        }

        return redirect()->route('admin.products.index')
            ->with('success', '¡Suplemento añadido al stock exitosamente!');
    }

    /**
     * Muestra el formulario de edición.
     */
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