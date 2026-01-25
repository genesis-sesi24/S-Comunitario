<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Acceso - La Batalla</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .fade-enter {
            animation: fadeEnter 0.3s ease-out forwards;
        }
        @keyframes fadeEnter {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-slate-50 font-sans">
    @include('components.toast')
    
    <div class="w-full max-w-md p-6">
        <div class="bg-white rounded-3xl shadow-xl p-8 relative overflow-hidden">
            
            <div class="text-center mb-6">
                <div class="w-14 h-14 bg-teal-50 text-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                </div>
                <h1 class="font-display text-2xl font-bold text-slate-800 mb-1">Recuperar Acceso</h1>
                <p class="text-slate-500 text-sm">Elige una opción para continuar</p>
            </div>

            <!-- Tabs -->
            <div class="flex p-1.5 bg-slate-100 rounded-xl mb-8 relative">
                <!-- Highlight Background -->
                <div class="absolute top-1.5 bottom-1.5 w-[calc(50%-6px)] bg-white rounded-lg shadow-sm transition-all duration-300 ease-in-out z-0" id="tab-highlight" style="left: 6px;"></div>
                
                <button onclick="switchTab('email')" class="relative w-1/2 py-2.5 text-sm font-semibold text-slate-800 z-10 transition-colors flex items-center justify-center gap-2" id="btn-email">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Por Email
                </button>
                <button onclick="switchTab('security')" class="relative w-1/2 py-2.5 text-sm font-semibold text-slate-500 z-10 transition-colors flex items-center justify-center gap-2" id="btn-security">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    Por Pregunta
                </button>
            </div>

            <!-- EMAIL FORM -->
            <div id="form-email" class="fade-enter block">
                <p class="text-xs text-center text-slate-400 mb-6 flex items-center justify-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Enviaremos un enlace a tu bandeja de entrada
                </p>
                
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-6">
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Correo Electrónico</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                            </span>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                   class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-all text-sm"
                                   placeholder="tu@ejemplo.com">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1 font-medium flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-teal-600 text-white font-semibold py-3.5 rounded-xl hover:bg-teal-700 transition-all shadow-lg shadow-teal-600/20 flex items-center justify-center gap-2">
                        <span>ENVIAR ENLACE</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </form>
            </div>

            <!-- SECURITY FORM -->
            <div id="form-security" class="hidden">
                <p class="text-xs text-center text-slate-400 mb-6 flex items-center justify-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    Responde correctamente para restablecer al instante
                </p>
                
                <form method="POST" action="{{ route('password.security.verify') }}" id="securityForm">
                    @csrf
                    
                    <!-- Step 1: Find User -->
                    <div id="sec-step-1" class="fade-enter">
                        <div class="mb-6">
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Correo Electrónico</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                                </span>
                                <input type="email" name="email" id="sec-email" required
                                       class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-all text-sm"
                                       placeholder="tu@ejemplo.com">
                            </div>
                             <p class="text-red-500 text-xs mt-1 hidden font-medium" id="sec-email-error"></p>
                        </div>
                        <button type="button" onclick="findQuestion()" id="btn-find" class="w-full bg-teal-600 text-white font-semibold py-3.5 rounded-xl hover:bg-teal-700 transition-all shadow-lg shadow-teal-600/20 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            <span>BUSCAR PREGUNTA</span>
                        </button>
                    </div>

                    <!-- Step 2: Answer Question -->
                    <div id="sec-step-2" class="hidden fade-enter">
                        <div class="mb-5 p-4 bg-teal-50 rounded-xl border border-teal-100 flex items-start gap-3">
                            <svg class="w-5 h-5 text-teal-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <div>
                                <p class="text-xs font-bold text-teal-800 uppercase mb-0.5">Pregunta de Seguridad</p>
                                <p class="text-sm text-teal-900 font-medium leading-snug" id="question-text">Cargando...</p>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Tu Respuesta</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </span>
                                <input type="text" name="security_answer" id="sec-answer" required
                                       class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-all text-sm"
                                       placeholder="Escribe tu respuesta exacta">
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-teal-600 text-white font-semibold py-3.5 rounded-xl hover:bg-teal-700 transition-all shadow-lg shadow-teal-600/20 flex items-center justify-center gap-2">
                            <span>VERIFICAR</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </button>
                        
                        <button type="button" onclick="resetSecurityForm()" class="w-full mt-4 text-xs font-medium text-slate-400 hover:text-slate-600 flex items-center justify-center gap-1 transition-colors">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            Usar otro correo
                        </button>
                    </div>
                </form>
            </div>

            <div class="mt-8 text-center border-t border-slate-100 pt-6">
                <a href="{{ route('login') }}" class="text-sm font-medium text-slate-400 hover:text-slate-600 transition-colors inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                    Volver al inicio de sesión
                </a>
            </div>
        </div>
    </div>

    <script>
        function switchTab(tab) {
            const highlight = document.getElementById('tab-highlight');
            const formEmail = document.getElementById('form-email');
            const formSecurity = document.getElementById('form-security');
            const btnEmail = document.getElementById('btn-email');
            const btnSecurity = document.getElementById('btn-security');

            if (tab === 'email') {
                highlight.style.left = '6px';
                
                btnEmail.classList.replace('text-slate-500', 'text-slate-800');
                btnSecurity.classList.replace('text-slate-800', 'text-slate-500');

                formEmail.classList.remove('hidden');
                formEmail.classList.add('fade-enter');
                formSecurity.classList.add('hidden');
                formSecurity.classList.remove('fade-enter');
            } else {
                highlight.style.left = 'calc(50% + 0px)'; // Adjust based on padding
                
                btnSecurity.classList.replace('text-slate-500', 'text-slate-800');
                btnEmail.classList.replace('text-slate-800', 'text-slate-500');

                formSecurity.classList.remove('hidden');
                formSecurity.classList.add('fade-enter');
                formEmail.classList.add('hidden');
                formEmail.classList.remove('fade-enter');
            }
        }

        async function findQuestion() {
            const email = document.getElementById('sec-email').value;
            const btn = document.getElementById('btn-find');
            const error = document.getElementById('sec-email-error');

            if (!email.includes('@')) {
                error.textContent = 'Ingresa un correo válido';
                error.classList.remove('hidden');
                return;
            }
            error.classList.add('hidden');

            // Loading state
            const originalText = btn.innerHTML;
            btn.innerHTML = '<svg class="animate-spin h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> BUSCANDO...';
            btn.disabled = true;

            try {
                const response = await fetch('{{ route("password.security.question") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ email })
                });

                const data = await response.json();

                if (response.ok) {
                    document.getElementById('question-text').innerText = data.question;
                    document.getElementById('sec-step-1').classList.add('hidden');
                    document.getElementById('sec-step-2').classList.remove('hidden');
                } else {
                    error.textContent = data.email ? data.email[0] : (data.error || 'Error al buscar usuario');
                    error.classList.remove('hidden');
                }
            } catch (e) {
                console.error(e);
                error.textContent = 'Error de conexión';
                error.classList.remove('hidden');
            } finally {
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        }

        function resetSecurityForm() {
            document.getElementById('sec-step-2').classList.add('hidden');
            document.getElementById('sec-step-1').classList.remove('hidden');
            document.getElementById('sec-answer').value = '';
        }
    </script>
</body>
</html>