

@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-warning text-dark py-3">
                    <h5 class="mb-0">Editar Categoría: {{ $category->name }}</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="form-label fw-bold">Nombre</label>
                            <input type="text" name="name" class="form-control form-control-lg" value="{{ $category->name }}" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Actualizar Cambios</button>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-light">Volver</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection