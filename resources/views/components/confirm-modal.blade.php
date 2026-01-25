@props(['id', 'title', 'message', 'action', 'confirmText' => 'Eliminar', 'cancelText' => 'Cancelar', 'confirmColor' => 'bg-red-600 hover:bg-red-700'])

<div id="{{ $id }}" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm transition-opacity" aria-hidden="true">
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-xl transform transition-all scale-100 max-w-md w-full overflow-hidden border border-slate-100">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-800">{{ $title }}</h3>
                <button type="button" onclick="closeModal('{{ $id }}')" class="text-slate-400 hover:text-slate-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Body -->
            <div class="p-6">
                <div class="flex gap-4">
                    <div class="flex-shrink-0 w-12 h-12 rounded-full bg-red-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <div>
                        <p class="text-slate-600 text-sm leading-relaxed">{{ $message }}</p>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="px-6 py-4 bg-slate-50 flex justify-end gap-3">
                <button type="button" onclick="closeModal('{{ $id }}')" class="px-4 py-2 bg-white border border-slate-300 rounded-xl text-slate-700 font-semibold text-sm hover:bg-slate-50 transition-colors">
                    {{ $cancelText }}
                </button>
                <form action="{{ $action }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 text-white font-bold rounded-xl text-sm shadow-lg shadow-red-500/30 transition-all {{ $confirmColor }}">
                        {{ $confirmText }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openModal(id) {
        const modal = document.getElementById(id);
        modal.classList.remove('hidden');
        // Simple animation
        const content = modal.querySelector('div > div');
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }

    function closeModal(id) {
        const modal = document.getElementById(id);
        modal.classList.add('hidden');
    }
    
    // Close on click outside
    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('fixed') && e.target.getAttribute('aria-hidden') === 'true') {
            e.target.classList.add('hidden');
        }
    });
</script>
