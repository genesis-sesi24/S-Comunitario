@extends('layouts.admin')

@section('title', 'Gestión de Usuarios')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-display font-bold text-slate-900">Gestión de Usuarios</h1>
    <p class="text-slate-600 mt-1">Administra los usuarios del sistema</p>
</div>

<div class="bg-white rounded-xl border border-slate-200 shadow-sm">
    <!--Header with search and actions -->
    <div class="px-6 py-5 border-b border-slate-200">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex-1 max-w-md">
                <form action="{{ route('users.index') }}" method="GET">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Buscar usuarios..." class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-lb-primary focus:border-transparent">
                        <svg class="absolute left-3 top-2.5 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </form>
            </div>
            <a href="{{ route('users.create') }}" class="inline-flex items-center justify-center gap-2 bg-lb-primary hover:bg-lb-primary-dark text-white font-semibold px-5 py-2.5 rounded-lg transition shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nuevo Usuario
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Usuario</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Rol</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Contacto</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-slate-700 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($users as $user)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-br from-lb-primary to-lb-primary-light flex items-center justify-center text-white font-semibold text-sm">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-slate-900">{{ $user->name }}</p>
                                    <p class="text-xs text-slate-500">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : '' }}
                                {{ $user->role === 'medico' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $user->role === 'secretaria' ? 'bg-amber-100 text-amber-800' : '' }}
                                {{ $user->role === 'paciente' ? 'bg-emerald-100 text-emerald-800' : '' }}">
                                {{ $user->getRoleName() }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">
                            {{ $user->phone ?? 'Sin teléfono' }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                                {{ $user->is_active ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('users.show', $user) }}" class="inline-flex items-center px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-medium rounded-md transition">
                                Ver
                            </a>
                            <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center px-3 py-1.5 bg-lb-primary hover:bg-lb-primary-dark text-white text-xs font-medium rounded-md transition">
                                Editar
                            </a>
                            
                            @if($user->id !== auth()->id())
                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-100 hover:bg-red-200 text-red-700 text-xs font-medium rounded-md transition">
                                        Eliminar
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <svg class="w-12 h-12 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            <p class="text-slate-500">No hay usuarios registrados</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($users->hasPages())
        <div class="px-6 py-4 border-t border-slate-200">
            {{ $users->links() }}
        </div>
    @endif
</div>
@endsection
