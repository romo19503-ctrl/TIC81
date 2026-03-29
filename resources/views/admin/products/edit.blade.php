@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card shadow border-0">
            <div class="card-header bg-warning text-dark border-0">
                <h4 class="mb-0 italic uppercase font-black tracking-tighter text-center">
                    <i class="fa-solid fa-pen-to-square me-2"></i>Editar Producto: {{ $product->name }}
                </h4>
            </div>
            <div class="card-body bg-dark text-white p-5">
                <form action="{{ route('admin.products.update', $product) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-8 mb-4">
                            <label class="form-label fw-bold text-yellow-400 uppercase text-xs tracking-widest">Nombre del
                                Producto</label>
                            <input type="text" name="name"
                                class="form-control bg-secondary text-white border-0 py-3 px-4 rounded-xl shadow-inner focus:ring-2 focus:ring-yellow-400"
                                value="{{ $product->name }}" required>
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label fw-bold text-yellow-400 uppercase text-xs tracking-widest">Precio
                                ($)</label>
                            <input type="number" step="0.01" name="price"
                                class="form-control bg-secondary text-white border-0 py-3 px-4 rounded-xl shadow-inner focus:ring-2 focus:ring-yellow-400 font-mono"
                                value="{{ $product->price }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label
                                class="form-label fw-bold text-yellow-400 uppercase text-xs tracking-widest italic">Existencias
                                (Stock)</label>
                            <input type="number" name="stock"
                                class="form-control bg-secondary text-white border-0 py-3 px-4 rounded-xl shadow-inner focus:ring-2 focus:ring-yellow-400 font-mono"
                                value="{{ $product->stock }}" min="0" required>
                            <div class="form-text text-gray-500 text-[10px] mt-1 italic uppercase font-bold">Cambia este
                                número para activar/desactivar el botón de compra.</div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold text-yellow-400 uppercase text-xs tracking-widest italic">Link
                                de la Imagen (URL)</label>
                            <input type="text" name="image"
                                class="form-control bg-secondary text-white border-0 py-3 px-4 rounded-xl shadow-inner focus:ring-2 focus:ring-yellow-400"
                                value="{{ $product->image }}" placeholder="https://ejemplo.com/proteina.jpg">
                            <div class="form-text text-gray-500 text-[10px] mt-1 italic uppercase font-bold">Pega aquí el
                                enlace de Google Imágenes.</div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label
                            class="form-label fw-bold text-yellow-400 uppercase text-xs tracking-widest italic">Categorías</label>
                        <select name="categories[]"
                            class="form-select bg-secondary text-white border-0 rounded-xl focus:ring-2 focus:ring-yellow-400"
                            multiple style="height: 100px;" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->categories->contains($category->id) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="form-text text-gray-500 text-[10px] mt-1 italic uppercase font-bold">Mantén presionado
                            CTRL para seleccionar varias.</div>
                    </div>

                    <div class="mb-5">
                        <label
                            class="form-label fw-bold text-yellow-400 uppercase text-xs tracking-widest italic">Descripción
                            del Suplemento</label>
                        <textarea name="description"
                            class="form-control bg-secondary text-white border-0 rounded-xl py-3 px-4 focus:ring-2 focus:ring-yellow-400"
                            rows="4" placeholder="Detalles del producto...">{{ $product->description }}</textarea>
                    </div>

                    <div class="d-grid gap-3">
                        <button type="submit"
                            class="btn btn-warning py-3 font-black uppercase text-sm tracking-widest shadow-lg hover:bg-yellow-300 transition transform hover:scale-[1.01]">
                            Guardar Cambios
                        </button>
                        <a href="{{ route('admin.products.index') }}"
                            class="btn btn-outline-light py-2 text-[10px] font-black uppercase opacity-60 tracking-widest border-0 hover:bg-transparent">
                            Cancelar y volver
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection