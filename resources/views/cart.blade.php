@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-black py-12 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex justify-between items-center mb-10 border-b border-yellow-400/30 pb-6">
                <h1 class="text-4xl font-black uppercase tracking-tighter">
                    Tu <span class="text-yellow-400">Carrito</span>
                </h1>
                <a href="{{ route('home') }}"
                    class="text-xs font-bold uppercase text-gray-400 hover:text-yellow-400 transition">
                    &larr; Volver a la tienda
                </a>
            </div>

            @if(session()->has('success'))
                <div
                    class="mb-6 bg-green-500/10 border border-green-500 text-green-500 px-4 py-3 rounded-xl font-bold uppercase text-xs tracking-widest text-center">
                    {{ session()->get('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-4">
                    @forelse ($cartItems as $item)
                        <div
                            class="bg-gray-900 rounded-2xl p-6 border border-gray-800 flex flex-col md:flex-row items-center gap-6 hover:border-yellow-400/30 transition">
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
                                <p class="text-gray-500 text-xs italic line-clamp-1 mb-2">
                                    {{ $item->attributes->description ?? 'Sin descripción disponible.' }}
                                </p>
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                                    Stock disponible: <span
                                        class="text-yellow-400">{{ $item->attributes->stock ?? 'N/A' }}</span>
                                </span>
                            </div>

                            <div class="flex flex-col items-center md:items-end gap-2">
                                <span class="text-xl font-black text-yellow-400 font-mono">
                                    ${{ number_format($item->price, 2) }}
                                </span>
                                <div class="flex items-center bg-black rounded-full border border-gray-800 p-1">
                                    <span class="px-4 text-sm font-black text-white">x{{ $item->quantity }}</span>
                                </div>
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $item->id }}" name="id">
                                    <button class="text-[10px] font-bold text-red-500 uppercase hover:underline">Quitar</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="bg-gray-900 rounded-3xl p-20 border border-dashed border-gray-800 text-center">
                            <p class="text-gray-500 font-black uppercase tracking-widest italic">El carrito está vacío</p>
                        </div>
                    @endforelse
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-gray-900 rounded-3xl p-8 border border-gray-800 sticky top-24">
                        <h2 class="text-xl font-black uppercase mb-6 text-white border-b border-gray-800 pb-4">Resumen</h2>

                        <div class="flex justify-between mb-4">
                            <span class="text-gray-400 text-xs font-bold uppercase">Productos</span>
                            <span class="text-white font-bold">{{ \Cart::getTotalQuantity() }}</span>
                        </div>

                        <div class="flex justify-between items-end mb-8">
                            <span class="text-gray-400 text-xs font-bold uppercase">Total a pagar</span>
                            <span
                                class="text-3xl font-black text-yellow-400 font-mono">${{ number_format(\Cart::getTotal(), 2) }}</span>
                        </div>

                        <div class="space-y-3">
                            <button
                                class="w-full bg-yellow-400 text-black py-4 rounded-xl font-black uppercase text-xs hover:bg-yellow-300 transition transform hover:scale-[1.02] shadow-xl shadow-yellow-400/10">
                                Finalizar Compra
                            </button>

                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                <button
                                    class="w-full bg-transparent border border-red-500/30 text-red-500 py-3 rounded-xl font-bold uppercase text-[10px] hover:bg-red-500 hover:text-white transition">
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