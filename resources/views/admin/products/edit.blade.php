@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0 italic uppercase font-black">Editar Producto: {{ $product->name }}</h4>
            </div>
            <div class="card-body bg-dark text-white">
                <form action="{{ route('admin.products.update', $product) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold text-yellow-400 uppercase text-xs">Nombre del Producto</label>
                        <input type="text" name="name" class="form-control bg-secondary text-white border-0"
                            value="{{ $product->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-yellow-400 uppercase text-xs">Precio</label>
                        <input type="number" step="0.01" name="price" class="form-control bg-secondary text-white border-0"
                            value="{{ $product->price }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-yellow-400 uppercase text-xs">Categorías</label>
                        <select name="categories[]" class="form-select bg-secondary text-white border-0" multiple
                            style="height: 120px;" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->categories->contains($category->id) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="form-text text-gray-400 text-xs mt-1 italic">Ctrl + Clic para seleccionar varias.</div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-yellow-400 uppercase text-xs">Descripción</label>
                        <textarea name="description" class="form-control bg-secondary text-white border-0"
                            rows="3">{{ $product->description }}</textarea>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-warning fw-black uppercase">Guardar Cambios</button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-light text-xs">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection