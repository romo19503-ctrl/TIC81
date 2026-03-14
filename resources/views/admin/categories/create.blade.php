@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Añadir Nueva Categoría</h2>
            
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nombre de la categoría:</label>
                    <input type="text" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ej. Electrónica" required>
                </div>
                
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Guardar Categoría
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="text-gray-500 hover:text-gray-700">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection