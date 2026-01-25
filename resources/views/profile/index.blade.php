@extends('layouts.admin')

@section('title', 'Mi Perfil')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    
    {{-- Profile Header Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="h-32 theme-bg-gradient relative">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="absolute -bottom-16 left-8 flex items-end gap-6">
                <div class="relative group">
                    @if(auth()->user()->getAvatarUrl())
                        <img src="{{ auth()->user()->getAvatarUrl() }}" alt="Avatar" class="w-32 h-32 rounded-2xl border-4 border-white shadow-xl object-cover">
                    @else
                        <div class="w-32 h-32 rounded-2xl border-4 border-white shadow-xl bg-white flex items-center justify-center">
                            <span class="text-4xl font-bold theme-text">{{ auth()->user()->getInitials() }}</span>
                        </div>
                    @endif
                    <button onclick="document.getElementById('avatarInput').click()" class="absolute inset-0 bg-black/60 rounded-2xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </button>
                    <form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data" id="avatarForm" class="hidden">
                        @csrf
                        <input type="file" name="avatar" id="avatarInput" accept="image/*" onchange="document.getElementById('avatarForm').submit()">
                    </form>
                </div>
            </div>
        </div>
        <div class="pt-20 pb-6 px-8">
            <h1 class="text-3xl font-display font-bold text-slate-800">{{ auth()->user()->name }} {{ auth()->user()->apellido }}</h1>
            <p class="text-slate-500 mt-1">{{ auth()->user()->getRoleName() }} • {{ auth()->user()->email }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- Personal Information --}}
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl font-display font-bold text-slate-800">Información Personal</h2>
                    <p class="text-sm text-slate-500 mt-1">Actualiza tus datos básicos</p>
                </div>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background-color: color-mix(in srgb, var(--theme-color) 10%, white);">
                    <svg class="w-6 h-6 theme-text" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
            </div>

            <form action="{{ route('profile.update') }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Nombre</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all text-sm">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Apellido</label>
                        <input type="text" name="apellido" value="{{ old('apellido', auth()->user()->apellido) }}"
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all text-sm">
                        @error('apellido')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Correo Electrónico</label>
                    <input type="email" value="{{ auth()->user()->email }}" readonly
                           class="w-full px-4 py-3 bg-slate-100 border border-slate-200 rounded-xl text-sm text-slate-600 cursor-not-allowed">
                    <p class="text-xs text-slate-400 mt-1">El correo electrónico no puede ser modificado</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Teléfono</label>
                    <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all text-sm">
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="px-6 py-3 theme-bg-gradient text-white font-semibold rounded-xl hover:shadow-lg transition-all flex items-center gap-2" style="box-shadow: 0 0 20px color-mix(in srgb, var(--theme-color) 30%, transparent);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>

        {{-- Theme Personalization --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-lg font-display font-bold text-slate-800">Personalización</h2>
                    <p class="text-xs text-slate-500 mt-1">Elige tu color</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                </div>
            </div>

            <form action="{{ route('profile.theme') }}" method="POST" id="themeForm">
                @csrf
                <input type="hidden" name="theme_color" id="selectedColor" value="{{ auth()->user()->getThemeColor() }}">
                
                <p class="text-sm text-slate-600 mb-4">Color actual:</p>
                <div class="flex items-center gap-3 mb-6 p-3 bg-slate-50 rounded-xl border border-slate-200">
                    <div class="w-12 h-12 rounded-lg shadow-inner" style="background-color: {{ auth()->user()->getThemeColor() }};"></div>
                    <span class="font-mono text-sm font-semibold text-slate-700">{{ auth()->user()->getThemeColor() }}</span>
                </div>

                <p class="text-sm font-semibold text-slate-700 mb-3">Paleta Premium:</p>
                <div class="grid grid-cols-4 gap-3">
                    @php
                    $colors = [
                        ['name' => 'Teal', 'hex' => '#0d9488'],
                        ['name' => 'Cyan', 'hex' => '#0891b2'],
                        ['name' => 'Blue', 'hex' => '#2563eb'],
                        ['name' => 'Indigo', 'hex' => '#4f46e5'],
                        ['name' => 'Purple', 'hex' => '#7c3aed'],
                        ['name' => 'Pink', 'hex' => '#db2777'],
                        ['name' => 'Rose', 'hex' => '#e11d48'],
                        ['name' => 'Orange', 'hex' => '#ea580c'],
                        ['name' => 'Amber', 'hex' => '#d97706'],
                        ['name' => 'Emerald', 'hex' => '#059669'],
                        ['name' => 'Green', 'hex' => '#16a34a'],
                        ['name' => 'Slate', 'hex' => '#475569'],
                    ];
                    @endphp

                    @foreach($colors as $color)
                        <button type="button" 
                                onclick="selectColor('{{ $color['hex'] }}')"
                                class="color-option group relative w-full aspect-square rounded-xl shadow-md hover:shadow-lg hover:scale-110 transition-all"
                                style="background-color: {{ $color['hex'] }};"
                                title="{{ $color['name'] }}">
                            <span class="absolute inset-0 rounded-xl bg-black/0 group-hover:bg-black/10 transition-colors flex items-center justify-center">
                                <svg class="w-6 h-6 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            </span>
                        </button>
                    @endforeach
                </div>

                <button type="submit" class="w-full mt-6 px-4 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-purple-500/30 transition-all flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    Aplicar Tema
                </button>
            </form>
        </div>

    </div>

    {{-- Security Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        {{-- Change Password --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl font-display font-bold text-slate-800">Cambiar Contraseña</h2>
                    <p class="text-sm text-slate-500 mt-1">Actualiza tu contraseña de acceso</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-rose-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
            </div>

            <form action="{{ route('profile.password') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Contraseña Actual</label>
                    <input type="password" name="current_password" required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 transition-all text-sm" style="border-color: var(--theme-color); --tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent);">
                    @error('current_password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nueva Contraseña</label>
                    <input type="password" name="new_password" required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 transition-all text-sm" style="border-color: var(--theme-color); --tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent);">
                    <p class="text-xs text-slate-400 mt-1">Mínimo 8 caracteres</p>
                    @error('new_password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Confirmar Nueva Contraseña</label>
                    <input type="password" name="new_password_confirmation" required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 transition-all text-sm" style="border-color: var(--theme-color); --tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent);">
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="px-6 py-3 bg-rose-600 hover:bg-rose-700 text-white font-semibold rounded-xl hover:shadow-lg transition-all flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                        Cambiar Contraseña
                    </button>
                </div>
            </form>
        </div>

        {{-- Security Question --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl font-display font-bold text-slate-800">Pregunta de Seguridad</h2>
                    <p class="text-sm text-slate-500 mt-1">Para recuperar tu contraseña</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
            </div>

            <form action="{{ route('profile.security') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Pregunta</label>
                    <select name="security_question_id" required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 transition-all text-sm appearance-none" style="border-color: var(--theme-color); --tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent);">
                        <option value="">Selecciona una pregunta</option>
                        @foreach($securityQuestions as $question)
                            <option value="{{ $question->id }}" {{ auth()->user()->securityAnswer && auth()->user()->securityAnswer->security_question_id == $question->id ? 'selected' : '' }}>
                                {{ $question->question }}
                            </option>
                        @endforeach
                    </select>
                    @error('security_question_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Respuesta</label>
                    <input type="text" name="security_answer" required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 transition-all text-sm" style="border-color: var(--theme-color); --tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent);" 
                           placeholder="Tu respuesta (case-insensitive)">
                    <p class="text-xs text-slate-400 mt-1">La respuesta no distingue mayúsculas/minúsculas</p>
                    @error('security_answer')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                @if(auth()->user()->securityAnswer)
                    <div class="p-3 bg-emerald-50 rounded-xl border border-emerald-100 flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-xs text-emerald-700 font-medium">Tienes una pregunta de seguridad configurada</p>
                    </div>
                @else
                    <div class="p-3 bg-amber-50 rounded-xl border border-amber-100 flex items-center gap-2">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        <p class="text-xs text-amber-700 font-medium">Aún no tienes pregunta de seguridad</p>
                    </div>
                @endif

                <div class="flex justify-end pt-4">
                    <button type="submit" class="px-6 py-3 bg-amber-600 hover:bg-amber-700 text-white font-semibold rounded-xl hover:shadow-lg transition-all flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        {{ auth()->user()->securityAnswer ? 'Actualizar' : 'Guardar' }}
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
function selectColor(hex) {
    document.getElementById('selectedColor').value = hex;
    // Visual feedback
    document.querySelectorAll('.color-option').forEach(btn => {
        btn.classList.remove('ring-4', 'ring-white', 'ring-offset-2');
    });
    event.currentTarget.classList.add('ring-4', 'ring-white', 'ring-offset-2');
}
</script>
@endsection
