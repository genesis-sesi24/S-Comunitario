@extends('layouts.admin')

@section('title', 'Editar Familia')

@section('content')
    <div class="mb-8">
        <a href="{{ route('familias.index') }}" class="flex items-center text-sm text-slate-500 hover:text-lb-primary transition-colors mb-4">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Volver al listado
        </a>
        <h1 class="text-3xl font-display font-bold text-slate-900">Editar Familia</h1>
        <p class="mt-2 text-sm text-slate-600">Modifique los datos del grupo familiar.</p>
    </div>

    <div class="max-w-3xl">
        <form action="{{ route('familias.update', $familia) }}" method="POST" class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 sm:p-8">
            @csrf
            @method('PUT')
            
            <!-- Grupo de Datos principales -->
            <div class="space-y-6">
                <div>
                    <h3 class="text-lg font-medium leading-6 text-slate-900 border-b border-slate-200 pb-2 mb-4">Información General</h3>
                    
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <!-- Apellidos -->
                        <div class="sm:col-span-6">
                            <label for="apellidos" class="block text-sm font-medium text-slate-700">Apellidos de la Familia</label>
                            <div class="mt-1">
                                <input type="text" name="apellidos" id="apellidos" required 
                                    class="block w-full rounded-md border-slate-300 shadow-sm focus:border-lb-primary focus:ring-lb-primary sm:text-sm"
                                    value="{{ old('apellidos', $familia->apellidos) }}">
                            </div>
                            @error('apellidos')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>



                        <!-- Ingresos -->
                        <div class="sm:col-span-3">
                            <label for="ingreso_mensual_aprox" class="block text-sm font-medium text-slate-700">Ingreso Mensual Aprox.</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-slate-500 sm:text-sm">$</span>
                                </div>
                                <input type="number" name="ingreso_mensual_aprox" id="ingreso_mensual_aprox" min="0" step="0.01"
                                    class="block w-full pl-7 rounded-md border-slate-300 shadow-sm focus:border-lb-primary focus:ring-lb-primary sm:text-sm"
                                    value="{{ old('ingreso_mensual_aprox', $familia->ingreso_mensual_aprox) }}">
                            </div>
                            @error('ingreso_mensual_aprox')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-6 mt-8 border-t border-slate-200">
                <div class="flex justify-end gap-3">
                    <a href="{{ route('familias.index') }}" class="py-2 px-4 border border-slate-300 rounded-md shadow-sm text-sm font-medium text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lb-primary transition-colors">
                        Cancelar
                    </a>
                    <button type="submit" class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-lb-primary hover:bg-lb-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lb-primary transition-colors">
                        Actualizar Familia
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
