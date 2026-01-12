@extends('layouts.admin')

@section('title', 'Crear Usuario')

@section('content')
<div class="bg-white rounded-2xl shadow-sm p-8">
    <h2 class="font-display text-3xl font-bold mb-8">Crear Nuevo Usuario</h2>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="mb-6">
            <label for="name" class="block text-slate-800 font-bold text-sm mb-2">Nombre Completo</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                   class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-lb-primary/10 focus:border-lb-primary transition">
            @error('name')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="email" class="block text-slate-800 font-bold text-sm mb-2">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                   class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-lb-primary/10 focus:border-lb-primary transition">
            @error('email')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password" class="block text-slate-800 font-bold text-sm mb-2">Contraseña</label>
            <input type="password" name="password" id="password" required
                   class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-lb-primary/10 focus:border-lb-primary transition">
            @error('password')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password_confirmation" class="block text-slate-800 font-bold text-sm mb-2">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required
                   class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-lb-primary/10 focus:border-lb-primary transition">
        </div>

        <div class="mb-6">
            <label for="role" class="block text-slate-800 font-bold text-sm mb-2">Rol</label>
            <select name="role" id="role" required
                    class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-lb-primary/10 focus:border-lb-primary transition cursor-pointer">
                <option value="">Selecciona un rol</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
                <option value="medico" {{ old('role') == 'medico' ? 'selected' : '' }}>Médico</option>
                <option value="secretaria" {{ old('role') == 'secretaria' ? 'selected' : '' }}>Secretaria</option>
                <option value="paciente" {{ old('role') == 'paciente' ? 'selected' : '' }}>Paciente</option>
            </select>
            @error('role')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="phone" class="block text-slate-800 font-bold text-sm mb-2">Teléfono (Opcional)</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                   class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-lb-primary/10 focus:border-lb-primary transition">
            @error('phone')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-8">
            <label for="is_active" class="block text-slate-800 font-bold text-sm mb-2">Estado Inicial</label>
            <select name="is_active" id="is_active" required
                    class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-lb-primary/10 focus:border-lb-primary transition cursor-pointer">
                <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="flex-1 bg-gradient-to-r from-lb-primary to-lb-primary-dark hover:shadow-xl text-white font-bold py-3 px-6 rounded-xl transition transform hover:-translate-y-0.5">
                Crear Usuario
            </button>
            <a href="{{ route('users.index') }}" class="flex-1 bg-slate-200 hover:bg-slate-300 text-slate-800 font-bold py-3 px-6 rounded-xl transition text-center">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
