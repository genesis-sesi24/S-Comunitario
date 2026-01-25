<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - La Batalla</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center bg-slate-50 font-sans">
    @include('components.toast')
    
    <div class="w-full max-w-5xl h-full md:h-auto p-6">
        <div class="grid md:grid-cols-2 bg-white rounded-3xl shadow-xl overflow-hidden min-h-[600px]">
            
            <!-- Left Side: Branding (Professional Slate/Dark) -->
            <div class="hidden md:flex flex-col justify-center items-center bg-slate-900 text-white p-12 relative overflow-hidden">
                <!-- Abstract Background Pattern -->
                <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 30px 30px;"></div>
                <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-teal-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
                <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-blue-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>

                <div class="relative z-10 text-center">
                    <div class="w-16 h-16 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center mx-auto mb-6 border border-white/20 overflow-hidden">
                        @if($settings->logo_Cm && $settings->logo_Cm != 'default-logo-sm.png')
                            <img src="{{ asset('storage/' . $settings->logo_Cm) }}" class="w-full h-full object-cover">
                        @else
                            <span class="font-bold text-2xl text-white">{{ strtoupper(substr($settings->nombre, 0, 2)) }}</span>
                        @endif
                    </div>
                    <h2 class="font-display text-3xl font-bold mb-4">{{ $settings->nombre }}</h2>
                    <p class="text-slate-400 font-light leading-relaxed max-w-xs mx-auto">
                        {{ Str::limit($settings->descripcion, 80) }}
                    </p>
                </div>
            </div>

            <!-- Right Side: Form (Clean White) -->
            <div class="p-10 md:p-12 flex flex-col justify-center">
                <div class="text-center md:text-left mb-8">
                    <h1 class="font-display text-2xl font-bold text-slate-800 mb-1">Bienvenido de nuevo</h1>
                    <p class="text-sm text-slate-500">Por favor, ingresa tus credenciales</p>
                </div>

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    
                    <div class="space-y-5">
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Correo Electrónico</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-all text-sm @error('email') border-red-500 @enderror"
                                   placeholder="tu@ejemplo.com">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Contraseña</label>
                            <input type="password" name="password" id="password" required
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-all text-sm @error('password') border-red-500 @enderror"
                                   placeholder="••••••••">
                            @error('password')
                                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between mt-6">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}
                                   class="w-4 h-4 rounded border-slate-300 text-teal-600 focus:ring-teal-500">
                            <span class="text-sm text-slate-600">Recuérdame</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-teal-600 hover:text-teal-700 font-medium transition-colors">
                                Recuperar contraseña
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-teal-600 text-white font-semibold py-3.5 rounded-xl hover:bg-teal-700 transition-all shadow-lg shadow-teal-600/20 mt-8 transform active:scale-[0.98]">
                        INICIAR SESIÓN
                    </button>
                    
                    <!-- Divider -->
                    <div class="relative my-8">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-slate-100"></div>
                        </div>
                        <div class="relative flex justify-center text-xs uppercase">
                            <span class="bg-white px-2 text-slate-400">O crea una cuenta</span>
                        </div>
                    </div>

                    <!-- Register Link -->
                    <a href="{{ route('register') }}" class="block w-full text-center border border-slate-200 text-slate-600 font-semibold py-3.5 rounded-xl hover:bg-slate-50 hover:text-slate-800 transition-all">
                        Registrarse
                    </a>
                </form>

                <div class="mt-8 text-center">
                    <a href="{{ url('/') }}" class="inline-flex items-center text-xs text-slate-400 hover:text-slate-600 transition-colors gap-2">
                        ← Volver al inicio
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>