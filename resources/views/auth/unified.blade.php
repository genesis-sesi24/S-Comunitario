<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($isRegister) && $isRegister ? 'Crear Cuenta' : 'Iniciar Sesión' }} - La Batalla</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 overflow-hidden relative font-sans antialiased">
    
    <!-- Subtle Background Elements -->
    <div class="fixed inset-0 pointer-events-none">
        <div class="absolute top-20 right-20 w-96 h-96 bg-teal-100/30 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 left-20 w-96 h-96 bg-slate-200/40 rounded-full blur-3xl"></div>
    </div>

    <!-- Main Container with Slide Animation -->
    <div class="auth-container {{ isset($isRegister) && $isRegister ? 'right-panel-active' : '' }} fade-in-up" id="container">
        
        <!-- SIGN IN (LOGIN) Form -->
        <div class="form-container sign-in-container {{ isset($isRegister) && $isRegister ? '' : 'active-mobile' }}">
            <div class="flex flex-col justify-center h-full px-8 md:px-16 py-12">
                <div class="mb-10 text-center md:text-left">
                    <div class="flex items-center justify-center md:justify-start gap-3 mb-8">
                        <div class="w-11 h-11 bg-slate-900 text-white rounded-xl flex items-center justify-center shadow-lg font-bold text-lg">L</div>
                        <div class="text-left">
                            <h2 class="font-bold text-slate-900 text-lg leading-none">La Batalla</h2>
                            <p class="text-xs text-slate-400 mt-0.5">Sistema Comunitario</p>
                        </div>
                    </div>
                    <h1 class="font-display text-3xl font-bold text-slate-900 mb-2 tracking-tight">Bienvenido</h1>
                    <p class="text-slate-500 text-sm font-light">Ingresa tus credenciales para continuar</p>
                </div>

                <form action="{{ route('login') }}" method="post" id="loginForm" novalidate onsubmit="return handleFormSubmit(event, 'loginForm')">
                    @csrf
                    <div class="space-y-5">
                        <!-- Email -->
                        <div class="relative group">
                            <label for="login-email" class="block text-xs font-semibold text-slate-700 mb-2 tracking-wide text-left">Correo Electrónico</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400 group-focus-within:text-teal-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                </div>
                                <input type="email" name="email" id="login-email" 
                                       class="block w-full pl-12 pr-4 py-3.5 bg-white border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 transition-all text-sm font-medium shadow-sm validation-field" 
                                       value="{{ old('email') }}" required placeholder="tu@ejemplo.com"
                                       data-rule="email" data-msg="Ingresa un correo válido">
                            </div>
                            <span class="error-msg text-red-500 text-xs mt-1 hidden text-left block"></span>
                        </div>

                        <!-- Password -->
                        <div class="relative group">
                            <label for="login-password" class="block text-xs font-semibold text-slate-700 mb-2 tracking-wide text-left">Contraseña</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400 group-focus-within:text-teal-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input type="password" name="password" id="login-password" 
                                       class="block w-full pl-12 pr-4 py-3.5 bg-white border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 transition-all text-sm font-medium shadow-sm validation-field" 
                                       required placeholder="••••••••"
                                       data-rule="required" data-msg="La contraseña es obligatoria">
                            </div>
                            <span class="error-msg text-red-500 text-xs mt-1 hidden text-left block"></span>
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between text-sm pt-1">
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-teal-600 focus:ring-teal-500 cursor-pointer shadow-sm">
                                <span class="text-slate-600 font-medium">Recuérdame</span>
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-slate-600 font-medium hover:text-teal-700 transition-colors">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            @endif
                        </div>
                    </div>

                    <button type="submit" class="btn-premium w-full text-white font-semibold py-3.5 rounded-xl shadow-lg hover:shadow-xl mt-8 transition-all text-sm tracking-wide">
                        INICIAR SESIÓN
                    </button>

                    <!-- Mobile Switch -->
                    <div class="text-center mt-6 md:hidden">
                        <p class="text-sm text-slate-500">
                            ¿No tienes cuenta? 
                            <button type="button" class="text-teal-600 font-bold ml-1" onclick="toggleMobile('register')">Regístrate</button>
                        </p>
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-100 text-center md:text-left">
                        <a href="{{ url('/') }}" class="inline-flex items-center text-sm text-slate-500 hover:text-slate-700 transition-colors gap-2 font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Volver al inicio
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- SIGN UP (REGISTER) Form -->
        <div class="form-container sign-up-container {{ isset($isRegister) && $isRegister ? 'active-mobile' : '' }}">
            <div class="flex flex-col justify-center h-full px-8 md:px-16 py-8">
                <div class="mb-8 text-center md:text-left">
                    <div class="flex items-center justify-center md:justify-start gap-3 mb-8">
                        <div class="w-11 h-11 bg-slate-900 text-white rounded-xl flex items-center justify-center shadow-lg font-bold text-lg">L</div>
                        <div class="text-left">
                            <h2 class="font-bold text-slate-900 text-lg leading-none">La Batalla</h2>
                            <p class="text-xs text-slate-400 mt-0.5">Sistema Comunitario</p>
                        </div>
                    </div>
                    <h1 class="font-display text-3xl font-bold text-slate-900 mb-2 tracking-tight">Crear Cuenta</h1>
                    <p class="text-slate-500 text-sm font-light">Completa tus datos para comenzar</p>
                </div>

                <form action="{{ route('register') }}" method="post" id="registerForm" novalidate onsubmit="return handleFormSubmit(event, 'registerForm')">
                    @csrf
                    <div class="space-y-4">
                        <!-- Name -->
                        <div class="relative group">
                            <label for="register-name" class="block text-xs font-semibold text-slate-700 mb-2 tracking-wide text-left">Nombre Completo</label>
                            <input type="text" name="name" id="register-name" 
                                   class="block w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 transition-all text-sm font-medium shadow-sm validation-field" 
                                   value="{{ old('name') }}" required placeholder="Juan Pérez"
                                   data-rule="required" data-msg="El nombre es obligatorio">
                            <span class="error-msg text-red-500 text-xs mt-1 hidden text-left block"></span>
                        </div>

                        <!-- Email -->
                        <div class="relative group">
                            <label for="register-email" class="block text-xs font-semibold text-slate-700 mb-2 tracking-wide text-left">Correo Electrónico</label>
                            <input type="email" name="email" id="register-email" 
                                   class="block w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 transition-all text-sm font-medium shadow-sm validation-field" 
                                   value="{{ old('email') }}" required placeholder="juan@ejemplo.com"
                                   data-rule="email" data-msg="Ingresa un correo válido">
                            <span class="error-msg text-red-500 text-xs mt-1 hidden text-left block"></span>
                        </div>

                        <!-- Password -->
                        <div class="relative group">
                            <label for="register-password" class="block text-xs font-semibold text-slate-700 mb-2 tracking-wide text-left">Contraseña</label>
                            <input type="password" name="password" id="register-password" 
                                   class="block w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 transition-all text-sm font-medium shadow-sm validation-field" 
                                   required placeholder="Mínimo 8 caracteres"
                                   data-rule="min:8" data-msg="Mínimo 8 caracteres">
                            <span class="error-msg text-red-500 text-xs mt-1 hidden text-left block"></span>
                        </div>

                        <!-- Confirm Password -->
                        <div class="relative group">
                            <label for="register-password-confirmation" class="block text-xs font-semibold text-slate-700 mb-2 tracking-wide text-left">Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" id="register-password-confirmation" 
                                   class="block w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 transition-all text-sm font-medium shadow-sm validation-field" 
                                   required placeholder="Repite tu contraseña"
                                   data-rule="match:register-password" data-msg="Las contraseñas no coinciden">
                            <span class="error-msg text-red-500 text-xs mt-1 hidden text-left block"></span>
                        </div>

                        <!-- Security Question -->
                        <div class="relative group">
                            <label for="security-question" class="block text-xs font-semibold text-slate-700 mb-2 tracking-wide text-left">Pregunta de Seguridad</label>
                            <select name="security_question_id" id="security-question" 
                                   class="block w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-900 focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 transition-all text-sm font-medium shadow-sm validation-field" 
                                   required
                                   data-rule="required" data-msg="Selecciona una pregunta">
                                <option value="">-- Selecciona una pregunta --</option>
                                @foreach(\App\Models\SecurityQuestion::all() as $question)
                                    <option value="{{ $question->id }}" {{ old('security_question_id') == $question->id ? 'selected' : '' }}>
                                        {{ $question->question }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="error-msg text-red-500 text-xs mt-1 hidden text-left block"></span>
                        </div>

                        <!-- Security Answer -->
                        <div class="relative group">
                            <label for="security-answer" class="block text-xs font-semibold text-slate-700 mb-2 tracking-wide text-left">Respuesta de Seguridad</label>
                            <input type="text" name="security_answer" id="security-answer" 
                                   class="block w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 transition-all text-sm font-medium shadow-sm validation-field" 
                                   value="{{ old('security_answer') }}" required placeholder="Tu respuesta"
                                   data-rule="required" data-msg="La respuesta es obligatoria">
                            <span class="error-msg text-red-500 text-xs mt-1 hidden text-left block"></span>
                            <p class="text-xs text-slate-400 mt-1 ml-1">Esta respuesta te ayudará a recuperar tu contraseña</p>
                        </div>
                    </div>

                    <button type="submit" class="btn-premium w-full text-white font-semibold py-3.5 rounded-xl shadow-lg hover:shadow-xl mt-8 transition-all text-sm tracking-wide">
                        CREAR CUENTA
                    </button>

                    <!-- Mobile Switch -->
                    <div class="text-center mt-6 md:hidden">
                        <p class="text-sm text-slate-500">
                            ¿Ya tienes cuenta? 
                            <button type="button" class="text-teal-600 font-bold ml-1" onclick="toggleMobile('login')">Ingresa</button>
                        </p>
                    </div>

                    <div class="mt-6 pt-6 border-t border-slate-100 text-center md:text-left">
                        <a href="{{ url('/') }}" class="inline-flex items-center text-sm text-slate-500 hover:text-slate-700 transition-colors gap-2 font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Volver al inicio
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Overlay Container (Sliding Panel - Desktop Only) -->
        <div class="overlay-container">
            <div class="overlay">
                <!-- Left Panel (Visible when Register is shown) -->
                <div class="overlay-panel overlay-left">
                    <div class="max-w-sm px-4">
                        <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-8 shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                        </div>
                        <h1 class="font-display text-3xl font-bold mb-4 leading-tight">Bienvenido de Nuevo</h1>
                        <p class="text-white/90 mb-10 leading-relaxed font-light text-sm">
                            Para mantenerte conectado, inicia sesión con tus credenciales y continúa gestionando tu comunidad
                        </p>
                        <button class="bg-white/10 backdrop-blur-sm border-2 border-white/30 text-white font-semibold py-3.5 px-10 rounded-xl hover:bg-white/20 transition-all shadow-xl tracking-wide text-sm" id="signIn" onclick="togglePanel(false)">
                            INICIAR SESIÓN
                        </button>
                    </div>
                </div>
                
                <!-- Right Panel (Visible when Login is shown) -->
                <div class="overlay-panel overlay-right">
                    <div class="max-w-sm px-4">
                        <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-8 shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                        </div>
                        <h1 class="font-display text-3xl font-bold mb-4 leading-tight">Únete a Nosotros</h1>
                        <p class="text-white/90 mb-10 leading-relaxed font-light text-sm">
                            Crea tu cuenta y comienza a gestionar tu comunidad de manera eficiente y moderna
                        </p>
                        <button class="bg-white/10 backdrop-blur-sm border-2 border-white/30 text-white font-semibold py-3.5 px-10 rounded-xl hover:bg-white/20 transition-all shadow-xl tracking-wide text-sm" id="signUp" onclick="togglePanel(true)">
                            REGISTRARSE
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div id="errorModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center z-[200] opacity-0 invisible transition-all duration-300">
        <div class="bg-white rounded-2xl p-8 max-w-sm w-[90%] transform scale-90 transition-all duration-300 shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1.5 bg-red-500"></div>
            <div class="text-center">
                <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-5 animate-bounce">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h3 class="font-display font-bold text-2xl text-slate-900 mb-2">¡Alto ahí!</h3>
                <p class="text-slate-500 mb-6">No podemos continuar porque hay algunos errores en el formulario:</p>
                
                <div id="modalErrors" class="text-left bg-red-50 border border-red-100 rounded-xl p-4 mb-6 max-h-40 overflow-y-auto custom-scrollbar">
                    <!-- Errors injected here -->
                </div>

                <button onclick="closeModal()" class="w-full bg-slate-900 text-white font-bold py-3.5 rounded-xl hover:bg-slate-800 transition-colors shadow-lg">
                    Entendido, lo corregiré
                </button>
            </div>
        </div>
    </div>

    <script>
        // Desktop Slide Toggle
        function togglePanel(showRegister) {
            const container = document.getElementById('container');
            if (showRegister) {
                container.classList.add('right-panel-active');
            } else {
                container.classList.remove('right-panel-active');
            }
        }

        // Mobile Visibility Toggle (Smoother Transition)
        function toggleMobile(view) {
            const login = document.querySelector('.sign-in-container');
            const register = document.querySelector('.sign-up-container');
            
            // Define active and next
            let current, next;
            if (view === 'register') {
                current = login;
                next = register;
            } else {
                current = register;
                next = login;
            }

            // 1. Fade out current
            current.classList.remove('active-mobile');
            current.classList.add('closing-mobile');

            // 2. Wait for opacity transition (300ms matches CSS)
            setTimeout(() => {
                current.classList.remove('closing-mobile'); 
                // Now current is display:none (default)
                
                // 3. Show next
                next.classList.add('active-mobile');
            }, 300);
        }

        // Real-time Validation Logic
        document.addEventListener('DOMContentLoaded', () => {
            const inputs = document.querySelectorAll('.validation-field');
            
            inputs.forEach(input => {
                input.addEventListener('blur', () => validateField(input));
                input.addEventListener('input', () => {
                   if(input.classList.contains('border-red-500') || input.classList.contains('border-green-500')) {
                       validateField(input);
                   }
                });
            });
        });

        function validateField(input) {
            const rule = input.dataset.rule;
            const msg = input.dataset.msg;
            const errorSpan = input.parentNode.nextElementSibling;
            let isValid = true;
            let customError = msg;

            // Reset styles
            input.classList.remove('border-red-500', 'focus:border-red-500', 'ring-red-500/20');
            input.classList.remove('border-green-500', 'focus:border-green-500', 'ring-green-500/20');
            
            // Hide error safely
            if(errorSpan) {
                errorSpan.classList.add('hidden');
                errorSpan.textContent = '';
            }

            if (!rule) return true;

            const rules = rule.split('|');
            
            // Check Required
            if (rules.includes('required') && !input.value.trim()) {
                isValid = false;
                customError = msg || 'Este campo es obligatorio';
            }

            // Check Email
            if (isValid && rules.includes('email') && input.value.trim()) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if(!re.test(input.value)) {
                    isValid = false;
                    customError = 'Formato de correo inválido';
                }
            }

            // Check Min Length
            const minRule = rules.find(r => r.startsWith('min:'));
            if (isValid && minRule && input.value.trim()) {
                const len = parseInt(minRule.split(':')[1]);
                if (input.value.length < len) {
                    isValid = false;
                    customError = `Mínimo ${len} caracteres`;
                }
            }

            // Check Match
            const matchRule = rules.find(r => r.startsWith('match:'));
            if (isValid && matchRule) {
                const targetId = matchRule.split(':')[1];
                const target = document.getElementById(targetId);
                if (target && input.value !== target.value) {
                    isValid = false;
                    customError = 'Las contraseñas no coinciden';
                }
            }

            // Apply Visuals
            if (!isValid) {
                input.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-500/20');
                if(errorSpan) {
                    errorSpan.textContent = customError;
                    errorSpan.classList.remove('hidden');
                }
                return false;
            } else if (input.value.trim()) {
                input.classList.add('border-green-500', 'focus:border-green-500', 'focus:ring-green-500/20');
                return true;
            }
            return true;
        }

        // Form Submission Handler
        function handleFormSubmit(event, formId) {
            event.preventDefault();
            const form = document.getElementById(formId);
            const inputs = form.querySelectorAll('.validation-field');
            let errors = [];
            let hasError = false;

            inputs.forEach(input => {
                if (!validateField(input)) {
                    hasError = true;
                    let label = input.previousElementSibling.querySelector('label').innerText;
                    // Try to get error text from the span
                    let errorSpan = input.parentNode.nextElementSibling;
                    let errorText = errorSpan ? errorSpan.innerText : 'Error';
                    errors.push(`<b>${label}:</b> ${errorText}`);
                }
            });

            if (hasError) {
                showModal(errors);
                return false;
            }

            const btn = form.querySelector('button[type="submit"]');
            btn.innerHTML = '<span class="inline-block animate-spin mr-2">⟳</span> PROCESANDO...';
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');

            form.submit();
            return true;
        }

        // Multi-step Wizard Logic
        function nextStep() {
            // Validate Step 1 first
            const step1 = document.getElementById('register-step-1');
            const inputs = step1.querySelectorAll('.validation-field');
            let hasError = false;
            
            inputs.forEach(input => {
                if(!validateField(input)) hasError = true;
            });

            if(hasError) return;

            // Transition
            step1.classList.add('hidden');
            document.getElementById('register-step-2').classList.remove('hidden');
            
            // Update Indicators
            document.getElementById('step2-indicator').classList.remove('bg-slate-200');
            document.getElementById('step2-indicator').classList.add('bg-teal-600');
        }

        function prevStep() {
            document.getElementById('register-step-2').classList.add('hidden');
            document.getElementById('register-step-1').classList.remove('hidden');
             
            // Update Indicators
            document.getElementById('step2-indicator').classList.remove('bg-teal-600');
            document.getElementById('step2-indicator').classList.add('bg-slate-200');
        }

        function showModal(errors) {
            const modal = document.getElementById('errorModal');
            const list = document.getElementById('modalErrors');
            
            list.innerHTML = errors.map(e => `
                <div class="flex items-start gap-2 mb-2 text-sm text-red-700 last:mb-0">
                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>${e}</span>
                </div>
            `).join('');

            modal.classList.remove('opacity-0', 'invisible');
            modal.querySelector('div').classList.remove('scale-90');
            modal.querySelector('div').classList.add('scale-100');
        }

        function closeModal() {
            const modal = document.getElementById('errorModal');
            modal.classList.add('opacity-0', 'invisible');
            modal.querySelector('div').classList.remove('scale-100');
            modal.querySelector('div').classList.add('scale-90');
        }
    </script>
</body>
</html>
