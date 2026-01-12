@extends('layouts.admin')

@section('title', 'Gestión de Usuarios')

@section('content')
<div class="bg-white rounded-2xl shadow-sm p-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <h2 class="font-display text-3xl font-bold mb-4 md:mb-0">Gestión de Usuarios</h2>
        <a href="{{ route('users.create') }}" class="inline-flex items-center justify-center bg-gradient-to-r from-lb-primary to-lb-primary-dark hover:shadow-xl text-white font-bold py-3 px-6 rounded-xl transition transform hover:-translate-y-0.5">
            + Nuevo Usuario
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Rol</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Teléfono</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($users as $user)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4 text-sm text-slate-900">{{ $user->id }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : '' }}
                                {{ $user->role === 'medico' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $user->role === 'secretaria' ? 'bg-amber-100 text-amber-800' : '' }}
                                {{ $user->role === 'paciente' ? 'bg-emerald-100 text-emerald-800' : '' }}">
                                {{ $user->getRoleName() }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $user->phone ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $user->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                                {{ $user->is_active ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-2">
                                <a href="{{ route('users.show', $user) }}" class="px-3 py-1 bg-lb-primary hover:bg-lb-primary-dark text-white text-xs font-semibold rounded-lg transition">Ver</a>
                                <a href="{{ route('users.edit', $user) }}" class="px-3 py-1 bg-amber-500 hover:bg-amber-600 text-white text-xs font-semibold rounded-lg transition">Editar</a>
                                
                                <form action="{{ route('users.toggle-status', $user) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 {{ $user->is_active ? 'bg-amber-500 hover:bg-amber-600' : 'bg-emerald-500 hover:bg-emerald-600' }} text-white text-xs font-semibold rounded-lg transition">
                                        {{ $user->is_active ? 'Desactivar' : 'Activar' }}
                                    </button>
                                </form>

                                @if($user->id !== auth()->id())
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" 
                                          class="inline"
                                          onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-xs font-semibold rounded-lg transition">Eliminar</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-slate-500">
                            No hay usuarios registrados
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>
@endsection
