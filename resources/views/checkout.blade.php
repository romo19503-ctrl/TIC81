<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PowerGym | Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-black text-white font-sans">

    <div class="max-w-6xl mx-auto px-4 py-12">
        <header class="mb-12 border-b border-yellow-400/20 pb-6 flex justify-between items-end">
            <div>
                <h1 class="text-4xl font-black uppercase tracking-tighter text-white">Finalizar <span
                        class="text-yellow-400">Compra</span></h1>
                <p class="text-gray-500 text-[10px] uppercase font-bold tracking-widest mt-1 italic">Proyecto TIC81 -
                    Andres Garcia</p>
            </div>
            <a href="{{ route('cart.index') }}"
                class="text-xs font-bold uppercase text-gray-400 hover:text-yellow-400 transition">
                &larr; Volver al carrito
            </a>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <div class="lg:col-span-2">
                <h2 class="text-lg font-black uppercase mb-6 flex items-center gap-2 tracking-tight">
                    <i class="fa-solid fa-box-open text-yellow-400"></i> Artículos en tu pedido
                </h2>

                <div class="space-y-3">
                    @foreach(\Cart::getContent() as $item)
                        <div
                            class="bg-gray-900 border border-gray-800 p-5 rounded-2xl flex justify-between items-center hover:border-yellow-400/20 transition">
                            <div class="flex items-center gap-5">
                                <div
                                    class="w-14 h-14 bg-black rounded-xl border border-gray-800 flex items-center justify-center overflow-hidden p-2">
                                    <img src="{{ $item->attributes->image }}" class="w-full h-full object-contain">
                                </div>
                                <div>
                                    <h3 class="font-black uppercase italic text-sm tracking-tight">{{ $item->name }}</h3>
                                    <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Cantidad:
                                        {{ $item->quantity }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-[9px] text-gray-600 font-bold uppercase italic">Subtotal</p>
                                <span
                                    class="font-mono font-black text-yellow-400 text-base italic">${{ number_format($item->price * $item->quantity, 2) }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8 pt-6 border-t border-gray-800 flex justify-between items-center">
                    <span class="text-gray-500 font-black uppercase text-xs italic tracking-widest">Total
                        acumulado</span>
                    <span
                        class="text-3xl font-black text-white font-mono tracking-tighter italic">${{ number_format(\Cart::getTotal(), 2) }}</span>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-yellow-400 rounded-[2.5rem] p-8 text-black shadow-2xl shadow-yellow-400/5 sticky top-24">
                    <div class="flex items-center gap-2 mb-4">
                        <i class="fa-solid fa-shield-halved text-xl"></i>
                        <h2 class="text-2xl font-black uppercase leading-none italic tracking-tighter">Pasarela de Pagos
                        </h2>
                    </div>

                    <div class="bg-black/5 p-4 rounded-2xl mb-8 border border-black/10">
                        <p class="text-[9px] font-black uppercase opacity-60 mb-2 leading-tight italic">
                            Aviso del Desarrollador:
                        </p>
                        <p class="text-[11px] font-bold leading-tight uppercase">
                            Aquí se integrará la pasarela de pagos (Stripe, PayPal o Mercado Pago) en el siguiente
                            avance de la materia.
                        </p>
                    </div>

                    <div class="space-y-4 mb-10 text-right">
                        <div>
                            <span class="text-[10px] font-black uppercase opacity-50 block leading-none italic">Total a
                                debitar</span>
                            <div class="text-5xl font-black tracking-tighter font-mono italic leading-none">
                                ${{ number_format(\Cart::getTotal(), 2) }}</div>
                        </div>
                    </div>

                    <form action="{{ route('cart.process') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full bg-black text-white py-5 rounded-2xl font-black uppercase text-xs hover:bg-gray-900 transition-all transform active:scale-95 shadow-xl shadow-black/20">
                            Confirmar y Pagar
                        </button>
                    </form>

                    <p class="text-center mt-6 text-[8px] font-black uppercase opacity-40 tracking-[0.2em]">
                        Transacción Segura SSL 256-bit
                    </p>
                </div>
            </div>
        </div>
    </div>

    <footer class="py-12 text-center text-gray-800 text-[10px] uppercase tracking-[0.4em] font-black italic">
        PowerGym &copy; 2026 | TIC81 Checkout System
    </footer>

</body>

</html>