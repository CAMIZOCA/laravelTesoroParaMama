@extends('layouts.admin')

@section('title', 'Productos')
@section('page-title', 'Productos')

@section('content')
<div class="flex items-center justify-between mb-8">
    <div>
        <p class="text-gray-500 text-sm">{{ $products->total() }} productos registrados</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="admin-btn-primary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Nuevo Producto
    </a>
</div>

<div class="admin-card">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-100">
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide pb-3 pr-4">Producto</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide pb-3 pr-4">Categoría</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide pb-3 pr-4">Precio</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide pb-3 pr-4">Estado</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide pb-3 pr-4">Destacado</th>
                    <th class="pb-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($products as $product)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="py-4 pr-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl overflow-hidden bg-cream-100 flex-shrink-0">
                                <img src="{{ $product->image_url }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p class="font-medium text-olive-900 text-sm">{{ $product->name }}</p>
                                @if($product->short_description)
                                    <p class="text-xs text-gray-500 mt-0.5 line-clamp-1">{{ $product->short_description }}</p>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="py-4 pr-4">
                        <span class="text-sm text-gray-600">{{ $product->category?->name ?? '—' }}</span>
                    </td>
                    <td class="py-4 pr-4">
                        <div>
                            <span class="font-semibold text-olive-900 text-sm">${{ number_format($product->price, 2) }}</span>
                            @if($product->hasDiscount())
                                <span class="text-xs text-gray-400 line-through block">${{ number_format($product->original_price, 2) }}</span>
                            @endif
                        </div>
                    </td>
                    <td class="py-4 pr-4">
                        @if($product->is_active)
                            <span class="inline-flex items-center gap-1 text-xs font-medium text-green-700 bg-green-50 px-2.5 py-1 rounded-full">
                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                Activo
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 text-xs font-medium text-gray-500 bg-gray-100 px-2.5 py-1 rounded-full">
                                <span class="w-1.5 h-1.5 bg-gray-400 rounded-full"></span>
                                Inactivo
                            </span>
                        @endif
                    </td>
                    <td class="py-4 pr-4">
                        @if($product->is_featured)
                            <span class="text-gold-400">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </span>
                        @else
                            <span class="text-gray-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </span>
                        @endif
                    </td>
                    <td class="py-4">
                        <div class="flex items-center gap-2 justify-end">
                            <a href="{{ route('admin.products.edit', $product) }}"
                               class="admin-btn-secondary py-1.5 px-3 text-xs">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Editar
                            </a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                                  onsubmit="return confirm('¿Eliminar este producto?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="admin-btn-danger py-1.5 px-3 text-xs">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-16 text-center">
                        <div class="flex flex-col items-center gap-3 text-gray-400">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                            <p class="text-sm">No hay productos registrados</p>
                            <a href="{{ route('admin.products.create') }}" class="admin-btn-primary mt-2">Crear primer producto</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
    <div class="mt-6 border-t border-gray-100 pt-6">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection
