@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-black py-12 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex justify-between items-center mb-10 border-b border-yellow-400/30 pb-6">
                <h1 class="text-4xl font-black uppercase tracking-tighter text-white">
                    Tu <span class="text-yellow-400">Carrito</span>
                </h1>
                <a href="{{ route('home') }}"
                    class="text-xs font-bold uppercase text-gray-400 hover:text-yellow-400 transition">
                    &larr; Volver a la tienda
                </a>
            </div>

            {{-- Mensajes de Error o Éxito --}}
            @if(session()->has('success'))
                <div
                    class="mb-6 bg-green-500/10 border border-green-500 text-green-500 px-4 py-3 rounded-xl font-bold uppercase text-xs tracking-widest text-center italic">
                    {{ session()->get('success') }}
                </div>
            @endif

            @if(session()->has('error'))
                <div
                    class="mb-6 bg-red-500/10 border border-red-500 text-red-500 px-4 py-3 rounded-xl font-bold uppercase text-xs tracking-widest text-center italic">
                    {{ session()->get('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-4">
                    @forelse ($cartItems as $item)
                        <div
                            class="bg-gray-900 rounded-2xl p-6 border border-gray-800 flex flex-col md:flex-row items-center gap-6 hover:border-yellow-400/30 transition shadow-xl">

                            <div class="w-24 h-24 bg-black rounded-xl overflow-hidden flex-shrink-0 border border-gray-800">
                                <img src="{{ $item->attributes->image }}" class="w-full h-full object-contain p-2"
                                    alt="{{ $item->name }}">
                            </div>

                            <div class="flex-grow text-center md:text-left">
                                <div class="flex flex-wrap gap-1 mb-2 justify-center md:justify-start">
                                    @if(isset($item->attributes->categories))
                                        @foreach($item->attributes->categories as $category)
                                            <span
                                                class="bg-yellow-400 text-black text-[9px] font-black px-2 py-0.5 rounded uppercase italic">
                                                {{ $category }}
                                            </span>
                                        @endforeach
                                    @endif
                                </div>
                                <h3 class="text-lg font-black uppercase tracking-tight text-white">{{ $item->name }}</h3>
                                <p class="text-gray-500 text-[10px] italic line-clamp-1 mb-2">
                                    {{ $item->attributes->description ?? 'Sin descripción.' }}
                                </p>
                                <span class="text-[9px] font-bold text-gray-400 uppercase tracking-[0.2em]">
                                    Stock disponible: <span
                                        class="text-yellow-400 italic">{{ $item->attributes->stock ?? 'N/A' }}</span>
                                </span>
                            </div>

                            <div class="flex flex-col items-center md:items-end gap-3">
                                <span class="text-xl font-black text-yellow-400 font-mono italic">
                                    ${{ number_format($item->price, 2) }}
                                </span>

                                {{-- Actualizar Cantidad (Punto 4) --}}
                                <div class="flex items-center bg-black rounded-lg border border-gray-800 overflow-hidden">
                                    <form action="{{ route('cart.update') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                                        <button type="submit"
                                            class="px-3 py-1 bg-gray-900 text-white hover:bg-red-600 transition disabled:opacity-30"
                                            {{ $item->quantity <= 1 ? 'disabled' : '' }}>-</button>
                                    </form>

                                    <span class="px-4 text-xs font-black text-white italic">x{{ $item->quantity }}</span>

                                    <form action="{{ route('cart.update') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                        <button type="submit"
                                            class="px-3 py-1 bg-gray-900 text-white hover:bg-green-600 transition disabled:opacity-30"
                                            {{ $item->quantity >= $item->attributes->stock ? 'disabled' : '' }}>+</button>
                                    </form>
                                </div>

                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $item->id }}" name="id">
                                    <button
                                        class="text-[9px] font-black text-red-500 uppercase tracking-widest hover:underline">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="bg-gray-900 rounded-3xl p-20 border border-dashed border-gray-800 text-center">
                            <p class="text-gray-500 font-black uppercase tracking-[0.3em] italic">El carrito está vacío</p>
                        </div>
                    @endforelse
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-gray-900 rounded-3xl p-8 border border-gray-800 sticky top-24 shadow-2xl">
                        <h2
                            class="text-xl font-black uppercase mb-6 text-white border-b border-gray-800 pb-4 italic tracking-tighter text-right">
                            Tu Pedido</h2>

                        <div class="flex justify-between mb-4">
                            <span
                                class="text-gray-500 text-[10px] font-black uppercase tracking-widest italic">Artículos</span>
                            <span class="text-white font-black italic">{{ \Cart::getTotalQuantity() }}</span>
                        </div>

                        <div class="flex justify-between items-end mb-10">
                            <span class="text-gray-500 text-[10px] font-black uppercase tracking-widest italic">Total
                                Neto</span>
                            <div class="text-right">
                                <span
                                    class="text-3xl font-black text-yellow-400 font-mono italic tracking-tighter">${{ number_format(\Cart::getTotal(), 2) }}</span>
                                <p class="text-[8px] text-gray-600 font-bold uppercase tracking-tighter">IVA incluido 16%
                                </p>
                            </div>
                        </div>

                        <div class="space-y-3">
                            {{-- Botón a Checkout (Punto 6) --}}
                            <a href="{{ route('cart.checkout') }}"
                                class="w-full block text-center bg-yellow-400 text-black py-5 rounded-2xl font-black uppercase text-xs hover:bg-yellow-300 transition transform hover:scale-[1.03] shadow-xl shadow-yellow-400/5 active:scale-95">
                                Finalizar Compra
                            </a>

                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full bg-transparent border border-red-500/20 text-red-500 py-3 rounded-xl font-bold uppercase text-[9px] tracking-widest hover:bg-red-500 hover:text-white transition">
                                    Vaciar Carrito
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection