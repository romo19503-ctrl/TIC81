@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-black flex items-center justify-center px-4">
        <div class="max-w-md w-full bg-gray-900 border border-yellow-400/30 rounded-3xl p-8 text-center shadow-2xl">
            <div
                class="mb-6 inline-flex items-center justify-center w-16 h-16 bg-green-500/10 rounded-full border border-green-500">
                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <h1 class="text-3xl font-black uppercase italic tracking-tighter text-white mb-2">
                ¡Pago <span class="text-yellow-400">Exitoso</span>!
            </h1>

            <p class="text-gray-400 text-sm mb-8 italic">
                Tu pedido de PowerGym ha sido procesado. El stock ha sido actualizado correctamente.
            </p>

            <a href="{{ route('home') }}"
                class="inline-block w-full bg-yellow-400 text-black font-black uppercase text-xs py-4 rounded-xl hover:bg-yellow-300 transition transform hover:scale-105 active:scale-95">
                Volver a la Tienda
            </a>
        </div>
    </div>
@endsection