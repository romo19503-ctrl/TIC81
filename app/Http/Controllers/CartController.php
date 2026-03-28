<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    // Muestra la lista de productos en el carrito
    public function cartList()
    {
        $cartItems = \Cart::getContent();
        // Asegúrate de tener el archivo resources/views/cart.blade.php
        return view('cart', compact('cartItems'));
    }

    // Agrega un producto al carrito
    public function add(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity ?? 1,
            'attributes' => array(
                'image' => $request->img,
            )
        ]);

        return redirect()->back()->with('success', '¡Producto añadido al carrito correctamente!');
    }

    // Elimina un producto específico
    public function remove(Request $request)
    {
        \Cart::remove($request->id);
        return redirect()->back()->with('success', 'Producto eliminado del carrito.');
    }

    // Vacía todo el carrito
    public function clear()
    {
        \Cart::clear();
        return redirect()->back()->with('success', 'El carrito se ha vaciado.');
    }
}