@extends('layouts.admin')

@section('title', 'Galería')
@section('page-title', 'Galería')

@section('content')
<div class="flex items-center justify-between mb-8">
    <p class="text-gray-500 text-sm">{{ $items->total() }} imágenes</p>
    <a href="{{ route('admin.gallery.create') }}" class="admin-btn-primary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Agregar Imagen
    </a>
</div>

<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
    @forelse($items as $item)
    <div class="admin-card p-3 group">
        <div class="aspect-square rounded-lg overflow-hidden bg-cream-100 mb-3">
            <img src="{{ $item->image_url }}" alt="{{ $item->alt ?? $item->caption }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
        </div>
        @if($item->caption)
            <p class="text-xs text-olive-800 font-medium mb-1 line-clamp-2">{{ $item->caption }}</p>
        @endif
        <div class="flex items-center justify-between">
            @if($item->is_active)
                <span class="text-xs text-green-600">Activa</span>
            @else
                <span class="text-xs text-gray-400">Inactiva</span>
            @endif
            <div class="flex gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
                <a href="{{ route('admin.gallery.edit', ['gallery' => $item]) }}"
                   class="p-1.5 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-600 transition-colors"
                   title="Editar">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </a>
                <form method="POST" action="{{ route('admin.gallery.destroy', ['gallery' => $item]) }}"
                      onsubmit="return confirm('¿Eliminar esta imagen?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="p-1.5 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 transition-colors"
                            title="Eliminar">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full py-16 text-center text-gray-400">
        <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <p class="text-sm">No hay imágenes en la galería.</p>
        <a href="{{ route('admin.gallery.create') }}" class="text-olive-800 hover:underline text-sm mt-1 block">Agregar la primera imagen</a>
    </div>
    @endforelse
</div>

@if($items->hasPages())
    <div class="mt-8">{{ $items->links() }}</div>
@endif
@endsection
