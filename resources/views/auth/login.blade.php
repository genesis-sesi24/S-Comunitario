@extends('layouts.auth_custom')

@section('title', 'Bienvenido de nuevo')
@section('subtitle', 'Ingresa a tu cuenta para continuar')

@section('content')
<form action="{{ route('login') }}" method="post" id="loginForm" onsubmit="validateForm('loginForm', event)" class="fade-in-up" style="animation-delay: 0.2s;">
    @csrf

    <div class="space-y-6">
        <!-- Email Input -->
        <div class="relative group">
            <div class="absolute inset-y-0 left-0 pl-12 flex items-center pointer-events-none">
                <div class="p-2 bg-lb-primary/10 rounded-lg group-focus-within:bg-lb-primary/20 transition-colors">
                    <svg class="w-5 h-5 text-lb-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                </div>
            </div>
            <input type="email" name="email" id="email" 
                   class="block w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 placeholder-slate-400 focus:outline-none focus:border-lb-primary focus:ring-1 focus:ring-lb-primary transition-all duration-300 hover:bg-white" 
                   value="{{ old('email') }}" required autofocus placeholder="Correo electrónico">
            @error('email')
                <span class="absolute -bottom-5 left-0 text-red-500 text-xs pl-1 font-medium">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password Input -->
        <div class="relative group">
            <div class="absolute inset-y-0 left-0 pl-12 flex items-center pointer-events-none">
                <div class="p-2 bg-lb-primary/10 rounded-lg group-focus-within:bg-lb-primary/20 transition-colors">
                    <svg class="w-5 h-5 text-lb-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
            </div>
            <input type="password" name="password" id="password" 
                   class="block w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 placeholder-slate-400 focus:outline-none focus:border-lb-primary focus:ring-1 focus:ring-lb-primary transition-all duration-300 hover:bg-white" 
                   required placeholder="Contraseña">
            @error('password')
                <span class="absolute -bottom-5 left-0 text-red-500 text-xs pl-1 font-medium">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <!-- Options Row -->
    <div class="flex items-center justify-between mt-6 mb-8">
        <label class="flex items-center gap-3 cursor-pointer group">
            <div class="relative">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="sr-only peer">
                <div class="w-5 h-5 border-2 border-slate-300 rounded peer-checked:bg-lb-primary peer-checked:border-lb-primary transition-colors"></div>
                <svg class="w-3 h-3 text-white absolute top-1 left-1 opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <span class="text-sm text-slate-500 group-hover:text-slate-700 transition-colors select-none">{{ __('Remember Me') }}</span>
        </label>
        
        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-sm text-lb-primary font-semibold hover:text-lb-primary-dark hover:underline underline-offset-4 transition-all">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn-premium w-full text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl hover:scale-[1.01] active:scale-[0.98] transition-all duration-300">
        {{ __('Login') }}
    </button>
    
    <!-- Footer actions -->
    <div class="mt-8 pt-8 border-t border-slate-100 text-center space-y-4">
        <p class="text-slate-600 text-sm">
            ¿Aún no tienes una cuenta? 
            <a href="{{ route('register') }}" class="text-lb-primary font-bold hover:text-lb-primary-dark transition-colors inline-flex items-center ml-1 group">
                Regístrate ahora
                <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
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