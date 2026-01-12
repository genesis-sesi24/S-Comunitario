@extends('layouts.admin')

@section('title', 'Detalles del Usuario')

@section('content')
<div class="bg-white rounded-2xl shadow-sm p-8">
    <h2 class="font-display text-3xl font-bold mb-8">Detalles del Usuario</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="p-6 bg-slate-50 rounded-xl">
            <div class="text-xs font-bold text-slate-600 mb-2">Nombre Completo</div>
            <div class="text-lg font-semibold">{{ $user->name }}</div>
        </div>

        <div class="p-6 bg-slate-50 rounded-xl">
            <div class="text-xs font-bold text-slate-600 mb-2">Email</div>
            <div class="text-lg font-semibold">{{ $user->email }}</div>
        </div>

        <div class="p-6 bg-slate-50 rounded-xl">
            <div class="text-xs font-bold text-slate-600 mb-2">Rol</div>
            <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : '' }}
                {{ $user->role === 'medico' ? 'bg-blue-100 text-blue-800' : '' }}
                {{ $user->role === 'secretaria' ? 'bg-amber-100 text-amber-800' : '' }}
                {{ $user->role === 'paciente' ? 'bg-emerald-100 text-emerald-800' : '' }}">
                {{ $user->getRoleName() }}
            </span>
        </div>

        <div class="p-6 bg-slate-50 rounded-xl">
            <div class="text-xs font-bold text-slate-600 mb-2">Teléfono</div>
            <div class="text-lg font-semibold">{{ $user->phone ?? 'No registrado' }}</div>
        </div>

        <div class="p-6 bg-slate-50 rounded-xl">
            <div class="text-xs font-bold text-slate-600 mb-2">Estado</div>
            <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold {{ $user->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                {{ $user->is_active ? 'Activo' : 'Inactivo' }}
            </span>
        </div>

        <div class="p-6 bg-slate-50 rounded-xl">
            <div class="text-xs font-bold text-slate-600 mb-2">Fecha de Registro</div>
            <div class="text-lg font-semibold">{{ $user->created_at->format('d/m/Y H:i') }}</div>
        </div>
    </div>

    <div class="flex flex-wrap gap-3">
        <a href="{{ route('users.edit', $user) }}" class="px-6 py-3 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl transition">
            Editar Usuario
        </a>
        
        <form action="{{ route('users.toggle-status', $user) }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="px-6 py-3 {{ $user->is_active ? 'bg-amber-500 hover:bg-amber-600' : 'bg-emerald-500 hover:bg-emerald-600' }} text-white font-bold rounded-xl transition">
                {{ $user->is_active ? 'Desactivar' : 'Activar' }}
            </button>
        </form>

        @if($user->id !== auth()->id())
            <form action="{{ route('users.destroy', $user) }}" method="POST" 
                  class="inline"
                  onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-6 py-3 bg-red-500 hover:bg-red-600 text-white font-bold rounded-xl transition">
                    Eliminar
                </button>
            </form>
        @endif

        <a href="{{ route('users.index') }}" class="px-6 py-3 bg-slate-200 hover:bg-slate-300 text-slate-800 font-bold rounded-xl transition">
            Volver a la Lista
        </a>
    </div>
</div>
@endsection
