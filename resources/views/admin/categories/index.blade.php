@extends('layouts.admin')

@section('title', 'Categorías')
@section('page-title', 'Categorías')

@section('content')
<div class="flex items-center justify-between mb-8">
    <p class="text-gray-500 text-sm">{{ $categories->total() }} categorías</p>
    <a href="{{ route('admin.categories.create') }}" class="admin-btn-primary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Nueva Categoría
    </a>
</div>

<div class="admin-card">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-100">
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide pb-3 pr-4">Nombre</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide pb-3 pr-4">Productos</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide pb-3 pr-4">Orden</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide pb-3 pr-4">Estado</th>
                    <th class="pb-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($categories as $category)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="py-4 pr-4">
                        <p class="font-medium text-olive-900">{{ $category->name }}</p>
                        @if($category->description)
                            <p class="text-xs text-gray-500 mt-0.5">{{ $category->description }}</p>
                        @endif
                    </td>
                    <td class="py-4 pr-4">
                        <span class="text-sm text-gray-600">{{ $category->products_count }}</span>
                    </td>
                    <td class="py-4 pr-4">
                        <span class="text-sm text-gray-600">{{ $category->order }}</span>
                    </td>
                    <td class="py-4 pr-4">
                        @if($category->is_active)
                            <span class="inline-flex items-center gap-1 text-xs font-medium text-green-700 bg-green-50 px-2.5 py-1 rounded-full">
                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>Activa
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 text-xs font-medium text-gray-500 bg-gray-100 px-2.5 py-1 rounded-full">
                                <span class="w-1.5 h-1.5 bg-gray-400 rounded-full"></span>Inactiva
                            </span>
                        @endif
                    </td>
                    <td class="py-4">
                        <div class="flex items-center gap-2 justify-end">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="admin-btn-secondary py-1.5 px-3 text-xs">Editar</a>
                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                                  onsubmit="return confirm('¿Eliminar esta categoría?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="admin-btn-danger py-1.5 px-3 text-xs">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-12 text-center text-gray-400 text-sm">
                        No hay categorías. <a href="{{ route('admin.categories.create') }}" class="text-olive-800 hover:underline">Crea la primera</a>.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($categories->hasPages())
        <div class="mt-6 border-t border-gray-100 pt-6">{{ $categories->links() }}</div>
    @endif
</div>
@endsection
