@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card shadow border-0">
            <div class="card-header bg-warning text-dark border-0">
                <h4 class="mb-0 italic uppercase font-black tracking-tighter text-center">
                    <i class="fa-solid fa-plus me-2"></i>Registrar Nuevo Producto
                </h4>
            </div>
            <div class="card-body bg-dark text-white p-5">
                <form action="{{ route('admin.products.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-8 mb-4">
                            <label class="form-label fw-bold text-yellow-400 uppercase text-xs tracking-widest">Nombre del
                                Producto</label>
                            {{-- Cambiado a bg-white y text-black para visibilidad total --}}
                            <input type="text" name="name"
                                class="form-control bg-white text-black border-0 py-3 px-4 rounded-xl shadow-inner focus:ring-2 focus:ring-yellow-400"
                                placeholder="Ej. Whey Protein Isolate" required>
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label fw-bold text-yellow-400 uppercase text-xs tracking-widest">Precio
                                ($)</label>
                            <input type="number" step="0.01" name="price"
                                class="form-control bg-white text-black border-0 py-3 px-4 rounded-xl shadow-inner focus:ring-2 focus:ring-yellow-400 font-mono"
                                placeholder="0.00" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label
                                class="form-label fw-bold text-yellow-400 uppercase text-xs tracking-widest italic text-white">Stock
                                Inicial</label>
                            <input type="number" name="stock"
                                class="form-control bg-white text-black border-0 py-3 px-4 rounded-xl shadow-inner focus:ring-2 focus:ring-yellow-400 font-mono"
                                value="0" min="0" required>
                            <div class="form-text text-gray-400 text-[10px] mt-1 italic uppercase font-bold">Cantidad
                                disponible para venta inmediata.</div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label
                                class="form-label fw-bold text-yellow-400 uppercase text-xs tracking-widest italic text-white">URL
                                de la Imagen</label>
                            <input type="text" name="image"
                                class="form-control bg-white text-black border-0 py-3 px-4 rounded-xl shadow-inner focus:ring-2 focus:ring-yellow-400"
                                placeholder="https://link-de-la-foto.jpg">
                            <div class="form-text text-gray-400 text-[10px] mt-1 italic uppercase font-bold">Pega el enlace
                                directo de la imagen.</div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label
                            class="form-label fw-bold text-yellow-400 uppercase text-xs tracking-widest italic">Categorías
                            (Ctrl + Clic)</label>
                        <select name="categories[]"
                            class="form-select bg-white text-black border-0 rounded-xl focus:ring-2 focus:ring-yellow-400"
                            multiple style="height: 100px;" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" class="text-black">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-5">
                        <label
                            class="form-label fw-bold text-yellow-400 uppercase text-xs tracking-widest italic">Descripción</label>
                        <textarea name="description"
                            class="form-control bg-white text-black border-0 rounded-xl py-3 px-4 focus:ring-2 focus:ring-yellow-400"
                            rows="3" placeholder="Escribe los beneficios o ingredientes..."></textarea>
                    </div>

                    <div class="d-grid gap-3">
                        <button type="submit"
                            class="btn btn-warning py-3 font-black uppercase text-sm tracking-widest shadow-lg hover:bg-yellow-300 transition transform hover:scale-[1.01]">
                            Guardar Producto e Inventario
                        </button>
                        <a href="{{ route('admin.products.index') }}"
                            class="btn btn-outline-light py-2 text-[10px] font-black uppercase opacity-60 tracking-widest border-0 hover:bg-transparent">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection