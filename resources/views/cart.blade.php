@extends('layouts.app') {{-- O el layout que estés usando --}}

@section('content')
    <div class="container">
        <h1>Tu Carrito de Compras</h1>
        <hr>
        @if(session()->has('success'))
            <div class="alert alert-success">{{ session()->get('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                    <tr>
                        <td><img src="{{ $item->attributes->image }}" width="50"></td>
                        <td>{{ $item->name }}</td>
                        <td>${{ $item->price }}</td>
                        <td>{{ $item->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            <h3>Total: ${{ Cart::getTotal() }}</h3>
            <a href="{{ route('home') }}" class="btn btn-secondary">Seguir comprando</a>
            <button class="btn btn-success">Finalizar Compra</button>
        </div>
    </div>
@endsection