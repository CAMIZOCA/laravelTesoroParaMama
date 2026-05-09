@extends('layouts.admin')
@section('title', 'Embajadoras')
@section('page-title', 'Embajadoras')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <p class="text-sm text-gray-500">Gestiona los códigos de descuento de tus embajadoras.</p>
    </div>
    <a href="{{ route('admin.ambassadors.create') }}" class="admin-btn-primary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Nueva embajadora
    </a>
</div>

<div class="admin-card p-0 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Nombre</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Código</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Descuento</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Estado</th>
                <th class="text-right px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($ambassadors as $ambassador)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4">
                    <p class="font-medium text-gray-900">{{ $ambassador->fullName() }}</p>
                    @if($ambassador->email)
                        <p class="text-xs text-gray-400">{{ $ambassador->email }}</p>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <code class="bg-gray-100 text-gray-700 px-2 py-0.5 rounded text-xs font-mono">
                        {{ $ambassador->code }}
                    </code>
                </td>
                <td class="px-6 py-4 text-gray-600">
                    @if($ambassador->discount_type === 'percent')
                        {{ $ambassador->discount_value }}%
                    @else
                        ${{ number_format($ambassador->discount_value, 2) }}
                    @endif
                </td>
                <td class="px-6 py-4">
                    <form method="POST" action="{{ route('admin.ambassadors.toggle', $ambassador) }}">
                        @csrf
                        <button type="submit"
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium cursor-pointer transition-colors
                                       {{ $ambassador->is_active ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
                            {{ $ambassador->is_active ? 'Activa' : 'Inactiva' }}
                        </button>
                    </form>
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex items-center gap-2 justify-end">
                        <a href="{{ route('admin.ambassadors.report', $ambassador) }}"
                           class="admin-btn-secondary text-xs px-3 py-1.5">
                            Reporte
                        </a>
                        <a href="{{ route('admin.ambassadors.edit', $ambassador) }}"
                           class="admin-btn-secondary text-xs px-3 py-1.5">
                            Editar
                        </a>
                        <form method="POST" action="{{ route('admin.ambassadors.destroy', $ambassador) }}"
                              onsubmit="return confirm('¿Eliminar esta embajadora?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="admin-btn-danger text-xs px-3 py-1.5">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-12 text-center text-gray-400 text-sm">
                    No hay embajadoras registradas.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
