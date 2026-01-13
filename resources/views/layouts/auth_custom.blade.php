<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - La Batalla</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300..700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex items-center justify-center min-h-screen bg-slate-100">
    <div class="w-[95%] max-w-5xl h-[80vh] min-h-[580px] flex bg-white rounded-[32px] overflow-hidden shadow-2xl">
        <!-- Image Side -->
        <div class="hidden lg:flex lg:flex-[1.1] relative bg-gradient-to-br from-lb-primary via-lb-primary-dark to-lb-secondary text-white flex-col justify-end p-10 overflow-hidden">
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80')] bg-cover bg-center opacity-40 mix-blend-overlay"></div>
            
            <div class="relative z-10 bg-white/10 backdrop-blur-xl p-8 rounded-3xl border border-white/20 shadow-xl">
                <h2 class="font-display text-3xl font-bold mb-3 leading-tight">
                    Cuidando a la comunidad, un paciente a la vez.
                </h2>
                <p class="text-base opacity-95 leading-relaxed mb-6">
                    Bienvenido al Sistema Comunitario La Batalla. Optimiza la gestión de tu consultorio con tecnología de punta diseñada para profesionales de la salud.
                </p>
                
                <ul class="space-y-3">
                    <li class="flex items-center gap-3 text-sm">
                        <svg class="w-5 h-5 flex-shrink-0 text-lb-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Gestión eficiente de expedientes clínicos electrónicos.
                    </li>
                    <li class="flex items-center gap-3 text-sm">
                        <svg class="w-5 h-5 flex-shrink-0 text-lb-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Seguimiento detallado de citas y consultas.
                    </li>
                    <li class="flex items-center gap-3 text-sm">
                        <svg class="w-5 h-5 flex-shrink-0 text-lb-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Reportes automáticos y estadísticas en tiempo real.
                    </li>
                </ul>
            </div>
        </div>

        <!-- Form Side -->
        <div class="flex-1 p-10 md:p-12 flex flex-col justify-center bg-white overflow-y-auto">
            <div class="mb-8">
                <h1 class="font-display text-2xl md:text-3xl font-bold text-slate-900 mb-2">La Batalla</h1>
                <p class="text-slate-600">@yield('subtitle')</p>
            </div>

            @yield('content')
            
            <div class="mt-6 text-center text-slate-600 text-sm">
                <p>&copy; {{ date('Y') }} La Batalla - Sistema Comunitario</p>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div id="errorModal" class="fixed inset-0 bg-slate-900/70 backdrop-blur-sm flex items-center justify-center z-50 opacity-0 invisible transition-all duration-300">
        <div class="bg-white rounded-3xl p-10 max-w-md w-[90%] transform scale-90 transition-all duration-300 text-center shadow-2xl">
            <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-9 h-9" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <h3 class="font-display text-2xl font-bold text-slate-900 mb-2">Acción Requerida</h3>
            <div id="modalContent" class="text-slate-600 mb-8"></div>
            <button onclick="closeModal()" class="w-full bg-slate-900 hover:bg-slate-800 text-white font-semibold py-3 px-6 rounded-xl transition">
                Entendido, corregiré los datos
            </button>
        </div>
    </div>

    <script>
        function showModal(message, errors = []) {
            const modalContent = document.getElementById('modalContent');
            let content = `<p class="mb-4">${message}</p>`;
            
            if (errors.length > 0) {
                content += '<ul class="text-left bg-red-50 border border-red-200 rounded-xl p-4 space-y-2 text-sm text-red-700">';
                errors.forEach(err => {
                    content += `<li class="flex items-start gap-2"><span class="text-red-500 mt-0.5">•</span><span>${err}</span></li>`;
                });
                content += '</ul>';
            }
            
            modalContent.innerHTML = content;
            const modal = document.getElementById('errorModal');
            modal.classList.remove('opacity-0', 'invisible');
            modal.querySelector('.bg-white').classList.remove('scale-90');
            modal.querySelector('.bg-white').classList.add('scale-100');
        }

        function closeModal() {
            const modal = document.getElementById('errorModal');
            modal.classList.add('opacity-0', 'invisible');
            modal.querySelector('.bg-white').classList.remove('scale-100');
            modal.querySelector('.bg-white').classList.add('scale-90');
        }
        
        document.getElementById('errorModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        function validateForm(formId, event) {
            event.preventDefault();
            const form = document.getElementById(formId);
            const inputs = form.querySelectorAll('input[required]');
            let errors = [];
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    const labelElement = document.querySelector(`label[for="${input.id}"]`);
                    const label = labelElement ? labelElement.innerText : input.name;
                    errors.push(`El campo <strong>"${label}"</strong> está vacío.`);
                }
            });

            if (formId === 'registerForm') {
                const password = form.querySelector('input[name="password"]').value;
                const confirm = form.querySelector('input[name="password_confirmation"]').value;
                if (password && confirm && password !== confirm) {
                    errors.push('Las contraseñas <strong>no coinciden</strong>.');
                }
                if(password && password.length < 8) {
                     errors.push('La contraseña debe tener al menos <strong>8 caracteres</strong>.');
                }
            }

            if (errors.length > 0) {
                showModal('Para poder continuar, es necesario que revises los siguientes puntos:', errors);
                return false;
            }

            form.submit();
        }
    </script>
</body>
</html>
