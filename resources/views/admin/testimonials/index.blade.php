@extends('layouts.admin')
@section('title', 'Testimonios')
@section('page-title', 'Testimonios')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-500">Gestiona los testimonios visibles en la página de inicio.</p>
    <a href="{{ route('admin.testimonials.create') }}" class="admin-btn-primary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Añadir testimonio
    </a>
</div>

<div class="admin-card p-0 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Cliente</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Producto</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Testimonio</th>
                <th class="text-center px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Visible</th>
                <th class="text-right px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($testimonials as $t)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        @if($t->image)
                        <img src="{{ asset('storage/' . $t->image) }}" alt="{{ $t->name }}"
                             class="w-8 h-8 rounded-full object-cover flex-shrink-0">
                        @else
                        <div class="w-8 h-8 rounded-full bg-champagne-100 flex items-center justify-center text-champagne-600 text-xs font-semibold flex-shrink-0">
                            {{ strtoupper(substr($t->name, 0, 1)) }}
                        </div>
                        @endif
                        <p class="font-medium text-gray-900">{{ $t->name }}</p>
                    </div>
                </td>
                <td class="px-6 py-4 text-gray-500">{{ $t->product_name ?? '—' }}</td>
                <td class="px-6 py-4 text-gray-600 max-w-xs">
                    <p class="line-clamp-2 text-xs leading-relaxed">{{ $t->text }}</p>
                </td>
                <td class="px-6 py-4 text-center">
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                                 {{ $t->is_visible ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                        {{ $t->is_visible ? 'Sí' : 'No' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex items-center gap-2 justify-end">
                        <a href="{{ route('admin.testimonials.edit', $t) }}" class="admin-btn-secondary text-xs px-3 py-1.5">Editar</a>
                        <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}"
                              onsubmit="return confirm('¿Eliminar este testimonio?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="admin-btn-danger text-xs px-3 py-1.5">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-12 text-center text-gray-400 text-sm">
                    No hay testimonios añadidos aún.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
