@if (session()->has('success') || session()->has('error'))
<div
    id="global-alert"
    class="fixed top-6 right-6 z-50
        flex items-center gap-3
        px-4 py-3
        max-w-sm
        shadow-lg backdrop-blur
        text-sm
        animate-slide-in
        {{ session('success') ? 'bg-success text-text' : 'bg-red-500 text-white' }}"
>
    <span class="font-medium">
        {{ session('success') ?? session('error') }}
    </span>

    <button
        onclick="closeGlobalAlert()"
        class="ml-auto text-white/80 hover:text-white">
        ✕
    </button>
</div>

<script>
    function closeGlobalAlert() {
        const alertEl = document.getElementById('global-alert');
        if (!alertEl) return;

        alertEl.classList.add('opacity-0', 'translate-x-4');
        setTimeout(() => alertEl.remove(), 300);
    }

    setTimeout(closeGlobalAlert, 3000);
</script>

<style>
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(16px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.animate-slide-in {
    animation: slideIn 0.4s ease-out;
}
</style>
@endif
