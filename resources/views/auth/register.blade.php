@extends('layouts.auth_custom')

@section('title', 'Crear Cuenta')
@section('subtitle', 'Únete a nuestra comunidad hoy mismo')

@section('content')
<form action="{{ route('register') }}" method="post" id="registerForm" onsubmit="validateForm('registerForm', event)" class="fade-in-up" style="animation-delay: 0.2s;">
    @csrf

    <div class="space-y-5">
        <!-- Name Input -->
        <div class="relative group">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <div class="p-2 bg-lb-primary/10 rounded-lg group-focus-within:bg-lb-primary/20 transition-colors">
                    <svg class="w-5 h-5 text-lb-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>
            <input type="text" name="name" id="name" 
                   class="block w-full pl-16 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 placeholder-slate-400 focus:outline-none focus:border-lb-primary focus:ring-1 focus:ring-lb-primary transition-all duration-300 hover:bg-white" 
                   value="{{ old('name') }}" required autofocus placeholder="Nombre completo">
            @error('name')
                <span class="absolute -bottom-5 left-0 text-red-500 text-xs pl-1 font-medium">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email Input -->
        <div class="relative group">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <div class="p-2 bg-lb-primary/10 rounded-lg group-focus-within:bg-lb-primary/20 transition-colors">
                    <svg class="w-5 h-5 text-lb-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                </div>
            </div>
            <input type="email" name="email" id="email" 
                   class="block w-full pl-16 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 placeholder-slate-400 focus:outline-none focus:border-lb-primary focus:ring-1 focus:ring-lb-primary transition-all duration-300 hover:bg-white" 
                   value="{{ old('email') }}" required placeholder="Correo electrónico">
            @error('email')
                <span class="absolute -bottom-5 left-0 text-red-500 text-xs pl-1 font-medium">{{ $message }}</span>
            @enderror
        </div>

        <!-- Passwords Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <!-- Password -->
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-1 flex items-center pointer-events-none">
                    <div class="p-2 bg-lb-primary/10 rounded-lg">
                        <svg class="w-5 h-5 text-lb-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                </div>
                <input type="password" name="password" id="password" 
                       class="block w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 placeholder-slate-400 focus:outline-none focus:border-lb-primary focus:ring-1 focus:ring-lb-primary transition-all duration-300 hover:bg-white text-sm" 
                       required placeholder="Contraseña">
            </div>

            <!-- Confirm Password -->
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-1 flex items-center pointer-events-none">
                    <div class="p-2 bg-slate-100 rounded-lg">
                        <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                       class="block w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 placeholder-slate-400 focus:outline-none focus:border-lb-primary focus:ring-1 focus:ring-lb-primary transition-all duration-300 hover:bg-white text-sm" 
                       required placeholder="Confirmar">
            </div>
        </div>
         @error('password')
            <span class="text-red-500 text-xs pl-1 font-medium block mt-1">{{ $message }}</span>
        @enderror
    </div>

    <!-- Submit Button -->
    <div class="mt-8">
        <button type="submit" class="btn-premium w-full text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl hover:scale-[1.01] active:scale-[0.98] transition-all duration-300">
            {{ __('Register') }}
        </button>
    </div>
    
    <!-- Footer actions -->
    <div class="mt-8 pt-6 border-t border-slate-100 text-center space-y-4">
        <p class="text-slate-600 text-sm">
            ¿Ya tienes una cuenta? 
            <a href="{{ route('login') }}" class="text-lb-primary font-bold hover:text-lb-primary-dark transition-colors inline-block ml-1 hover:underline underline-offset-4">
                Inicia sesión
            </a>
        </p>
        <a href="{{ url('/') }}" class="inline-flex items-center text-sm text-slate-400 hover:text-slate-600 transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Volver al inicio
        </a>
    </div>
</form>
@endsection