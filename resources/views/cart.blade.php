<div class="space-y-3">
    {{-- Botón a Checkout con Stripe (Punto 6) --}}
    @if(!\Cart::isEmpty())
        <form action="{{ route('cart.checkout') }}" method="GET">
            @csrf
            <button type="submit"
                class="w-full block text-center bg-yellow-400 text-black py-5 rounded-2xl font-black uppercase text-xs hover:bg-yellow-300 transition transform hover:scale-[1.03] shadow-xl shadow-yellow-400/5 active:scale-95">
                Pagar con Stripe
            </button>
        </form>
    @endif

    <form action="{{ route('cart.clear') }}" method="POST">
        @csrf
        <button type="submit"
            class="w-full bg-transparent border border-red-500/20 text-red-500 py-3 rounded-xl font-bold uppercase text-[9px] tracking-widest hover:bg-red-500 hover:text-white transition">
            Vaciar Carrito
        </button>
    </form>
</div>