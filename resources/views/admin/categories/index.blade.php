
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Gestión de Categorías</h2>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary shadow-sm">+ Nueva Categoría</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4">ID</th>
                        <th>Nombre</th>
                        <th>Slug</th>
                        <th class="text-end px-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td class="px-4 text-muted">{{ $category->id }}</td>
                        <td class="fw-bold">{{ $category->name }}</td>
                        <td><code class="text-primary">{{ $category->slug }}</code></td>
                        <td class="text-end px-4">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-warning me-2">Editar</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Borrar categoría?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection