@extends('layouts.admin')

@section('title', 'Editar Usuario')

@section('content')
<div class="max-w-4xl mx-auto">
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
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white shadow-lg theme-bg-gradient" style="background-color: var(--theme-color);">
                @if($user->getAvatarUrl())
                    <img src="{{ $user->getAvatarUrl() }}" class="w-full h-full rounded-xl object-cover">
                @else
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                @endif
            </div>
            <div>
                <h1 class="text-3xl font-display font-bold text-slate-900">Editar Usuario</h1>
                <p class="mt-1 text-slate-500">Actualice la información y permisos de {{ $user->name }}.</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="p-8 space-y-8">
                <!-- Sección: Información Personal -->
                <div>
                    <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2 mb-6">
                        <span class="w-1 h-6 rounded-full theme-bg" style="background-color: var(--theme-color);"></span>
                        Información de Perfil
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nombre -->
                        <div class="md:col-span-2">
                            <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Nombre Completo <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 transition-all text-sm"
                                style="--tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent); border-color: transparent;"
                                onfocus="this.style.borderColor = 'var(--theme-color)'"
                                onblur="this.style.borderColor = 'transparent'">
                            @error('name')
                                <p class="mt-1 text-xs font-medium text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Correo Electrónico <span class="text-red-500">*</span></label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 transition-all text-sm"
                                style="--tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent); border-color: transparent;"
                                onfocus="this.style.borderColor = 'var(--theme-color)'"
                                onblur="this.style.borderColor = 'transparent'">
                            @error('email')
                                <p class="mt-1 text-xs font-medium text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Teléfono -->
                        <div>
                            <label for="phone" class="block text-sm font-bold text-slate-700 mb-2">Teléfono (Opcional)</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 transition-all text-sm"
                                style="--tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent); border-color: transparent;"
                                onfocus="this.style.borderColor = 'var(--theme-color)'"
                                onblur="this.style.borderColor = 'transparent'">
                            @error('phone')
                                <p class="mt-1 text-xs font-medium text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Sección: Seguridad -->
                <div class="pt-6 border-t border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2 mb-2">
                        <span class="w-1 h-6 rounded-full theme-bg" style="background-color: var(--theme-color);"></span>
                        Seguridad
                    </h3>
                    <p class="text-sm text-slate-500 mb-6 font-medium">Complete solo si desea cambiar la contraseña del usuario.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-bold text-slate-700 mb-2">Nueva Contraseña</label>
                            <input type="password" name="password" id="password"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 transition-all text-sm"
                                style="--tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent); border-color: transparent;"
                                onfocus="this.style.borderColor = 'var(--theme-color)'"
                                onblur="this.style.borderColor = 'transparent'"
                                placeholder="••••••••">
                            @error('password')
                                <p class="mt-1 text-xs font-medium text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-bold text-slate-700 mb-2">Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 transition-all text-sm"
                                style="--tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent); border-color: transparent;"
                                onfocus="this.style.borderColor = 'var(--theme-color)'"
                                onblur="this.style.borderColor = 'transparent'"
                                placeholder="••••••••">
                        </div>
                    </div>
                </div>

                <!-- Sección: Gestión de Acceso -->
                <div class="pt-6 border-t border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2 mb-6">
                        <span class="w-1 h-6 rounded-full theme-bg" style="background-color: var(--theme-color);"></span>
                        Gestión de Acceso
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Rol -->
                        <div>
                            <label for="role" class="block text-sm font-bold text-slate-700 mb-2">Rol Asignado <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select name="role" id="role" required
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 transition-all text-sm appearance-none cursor-pointer"
                                    style="--tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent); border-color: transparent;"
                                    onfocus="this.style.borderColor = 'var(--theme-color)'"
                                    onblur="this.style.borderColor = 'transparent'">
                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrador</option>
                                    <option value="medico" {{ old('role', $user->role) == 'medico' ? 'selected' : '' }}>Médico</option>
                                    <option value="secretaria" {{ old('role', $user->role) == 'secretaria' ? 'selected' : '' }}>Secretaria</option>
                                    <option value="paciente" {{ old('role', $user->role) == 'paciente' ? 'selected' : '' }}>Paciente</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                            </div>
                            @error('role')
                                <p class="mt-1 text-xs font-medium text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Estado -->
                        <div>
                            <label for="is_active" class="block text-sm font-bold text-slate-700 mb-2">Estado de la Cuenta <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select name="is_active" id="is_active" required
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 transition-all text-sm appearance-none cursor-pointer"
                                    style="--tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent); border-color: transparent;"
                                    onfocus="this.style.borderColor = 'var(--theme-color)'"
                                    onblur="this.style.borderColor = 'transparent'">
                                    <option value="1" {{ old('is_active', $user->is_active) == '1' ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ old('is_active', $user->is_active) == '0' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="px-8 py-6 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-4">
                <a href="{{ route('users.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 font-semibold hover:bg-white hover:shadow-sm transition-all text-sm">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-2.5 text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-2 theme-bg-gradient" 
                        style="background-color: var(--theme-color); box-shadow: 0 4px 14px color-mix(in srgb, var(--theme-color) 25%, transparent);">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Actualizar Usuario
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
