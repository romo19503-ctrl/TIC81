
@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0">Editar Producto: {{ $product->name }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product) }}" method="POST">
                @csrf
                @method('PUT') <div class="mb-3">
                    <label class="form-label fw-bold">Nombre del Producto</label>
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Precio</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Categorías (Puedes seleccionar varias)</label>
                    <select name="categories[]" class="form-select" multiple style="height: 150px;" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                {{ $product->categories->contains($category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form-text">Mantén presionado Ctrl (Windows) para seleccionar o deseleccionar varias.</div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Descripción</label>
                    <textarea name="description" class="form-control" rows="4">{{ $product->description }}</textarea>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">Actualizar Producto</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-light">Cancelar y Volver</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection