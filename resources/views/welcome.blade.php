<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PowerGym | Suplementos Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-black text-white">

    <nav class="bg-gray-900 border-b border-yellow-400/30 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="text-2xl font-black tracking-tighter text-yellow-400">POWER<span
                            class="text-white">GYM</span></a>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('cart.index') }}"
                        class="relative text-white hover:text-yellow-400 transition p-2">
                        <i class="fa-solid fa-cart-shopping text-xl"></i>
                        @if(\Cart::getTotalQuantity() > 0)
                            <span
                                class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">
                                {{ \Cart::getTotalQuantity() }}
                            </span>
                        @endif
                    </a>

                    @auth
                        <a href="{{ route('admin.products.index') }}"
                            class="bg-yellow-400 text-black px-4 py-2 rounded-full text-xs font-black uppercase hover:bg-yellow-300 transition transform hover:scale-105">
                            Admin Panel
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="text-xs font-bold uppercase text-gray-400 hover:text-white transition">Salir</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-xs font-bold uppercase hover:text-yellow-400 transition">Entrar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if(session()->has('success'))
            <div
                class="mb-8 bg-green-500/20 border border-green-500 text-green-500 px-4 py-3 rounded-xl text-center font-bold uppercase text-xs tracking-widest">
                {{ session()->get('success') }}
            </div>
        @endif

        <header class="text-center mb-16">
            <h1 class="text-5xl md:text-7xl font-black uppercase tracking-tighter mb-4">
                Lleva tu <span class="text-yellow-400">Rendimiento</span> al Límite
            </h1>
            <p class="text-gray-400 max-w-2xl mx-auto font-medium">
                Suplementación de grado profesional para atletas de alto nivel. Proyecto TIC81 - Andres Garcia
            </p>
        </header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($products as $product)
                <div
                    class="group bg-gray-900 rounded-2xl overflow-hidden border border-gray-800 hover:border-yellow-400/50 transition-all duration-300 flex flex-col shadow-2xl">
                    <div
                        class="h-48 bg-gradient-to-br from-gray-800 to-black flex items-center justify-center relative overflow-hidden">
                        <span class="text-gray-700 font-black text-6xl uppercase opacity-20 select-none">FUEL</span>
                        <div class="absolute top-3 left-3 flex flex-wrap gap-1">
                            @foreach ($product->categories as $cat)
                                <span
                                    class="bg-yellow-400 text-black text-[10px] font-black px-2 py-0.5 rounded uppercase tracking-tighter">
                                    {{ $cat->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-lg font-black uppercase leading-tight mb-2 group-hover:text-yellow-400 transition">
                            {{ $product->name }}
                        </h3>
                        <p class="text-gray-500 text-xs line-clamp-2 mb-4 italic">
                            {{ $product->description ?? 'Sin descripción disponible para este suplemento.' }}
                        </p>

                        <div class="mt-auto pt-4 border-t border-gray-800 flex justify-between items-center">
                            <div>
                                <span class="block text-[10px] uppercase font-bold text-gray-500">Precio</span>
                                <span
                                    class="text-2xl font-black text-white font-mono">${{ number_format($product->price, 2) }}</span>
                            </div>

                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <input type="hidden" name="name" value="{{ $product->name }}">
                                <input type="hidden" name="price" value="{{ $product->price }}">
                                <input type="hidden" name="img" value="{{ $product->image }}">
                                <input type="hidden" name="quantity" value="1">

                                <button type="submit"
                                    class="bg-white text-black px-4 py-2 rounded-lg text-xs font-black uppercase hover:bg-yellow-400 transition-colors">
                                    Comprar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 bg-gray-900 rounded-3xl border border-dashed border-gray-700">
                    <p class="text-gray-500 font-bold uppercase tracking-widest text-lg">No hay stock disponible en este
                        momento.</p>
                </div>
            @endforelse
        </div>
    </div>

    <footer class="py-10 text-center text-gray-600 text-[10px] uppercase tracking-[0.2em]">
        &copy; 2026 PowerGym | TIC81
    </footer>

</body>

</html>