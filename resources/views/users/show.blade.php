@extends('layouts.admin')

@section('title', 'Detalles del Usuario')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Header with Back Link -->
    <div class="mb-8">
        <a href="{{ route('users.index') }}" class="flex items-center text-sm text-slate-500 hover:text-slate-800 transition-colors mb-4 group w-fit">
            <div class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center mr-2 shadow-sm group-hover:border-slate-300 transition-all">
                <svg class="w-4 h-4 text-slate-400 group-hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </div>
            <span class="font-medium">Volver a usuarios</span>
        </a>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Column: Identity Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden sticky top-24">
                <div class="h-32 theme-bg-gradient opacity-90" style="background: linear-gradient(135deg, var(--theme-color) 0%, var(--theme-color-dark) 100%);"></div>
                <div class="px-8 pb-8 text-center -mt-16">
                    <div class="w-32 h-32 rounded-2xl bg-white p-1.5 mx-auto shadow-xl mb-4">
                        <div class="w-full h-full rounded-xl flex items-center justify-center text-white font-display font-bold text-4xl theme-bg overflow-hidden" style="background-color: var(--theme-color);">
                            @if($user->getAvatarUrl())
                                <img src="{{ $user->getAvatarUrl() }}" class="w-full h-full object-cover" alt="{{ $user->name }}">
                            @else
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            @endif
                        </div>
                    </div>
                    <h1 class="text-2xl font-bold text-slate-900 leading-tight mb-1">{{ $user->name }}</h1>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wide bg-slate-100 text-slate-600">
                        {{ $user->getRoleName() }}
                    </span>

                    <div class="mt-8 flex flex-col gap-3">
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Estado</span>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-bold {{ $user->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $user->is_active ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                                {{ $user->is_active ? 'ACTIVO' : 'INACTIVO' }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Registro</span>
                            <span class="text-sm font-semibold text-slate-700">{{ $user->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Details & Actions -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Information Card -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
                <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2 mb-6">
                    <span class="w-1 h-6 rounded-full theme-bg" style="background-color: var(--theme-color);"></span>
                    Información de Contacto
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-8">
                    <div>
                        <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Correo Electrónico</span>
                        <div class="flex items-center gap-3 text-slate-700">
                            <div class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <span class="font-medium class-truncate">{{ $user->email }}</span>
                        </div>
                    </div>

                    <div>
                        <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Teléfono</span>
                        <div class="flex items-center gap-3 text-slate-700">
                            <div class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <span class="font-medium">{{ $user->phone ?? 'No registrado' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions Card -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                <div class="flex flex-wrap items-center justify-end gap-3">
                    
                    <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center px-4 py-2 bg-white border border-slate-300 rounded-xl font-semibold text-slate-700 hover:bg-slate-50 hover:border-slate-400 transition-all text-sm group">
                        <svg class="w-4 h-4 mr-2 text-slate-400 group-hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Editar
                    </a>

                    <form action="{{ route('users.toggle-status', $user) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 rounded-xl font-semibold transition-all text-sm text-white shadow-md hover:shadow-lg hover:-translate-y-0.5 {{ $user->is_active ? 'bg-amber-500 hover:bg-amber-600' : 'bg-emerald-500 hover:bg-emerald-600' }}">
                            @if($user->is_active)
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                                Desactivar Acceso
                            @else
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Activar Acceso
                            @endif
                        </button>
                    </form>

                    @if($user->id !== auth()->id())
                        <button type="button" onclick="openModal('deleteUserModal-{{ $user->id }}')" class="inline-flex items-center px-4 py-2 bg-white border border-red-200 text-red-600 rounded-xl font-semibold hover:bg-red-50 hover:border-red-300 transition-all text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Eliminar
                        </button>

                        <x-confirm-modal 
                            id="deleteUserModal-{{ $user->id }}" 
                            title="¿Eliminar Usuario?" 
                            message="Esta acción eliminará permanentemente al usuario {{ $user->name }}. No se puede deshacer." 
                            action="{{ route('users.destroy', $user) }}" 
                            confirmText="Eliminar Usuario"
                        />
                    @endif

                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
