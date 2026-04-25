<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Product;

class StripeController extends Controller
{
    /**
     * Crea la sesión de pago y redirige a Stripe
     */
    public function checkout()
    {
        // Conecta con las llaves de tu archivo .env
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $cartItems = \Cart::getContent();
        $lineItems = [];

        // Convertimos cada producto del carrito al formato que pide Stripe
        foreach ($cartItems as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'mxn',
                    'product_data' => [
                        'name' => $item->name,
                    ],
                    'unit_amount' => $item->price * 100, // Stripe recibe centavos (ej: 100.00 = 10000)
                ],
                'quantity' => $item->quantity,
            ];
        }

        // Creamos la sesión de Checkout
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('stripe.success'), // A dónde va si el pago es exitoso
            'cancel_url' => route('stripe.cancel'),   // A dónde va si el usuario cancela
        ]);

        return redirect($session->url);
    }

    /**
     * Si el pago fue exitoso, descontamos el stock y limpiamos el carrito
     */
    public function success()
    {
        $cartItems = \Cart::getContent();

        foreach ($cartItems as $item) {
            $product = Product::find($item->id);
            if ($product) {
                // Bajamos el stock físicamente en la base de datos
                $product->decrement('stock', $item->quantity);
            }
        }

        // Vaciamos el carrito de PowerGym
        \Cart::clear();

        return view('stripe.success');
    }

    /**
     * Si el usuario le da "Atrás" en la página de Stripe
     */
    public function cancel()
    {
        return redirect()->route('cart.index')->with('error', 'El pago fue cancelado o hubo un error.');
    }
}