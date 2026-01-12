@extends('layouts.admin')

@section('title', 'Editar Usuario')

@section('content')
<div class="bg-white rounded-2xl shadow-sm p-8">
    <h2 class="font-display text-3xl font-bold mb-8">Editar Usuario</h2>

    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label for="name" class="block text-slate-800 font-bold text-sm mb-2">Nombre Completo</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                   class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-lb-primary/10 focus:border-lb-primary transition">
            @error('name')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="email" class="block text-slate-800 font-bold text-sm mb-2">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                   class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-lb-primary/10 focus:border-lb-primary transition">
            @error('email')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password" class="block text-slate-800 font-bold text-sm mb-2">Nueva Contraseña (Opcional)</label>
            <input type="password" name="password" id="password"
                   class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-lb-primary/10 focus:border-lb-primary transition">
            <span class="text-slate-600 text-xs mt-1 block">Dejar en blanco para mantener la contraseña actual</span>
            @error('password')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password_confirmation" class="block text-slate-800 font-bold text-sm mb-2">Confirmar Nueva Contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                   class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-lb-primary/10 focus:border-lb-primary transition">
        </div>

        <div class="mb-6">
            <label for="role" class="block text-slate-800 font-bold text-sm mb-2">Rol</label>
            <select name="role" id="role" required
                    class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-lb-primary/10 focus:border-lb-primary transition cursor-pointer">
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrador</option>
                <option value="medico" {{ old('role', $user->role) == 'medico' ? 'selected' : '' }}>Médico</option>
                <option value="secretaria" {{ old('role', $user->role) == 'secretaria' ? 'selected' : '' }}>Secretaria</option>
                <option value="paciente" {{ old('role', $user->role) == 'paciente' ? 'selected' : '' }}>Paciente</option>
            </select>
            @error('role')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="phone" class="block text-slate-800 font-bold text-sm mb-2">Teléfono (Opcional)</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                   class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-lb-primary/10 focus:border-lb-primary transition">
            @error('phone')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-8">
            <label for="is_active" class="block text-slate-800 font-bold text-sm mb-2">Estado de la Cuenta</label>
            <select name="is_active" id="is_active" required
                    class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-lb-primary/10 focus:border-lb-primary transition cursor-pointer">
                <option value="1" {{ old('is_active', $user->is_active) == '1' ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ old('is_active', $user->is_active) == '0' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="flex-1 bg-gradient-to-r from-lb-primary to-lb-primary-dark hover:shadow-xl text-white font-bold py-3 px-6 rounded-xl transition transform hover:-translate-y-0.5">
                Actualizar Usuario
            </button>
            <a href="{{ route('users.index') }}" class="flex-1 bg-slate-200 hover:bg-slate-300 text-slate-800 font-bold py-3 px-6 rounded-xl transition text-center">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
