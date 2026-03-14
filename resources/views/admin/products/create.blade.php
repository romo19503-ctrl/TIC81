@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h4>Registrar Producto</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.products.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nombre del Producto</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Precio</label>
                    <input type="number" step="0.01" name="price" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Categorías (Selecciona varias con Ctrl + Clic)</label>
                    <select name="categories[]" class="form-select" multiple required style="height: 120px;">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Guardar Producto</button>
            </form>
        </div>
    </div>
</div>
@endsection