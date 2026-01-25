@extends('layouts.admin')

@section('title', 'Crear Usuario')

@section('content')
<div class="max-w-4xl mx-auto">
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
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-display font-bold text-slate-900">Crear Nuevo Usuario</h1>
                <p class="mt-1 text-slate-500">Registre un nuevo miembro con acceso al sistema.</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            
            <div class="p-8 space-y-8">
                <!-- Sección: Credenciales -->
                <div>
                    <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2 mb-6">
                        <span class="w-1 h-6 rounded-full theme-bg" style="background-color: var(--theme-color);"></span>
                        Información de Cuenta
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nombre -->
                        <div class="md:col-span-2">
                            <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Nombre Completo <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 transition-all text-sm"
                                style="--tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent); border-color: transparent;"
                                onfocus="this.style.borderColor = 'var(--theme-color)'"
                                onblur="this.style.borderColor = 'transparent'"
                                placeholder="Ej. Juan Pérez">
                            @error('name')
                                <p class="mt-1 text-xs font-medium text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="md:col-span-1">
                            <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Correo Electrónico <span class="text-red-500">*</span></label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 transition-all text-sm"
                                style="--tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent); border-color: transparent;"
                                onfocus="this.style.borderColor = 'var(--theme-color)'"
                                onblur="this.style.borderColor = 'transparent'"
                                placeholder="juan@ejemplo.com">
                            @error('email')
                                <p class="mt-1 text-xs font-medium text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Teléfono -->
                        <div class="md:col-span-1">
                            <label for="phone" class="block text-sm font-bold text-slate-700 mb-2">Teléfono (Opcional)</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 transition-all text-sm"
                                style="--tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent); border-color: transparent;"
                                onfocus="this.style.borderColor = 'var(--theme-color)'"
                                onblur="this.style.borderColor = 'transparent'"
                                placeholder="Ej. 0412-1234567">
                            @error('phone')
                                <p class="mt-1 text-xs font-medium text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-bold text-slate-700 mb-2">Contraseña <span class="text-red-500">*</span></label>
                            <input type="password" name="password" id="password" required
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
                            <label for="password_confirmation" class="block text-sm font-bold text-slate-700 mb-2">Confirmar Contraseña <span class="text-red-500">*</span></label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 transition-all text-sm"
                                style="--tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent); border-color: transparent;"
                                onfocus="this.style.borderColor = 'var(--theme-color)'"
                                onblur="this.style.borderColor = 'transparent'"
                                placeholder="••••••••">
                        </div>
                    </div>
                </div>

                <!-- Sección: Roles y Permisos -->
                <div class="pt-6 border-t border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2 mb-6">
                        <span class="w-1 h-6 rounded-full theme-bg" style="background-color: var(--theme-color);"></span>
                        Roles y Estado
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
                                    <option value="">Selecciona un rol</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
                                    <option value="medico" {{ old('role') == 'medico' ? 'selected' : '' }}>Médico</option>
                                    <option value="secretaria" {{ old('role') == 'secretaria' ? 'selected' : '' }}>Secretaria</option>
                                    <option value="paciente" {{ old('role') == 'paciente' ? 'selected' : '' }}>Paciente</option>
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
                            <label for="is_active" class="block text-sm font-bold text-slate-700 mb-2">Estado Inicial <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select name="is_active" id="is_active" required
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 transition-all text-sm appearance-none cursor-pointer"
                                    style="--tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent); border-color: transparent;"
                                    onfocus="this.style.borderColor = 'var(--theme-color)'"
                                    onblur="this.style.borderColor = 'transparent'">
                                    <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactivo</option>
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
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                    Crear Usuario
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
