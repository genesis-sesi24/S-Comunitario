@extends('layouts.admin')

@section('title', 'Gestión de Usuarios')

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-6">
    <div>
        <h1 class="text-3xl font-display font-bold text-slate-800">Gestión de Usuarios</h1>
        <p class="text-slate-500 mt-2 text-lg">Administra los accesos, roles y permisos de tu comunidad.</p>
    </div>
    <a href="{{ route('users.create') }}" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-blue-200 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
        Nuevo Usuario
    </a>
</div>

<!-- Filters & Search -->
<div class="mb-10 bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
    <form action="{{ route('users.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4">
        <!-- Search Input -->
        <div class="md:col-span-8 relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-11 pr-4 py-3 border border-slate-200 rounded-xl bg-slate-50 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder="Buscar por nombre o correo electrónico...">
        </div>
        
        <!-- Role Filter -->
        <div class="md:col-span-3 relative">
             <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
            </div>
            <select name="role" class="block w-full pl-10 pr-4 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-600 focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none transition-all cursor-pointer" onchange="this.form.submit()">
                <option value="">Todos los Roles</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Administradores</option>
                <option value="medico" {{ request('role') == 'medico' ? 'selected' : '' }}>Médicos</option>
                <option value="secretaria" {{ request('role') == 'secretaria' ? 'selected' : '' }}>Secretarias</option>
                <option value="paciente" {{ request('role') == 'paciente' ? 'selected' : '' }}>Pacientes</option>
            </select>
            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </div>
        </div>

        <!-- Submit (Hidden but functional for enter key) -->
        <div class="md:col-span-1">
             <button type="submit" class="w-full h-full bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl font-bold transition-colors flex items-center justify-center" title="Aplicar filtros">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
             </button>
        </div>
    </form>
</div>

<!-- Users Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @forelse($users as $user)
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col group overflow-hidden
            {{ $user->role === 'admin' ? 'border-t-4 border-t-slate-600' : '' }}
            {{ $user->role === 'medico' ? 'border-t-4 border-t-blue-600' : '' }}
            {{ $user->role === 'secretaria' ? 'border-t-4 border-t-purple-600' : '' }}
            {{ $user->role === 'paciente' ? 'border-t-4 border-t-teal-500' : '' }}
        ">
            
            <!-- Professional Header -->
            <div class="p-5 flex items-start justify-between border-b border-slate-50">
                <div class="flex gap-4">
                     <!-- Minimal Avatar with Contextual Hover -->
                    <div class="w-12 h-12 rounded-lg bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-700 font-bold text-lg 
                        {{ $user->role === 'admin' ? 'group-hover:bg-slate-100 group-hover:text-slate-800' : '' }}
                        {{ $user->role === 'medico' ? 'group-hover:bg-blue-50 group-hover:text-blue-700' : '' }}
                        {{ $user->role === 'secretaria' ? 'group-hover:bg-purple-50 group-hover:text-purple-700' : '' }}
                        {{ $user->role === 'paciente' ? 'group-hover:bg-teal-50 group-hover:text-teal-700' : '' }}
                        transition-colors duration-300">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900 leading-tight group-hover:text-blue-700 transition-colors">{{ $user->name }}</h3>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mt-1">{{ $user->getRoleName() }}</p>
                    </div>
                </div>
                
                <!-- Status Dot with Tooltip -->
                <div class="flex items-center" title="{{ $user->is_active ? 'Cuenta Activa' : 'Cuenta Inactiva' }}">
                    <span class="relative flex h-3 w-3">
                      @if($user->is_active)
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                      @else
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-slate-300"></span>
                      @endif
                    </span>
                </div>
            </div>

            <!-- Body: Data Grid -->
            <div class="p-5 flex-1">
                <div class="space-y-3">
                    <div class="flex items-center text-sm group/item">
                        <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center mr-3 text-slate-400 group-hover/item:bg-blue-50 group-hover/item:text-blue-500 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <span class="text-slate-600 font-medium truncate" title="{{ $user->email }}">{{Str::limit($user->email, 22)}}</span>
                    </div>
                    
                    <div class="flex items-center text-sm group/item">
                        <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center mr-3 text-slate-400 group-hover/item:bg-blue-50 group-hover/item:text-blue-500 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <span class="text-slate-600 font-medium">{{ $user->phone ?? '---' }}</span>
                    </div>
                </div>
            </div>

            <!-- Footer: 3 Actions -->
            <div class="px-2 py-3 border-t border-slate-100 grid grid-cols-3 gap-1 bg-slate-50/50">
                <a href="{{ route('users.show', $user) }}" class="inline-flex flex-col justify-center items-center py-2 rounded-lg text-xs font-semibold text-slate-500 hover:text-blue-700 hover:bg-white hover:shadow-sm transition-all group/btn" title="Ver Detalles">
                    <svg class="w-5 h-5 mb-1 text-slate-400 group-hover/btn:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    Ver
                </a>

                 <a href="{{ route('users.edit', $user) }}" class="inline-flex flex-col justify-center items-center py-2 rounded-lg text-xs font-semibold text-slate-500 hover:text-indigo-700 hover:bg-white hover:shadow-sm transition-all group/btn" title="Editar Usuario">
                    <svg class="w-5 h-5 mb-1 text-slate-400 group-hover/btn:text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Editar
                </a>
                
                @if($user->id !== auth()->id())
                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="w-full" onsubmit="return confirm('⚠️ ¿Eliminar a {{ $user->name }}?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex flex-col justify-center items-center py-2 rounded-lg text-xs font-semibold text-slate-500 hover:text-rose-700 hover:bg-white hover:shadow-sm transition-all group/btn" title="Eliminar Usuario">
                            <svg class="w-5 h-5 mb-1 text-slate-400 group-hover/btn:text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Eliminar
                        </button>
                    </form>
                @else
                    <button disabled class="w-full inline-flex flex-col justify-center items-center py-2 rounded-lg text-xs font-semibold text-slate-300 cursor-not-allowed">
                        <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        Bloqueado
                    </button>
                @endif
            </div>
        </div>
    @empty
        <div class="col-span-full flex flex-col items-center justify-center py-24 px-4 text-center">
            <div class="bg-slate-50 p-6 rounded-full mb-6">
                <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <h3 class="text-lg font-bold text-slate-900 mb-1">Sin resultados</h3>
            <p class="text-slate-500 text-sm mb-6">No se encontraron usuarios con esos criterios.</p>
            <a href="{{ route('users.index') }}" class="px-5 py-2.5 bg-white border border-slate-300 text-slate-700 font-semibold rounded-lg hover:bg-slate-50 transition-colors text-sm">
                Limpiar Filtros
            </a>
        </div>
    @endforelse
</div>

<div class="mt-12">
    {{ $users->links() }}
</div>
@endsection
