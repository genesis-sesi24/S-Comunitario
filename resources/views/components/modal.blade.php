@props(['id', 'title'])

<div id="{{ $id }}" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm transition-opacity" aria-hidden="true" style="z-index: 100;">
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl transform transition-all scale-100 max-w-lg w-full overflow-hidden border border-slate-100">
            <!-- Header -->
            <div class="px-8 py-5 border-b border-slate-50 bg-white flex items-center justify-between">
                <h3 class="text-xl font-display font-bold text-slate-800">{{ $title }}</h3>
                <button type="button" onclick="closeModal('{{ $id }}')" class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Body -->
            <div class="p-8">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>

@once
<script>
    if (typeof openModal !== 'function') {
        window.openModal = function(id) {
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.remove('hidden');
            }
        }
    }

    if (typeof closeModal !== 'function') {
        window.closeModal = function(id) {
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.add('hidden');
            }
        }
    }
    
    // Close on click outside
    document.addEventListener('click', (e) => {
        if (e.target.hasAttribute('aria-hidden') && e.target.getAttribute('aria-hidden') === 'true') {
            e.target.classList.add('hidden');
        }
    });
</script>
@endonce
