<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartList()
    {
        $cartItems = \Cart::getContent();
        return view('cart', compact('cartItems'));
    }

    public function add(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity ?? 1,
            'attributes' => array(
                'image' => $request->image,
                'description' => $request->description,
                'stock' => $request->stock,
            )
        ]);

        return redirect()->back()->with('success', '¡Producto añadido al carrito correctamente!');
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
}