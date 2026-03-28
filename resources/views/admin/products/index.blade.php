<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-gray-900 p-4 rounded-lg shadow-lg border-l-4 border-yellow-400">
            <h2 class="font-bold text-2xl text-white tracking-tight uppercase">
                {{ __('Stock de Suplementos') }}
            </h2>
            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center px-6 py-2 bg-yellow-400 border border-transparent rounded-full font-black text-xs text-black uppercase tracking-widest hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-300 transform hover:scale-105 shadow-md">
                + Añadir Producto
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
                                <th class="px-6 py-5">Producto</th>
                                <th class="px-6 py-5">Precio</th>
                                <th class="px-6 py-5">Categoría / Tipo</th>
                                <th class="px-6 py-5 text-center">Acciones de Inventario</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-900 divide-y divide-gray-800">
                            @foreach($products as $product)
                            <tr class="hover:bg-gray-800 transition-all duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-white uppercase tracking-wide">{{ $product->name }}</div>
                                    <div class="text-xs text-gray-500 italic">ID: #{{ $product->id }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-lg font-black text-yellow-400 font-mono">
                                        ${{ number_format($product->price, 2) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($product->categories as $cat)
                                            <span class="inline-flex items-center px-3 py-1 rounded-md text-[10px] font-black bg-gray-800 text-yellow-500 border border-yellow-500/30 uppercase tracking-tighter">
                                                {{ $cat->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center space-x-4">
                                        <a href="{{ route('admin.products.edit', $product) }}" class="text-white hover:text-black hover:bg-white border border-white/20 px-4 py-1.5 rounded-lg text-xs font-bold transition duration-300 uppercase">
                                            Editar
                                        </a>
                                        
                                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-white hover:bg-red-600 border border-red-500/20 px-4 py-1.5 rounded-lg text-xs font-bold transition duration-300 uppercase" onclick="return confirm('¿Eliminar suplemento del inventario?')">
                                                Baja
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($products->isEmpty())
                    <div class="text-center py-16 bg-gray-900">
                        <svg class="mx-auto h-12 w-12 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 11m8 4V5" />
                        </svg>
                        <p class="mt-4 text-gray-500 font-bold uppercase tracking-widest text-sm">No hay suplementos registrados</p>
                    </div>
                @endif
                
            </div>
            <div class="mt-4 text-right">
                <p class="text-xs text-gray-500 uppercase font-bold tracking-widest">Sistema de Gestión PowerGym v1.0</p>
            </div>
        </div>
    </div>
</x-app-layout>