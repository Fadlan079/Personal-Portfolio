@php
$type = session('success') ? 'success'
    : (session('error') ? 'error'
    : (session('warning') ? 'warning'
    : (session('info') ? 'info' : null)));

$message = session($type);

$colors = [
    'success' => 'primary',
    'error'   => 'red-500',
    'warning' => 'warning',
    'info'    => 'blue-500'
];

$icons = [
    'success' => 'fa-circle-check',
    'error'   => 'fa-circle-xmark',
    'warning' => 'fa-triangle-exclamation',
    'info'    => 'fa-circle-info'
];
@endphp

@if($type)
<div id="global-modal" class="fixed inset-0 z-99999 flex items-end sm:items-center justify-center px-4 py-6 pointer-events-none">
    {{-- Modern Minimalist Toast/Modal --}}
    <div id="modal-box"
         class="w-full max-w-md bg-surface border border-white/10 shadow-2xl rounded-2xl p-4 flex items-start gap-4 transform translate-y-20 opacity-0 transition-all duration-500 ease-out pointer-events-auto">

        <div class="shrink-0 w-12 h-12 rounded-xl flex items-center justify-center bg-{{ $colors[$type] }}/10 text-{{ $colors[$type] }}">
            <i class="fa-solid {{ $icons[$type] }} text-xl"></i>
        </div>

        <div class="flex-1 pt-1">
            <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-1">
                {{ ucfirst($type) }}
            </h3>
            <p class="text-sm text-white/70 leading-relaxed">
                {{ $message }}
            </p>
        </div>

        <button id="modal-close-btn" class="shrink-0 text-white/30 hover:text-white transition-colors">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const modal = document.getElementById('global-modal');
        if (!modal) return;

        const box = document.getElementById('modal-box');
        const closeBtn = document.getElementById('modal-close-btn');

        function showModal() {
            box.classList.remove('translate-y-20', 'opacity-0');
            box.classList.add('translate-y-0', 'opacity-100');
        }

        function hideModal() {
            box.classList.add('translate-y-20', 'opacity-0');
            setTimeout(() => modal.remove(), 500);
        }

        setTimeout(showModal, 100);
        closeBtn.addEventListener('click', hideModal);
        setTimeout(hideModal, 5000);
    });
</script>
@endif
