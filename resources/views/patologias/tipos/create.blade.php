@extends('layouts.admin')

@section('title', 'Crear Tipo de Patología')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <a href="{{ route('patologias.tipos.index') }}" class="w-8 h-8 flex items-center justify-center rounded-full bg-white border border-slate-200 text-slate-400 hover:text-slate-600 hover:border-slate-300 transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h1 class="text-2xl font-display font-bold text-slate-900">Crear Nuevo Tipo</h1>
                <p class="text-sm text-slate-500">Configura una nueva categoría de salud.</p>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto">
        <form method="POST" action="{{ route('patologias.tipos.store') }}" class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 divide-y md:divide-y-0 md:divide-x divide-slate-100">
                <!-- Left Column: Basic Info -->
                <div class="p-8 space-y-6">
                    <div>
                        <label for="nombre" class="block text-sm font-semibold text-slate-700 mb-1">Nombre del Tipo <span class="text-red-500">*</span></label>
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm" placeholder="Ej: Dermatología" required autofocus>
                        @error('nombre') <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="descripcion" class="block text-sm font-semibold text-slate-700 mb-1">Descripción</label>
                        <textarea name="descripcion" id="descripcion" rows="4" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm resize-none" placeholder="Breve descripción...">{{ old('descripcion') }}</textarea>
                    </div>
                </div>

                <!-- Right Column: Appearance & Details -->
                <div class="p-8 bg-slate-50/50 space-y-8">
                    
                    <!-- Color Selection -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-3">Color Distintivo <span class="text-red-500">*</span></label>
                        <div class="flex flex-wrap gap-3">
                            @foreach([
                                'red' => 'bg-red-500', 
                                'orange' => 'bg-orange-500', 
                                'yellow' => 'bg-amber-400', 
                                'green' => 'bg-emerald-500', 
                                'blue' => 'bg-blue-500', 
                                'indigo' => 'bg-indigo-500', 
                                'purple' => 'bg-purple-500', 
                                'pink' => 'bg-pink-500'
                            ] as $value => $bgClass)
                            <label class="cursor-pointer relative group">
                                <input type="radio" name="color" value="{{ $value }}" class="sr-only peer" {{ (old('color') ?? 'blue') == $value ? 'checked' : '' }}>
                                <span class="block w-9 h-9 rounded-full transition-all duration-200 {{ $bgClass }} flex items-center justify-center border-2 border-transparent relative opacity-70 hover:opacity-100 hover:scale-105 peer-checked:opacity-100 peer-checked:scale-110 peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-slate-300">
                                    <svg class="w-5 h-5 text-white opacity-0 transform scale-50 transition-all duration-200 peer-checked:opacity-100 peer-checked:scale-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </span>
                            </label>
                            @endforeach
                        </div>
                        @error('color') <p class="mt-2 text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <!-- Icon Selection -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-3">Icono Representativo <span class="text-red-500">*</span></label>
                        <div class="grid grid-cols-6 gap-2">
                             @foreach(['brain', 'lungs', 'bone', 'heart-pulse', 'hand-back-fist', 'user', 'users', 'hospital', 'pills', 'clipboard-list', 'eye', 'tooth'] as $icon)
                                 <label class="cursor-pointer relative group" title="{{ ucfirst($icon) }}">
                                    <input type="radio" name="icono" value="{{ $icon }}" class="sr-only peer" {{ (old('icono') ?? 'clipboard-list') == $icon ? 'checked' : '' }}>
                                    <span class="block w-10 h-10 rounded-lg flex items-center justify-center border border-slate-200 bg-white text-slate-400 hover:text-indigo-600 hover:border-indigo-300 transition-all peer-checked:bg-indigo-50 peer-checked:border-indigo-500 peer-checked:text-indigo-600 peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-indigo-500 hover:shadow-sm">
                                         <x-icon name="{{ $icon }}" class="w-5 h-5" />
                                    </span>
                                 </label>
                             @endforeach
                        </div>
                         @error('icono') <p class="mt-2 text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <!-- Info Box -->
                    <div class="rounded-lg bg-indigo-50/50 border border-indigo-100 p-4 shadow-sm">
                        <div class="flex gap-3">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800">Siguiente Paso</h4>
                                <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                                    Al crear este tipo, se generará una tabla dedicada en la base de datos automáticamente.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="px-8 py-5 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('patologias.tipos.index') }}" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-800 transition">Cancelar</a>
                <button type="submit" class="inline-flex items-center px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-lg shadow-sm hover:shadow transition-all transform active:scale-95">
                    Crear Tipo y Configurar Campos
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </button>
            </div>
        </form>
    </div>
@endsection
