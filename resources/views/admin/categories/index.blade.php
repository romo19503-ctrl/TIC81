<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-gray-900 p-4 rounded-lg shadow-lg border-l-4 border-yellow-400">
            <h2 class="font-bold text-2xl text-white tracking-tight uppercase">
                {{ __('Categorías de Suplementos') }}
            </h2>
            <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center px-6 py-2 bg-yellow-400 border border-transparent rounded-full font-black text-xs text-black uppercase tracking-widest hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-300 transform hover:scale-105 shadow-md">
                + Nueva Categoría
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-800">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-800 w-full">
                        <thead>
                            <tr class="bg-black text-left text-xs font-black text-yellow-400 uppercase tracking-widest">
                                <th scope="col" class="px-6 py-5">ID</th>
                                <th scope="col" class="px-6 py-5">Nombre de Categoría</th>
                                <th scope="col" class="px-6 py-5">Slug / URL</th>
                                <th scope="col" class="px-6 py-5 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-900 divide-y divide-gray-800">
                            @foreach($categories as $category)
                            <tr class="hover:bg-gray-800 transition-all duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-mono font-bold">
                                    #{{ $category->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-black text-white uppercase">
                                    {{ $category->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-[10px] font-black font-mono text-yellow-500 bg-gray-800 border border-yellow-500/30 rounded uppercase">
                                        {{ $category->slug }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex justify-center space-x-3">
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="text-white hover:text-black hover:bg-white border border-white/20 px-4 py-1.5 rounded-lg text-xs font-bold transition duration-300 uppercase">
                                            Editar
                                        </a>
                                        
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-white hover:bg-red-600 border border-red-500/20 px-4 py-1.5 rounded-lg text-xs font-bold transition duration-300 uppercase" onclick="return confirm('¿Borrar categoría?')">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($categories->isEmpty())
                    <div class="text-center py-16 bg-gray-900">
                        <svg class="mx-auto h-12 w-12 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                        <p class="mt-4 text-gray-500 font-bold uppercase tracking-widest text-sm">No hay categorías disponibles</p>
                    </div>
                @endif
            </div>
            
            <div class="mt-4 text-right">
                <p class="text-xs text-gray-500 uppercase font-bold tracking-widest">Panel de Control PowerGym | Categorías</p>
            </div>
        </div>
    </div>
</x-app-layout>