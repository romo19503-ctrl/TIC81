<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Importamos el modelo para que el código sea más limpio

class CartController extends Controller
{
    public function cartList()
    {
        $cartItems = \Cart::getContent();
        return view('cart', compact('cartItems'));
    }

    public function add(Request $request)
    {
        $product = Product::find($request->id);

        if ($product->stock <= 0) {
            return redirect()->back()->with('error', 'Lo sentimos, este producto está agotado.');
        }

        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => 1,
            'attributes' => [
                'image' => $request->image,
                'description' => $request->description,
                'stock' => $product->stock
            ]
        ]);

        return redirect()->route('cart.index')->with('success', 'Producto añadido.');
    }

    public function update(Request $request)
    {
        $product = Product::find($request->id);

        if ($request->quantity > $product->stock) {
            return redirect()->back()->with('error', 'No puedes agregar más del stock disponible.');
        }

        \Cart::update($request->id, [
            'quantity' => [
                'relative' => false,
                'value' => $request->quantity
            ],
        ]);

        return redirect()->back()->with('success', 'Carrito actualizado.');
    }

    public function remove(Request $request)
    {
        \Cart::remove($request->id);
        return redirect()->back()->with('success', 'Producto eliminado del carrito.');
    }

    public function clear()
    {
        \Cart::clear();
        return redirect()->back()->with('success', 'El carrito se ha vaciado.');
    }


    public function checkout()
    {
        $cartItems = \Cart::getContent();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'El carrito está vacío.');
        }

        foreach ($cartItems as $item) {
            $product = Product::find($item->id);
            if ($product->stock < $item->quantity) {
                return redirect()->back()->with('error', "El producto {$product->name} ya no tiene stock suficiente.");
            }
        }


        foreach ($cartItems as $item) {
            $product = Product::find($item->id);
            $product->decrement('stock', $item->quantity);
        }

        \Cart::clear();
        return redirect()->route('home')->with('success', '¡Compra procesada con éxito en PowerGym! El stock ha sido actualizado.');
    }
}