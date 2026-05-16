@extends('layouts.admin')

@section('title', 'Embajadoras')
@section('page-title', 'Embajadoras')

@section('content')

@if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 rounded-xl px-5 py-4 text-sm">
        {{ session('success') }}
    </div>
@endif

{{-- Filters --}}
<div class="admin-card mb-6">
    <form method="GET" action="{{ route('admin.ambassadors.index') }}" class="flex flex-wrap gap-3 items-end">
        <div class="flex-1 min-w-48">
            <label class="form-label">Buscar</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Nombre, código o email..."
                   class="form-input">
        </div>
        <div>
            <label class="form-label">Estado</label>
            <select name="status" class="form-input w-36">
                <option value="">Todos</option>
                <option value="active"   {{ request('status') === 'active'   ? 'selected' : '' }}>Activo</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
        <button type="submit" class="admin-btn-primary px-5 py-2">Filtrar</button>
        @if(request('search') || request('status'))
            <a href="{{ route('admin.ambassadors.index') }}" class="admin-btn-secondary px-4 py-2">Limpiar</a>
        @endif
        <a href="{{ route('admin.ambassadors.create') }}" class="admin-btn-primary px-5 py-2 ml-auto">
            + Nueva embajadora
        </a>
    </form>
</div>

{{-- Table --}}
<div class="admin-card p-0 overflow-hidden">
    @if($ambassadors->isEmpty())
        <div class="text-center py-16">
            <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <p class="text-gray-400 font-medium">No hay embajadoras con estos criterios.</p>
            <a href="{{ route('admin.ambassadors.create') }}" class="admin-btn-primary px-5 py-2 mt-4 inline-flex">
                + Crear primera embajadora
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="text-left font-medium text-gray-500 px-5 py-3.5">Embajadora</th>
                        <th class="text-left font-medium text-gray-500 px-4 py-3.5">Código</th>
                        <th class="text-left font-medium text-gray-500 px-4 py-3.5">Descuento</th>
                        <th class="text-center font-medium text-gray-500 px-4 py-3.5">Estado</th>
                        <th class="px-4 py-3.5"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($ambassadors as $ambassador)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-5 py-4">
                            <p class="font-semibold text-olive-900">{{ $ambassador->name }} {{ $ambassador->last_name }}</p>
                            @if($ambassador->email)
                                <p class="text-xs text-gray-400">{{ $ambassador->email }}</p>
                            @endif
                        </td>
                        <td class="px-4 py-4">
                            <span class="font-mono font-semibold text-olive-800 bg-cream-50 border border-cream-200 rounded px-2 py-0.5 text-xs">
                                {{ $ambassador->code }}
                            </span>
                        </td>
                        <td class="px-4 py-4 text-olive-700">
                            {{ $ambassador->discountLabel() }}
                        </td>
                        <td class="px-4 py-4 text-center">
                            @if($ambassador->status === 'active')
                                <span class="inline-block px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Activo</span>
                            @else
                                <span class="inline-block px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-500">Inactivo</span>
                            @endif
                        </td>
                        <td class="px-4 py-4 flex items-center gap-2 justify-end">
                            <a href="{{ route('admin.ambassadors.edit', $ambassador) }}" class="admin-btn-secondary px-3 py-1.5 text-xs">
                                Editar
                            </a>
                            <form method="POST" action="{{ route('admin.ambassadors.destroy', $ambassador) }}"
                                  onsubmit="return confirm('¿Eliminar esta embajadora?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 text-xs rounded-lg border border-red-200 text-red-500 hover:bg-red-50 transition-colors">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-5 py-4 border-t border-gray-100">
            {{ $ambassadors->links() }}
        </div>
    @endif
</div>
@endsection
