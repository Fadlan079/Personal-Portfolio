@php
$type = session('success') ? 'success'
    : (session('error') ? 'error'
    : (session('warning') ? 'warning'
    : (session('info') ? 'info' : null)));

$message = session($type);
@endphp

@if($type)
<div id="global-modal" class="fixed inset-0 z-99999 flex items-center justify-center px-4 font-mono select-none pointer-events-none">
    {{-- Terminal Style Modal --}}
    <div id="modal-backdrop" class="absolute inset-0 bg-black/50 backdrop-blur-sm pointer-events-none opacity-0 transition-opacity duration-300"></div>

    <div id="modal-box"
         class="relative w-full max-w-lg bg-black border border-primary/50 shadow-[0_0_50px_rgba(var(--color-primary-rgb),0.2)] opacity-0 scale-95 transition-all duration-300 pointer-events-auto">

        {{-- Terminal Header --}}
        <div class="flex items-center justify-between px-4 py-2 border-b border-primary/30 bg-primary/5">
            <div class="flex items-center gap-2">
                <span class="text-[10px] text-primary/50 uppercase tracking-widest">System Notification</span>
            </div>
            <button id="modal-close-btn" class="text-primary/50 hover:text-primary transition-colors">
                [X]
            </button>
        </div>

        <div class="p-6">
            <div class="flex items-start gap-4 mb-6">
                <div class="text-primary text-2xl animate-pulse">
                    >
                </div>
                <div class="flex-1">
                    <div class="text-primary font-bold uppercase tracking-widest text-xs mb-2">
                        Status: {{ $type }}
                    </div>
                    <div class="text-primary/90 text-sm leading-relaxed" id="terminal-text">
                        {{ $message }}
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button id="modal-ok-btn" class="px-6 py-2 border border-primary text-primary text-xs uppercase tracking-tighter hover:bg-primary hover:text-black transition-all">
                    Acknowledge
                </button>
            </div>
        </div>

        {{-- Scanning Line Effect --}}
        <div class="absolute inset-0 pointer-events-none overflow-hidden opacity-20">
            <div class="w-full h-px bg-primary animate-[scan_3s_linear_infinite]"></div>
        </div>
    </div>
</div>

<style>
    @keyframes scan {
        0% { transform: translateY(0); }
        100% { transform: translateY(100%); }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const modal = document.getElementById('global-modal');
        if (!modal) return;

        const backdrop = document.getElementById('modal-backdrop');
        const box = document.getElementById('modal-box');
        const closeBtn = document.getElementById('modal-close-btn');
        const okBtn = document.getElementById('modal-ok-btn');

        function showModal() {
            if (backdrop) backdrop.classList.add('opacity-100');
            box.classList.remove('opacity-0', 'scale-95');
            box.classList.add('opacity-100', 'scale-100');
            
            // Dismiss when clicking outside, but allow clicks to pass through
            document.addEventListener('mousedown', handleOutsideClick);
        }

        function handleOutsideClick(event) {
            if (!box.contains(event.target)) {
                hideModal();
            }
        }

        function hideModal() {
            if (backdrop) backdrop.classList.remove('opacity-100');
            box.classList.add('opacity-0', 'scale-95');
            document.removeEventListener('mousedown', handleOutsideClick);
            setTimeout(() => modal.remove(), 300);
        }

        setTimeout(showModal, 100);
        closeBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            hideModal();
        });
        okBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            hideModal();
        });
        setTimeout(hideModal, 8000);
    });
</script>
@endif
