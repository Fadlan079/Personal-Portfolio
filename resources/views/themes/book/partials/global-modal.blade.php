@php
$type = session('success') ? 'success'
    : (session('error') ? 'error'
    : (session('warning') ? 'warning'
    : (session('info') ? 'info' : null)));

$message = session($type);

// Palet warna Pastel Soft ala Sticky Notes (Background & Teks kontras)
$colors = [
    'success' => [
        'bg'     => '#d1fae5', // Soft Green (emerald-100)
        'text'   => '#065f46', // Dark Green (emerald-800)
        'tape'   => '#a7f3d0'  // emerald-200
    ],
    'error'   => [
        'bg'     => '#fee2e2', // Soft Red/Pink (red-100)
        'text'   => '#991b1b', // Dark Red (red-800)
        'tape'   => '#fecaca'  // red-200
    ],
    'warning' => [
        'bg'     => '#fef3c7', // Soft Yellow (amber-100)
        'text'   => '#92400e', // Dark Brown/Orange (amber-800)
        'tape'   => '#fde68a'  // amber-200
    ],
    'info'    => [
        'bg'     => '#e0f2fe', // Soft Blue (sky-100)
        'text'   => '#075985', // Dark Blue (sky-800)
        'tape'   => '#bae6fd'  // sky-200
    ]
];

// Menggunakan FontAwesome Icons (tetap sama, disesuaikan warna nanti)
$icons = [
    'success' => 'fa-solid fa-check',
    'error'   => 'fa-solid fa-xmark',
    'warning' => 'fa-solid fa-exclamation',
    'info'    => 'fa-solid fa-info'
];

// Judul ala Catatan Harian
$titles = [
    'success' => 'Yay, Berhasil!',
    'error'   => 'Oops, Ada Masalah..',
    'warning' => 'Cek Dulu, Deh.',
    'info'    => 'Fyi, Catatan Kecil:'
];

// Deskripsi santai ala Diary
$descriptions = [
    'success' => 'Catatan ini sudah tersimpan rapi di diary-ku.',
    'error'   => 'Coba periksa lagi tulisannya, mungkin ada yang salah ketik.',
    'warning' => 'Pikirkan baik-baik sebelum lanjut nulis halaman berikutnya.',
    'info'    => 'Sekadar pengingat agar tidak lupa detail ini.'
];

// Logika Rotasi Acak (rotate-1 atau -rotate-2)
$rotations = ['rotate-1', '-rotate-2', '-rotate-1', 'rotate-2'];
$randomRotation = $type ? $rotations[array_rand($rotations)] : '';
@endphp

@if($type)
<div id="global-modal" class="fixed inset-0 z-99999 flex items-center justify-center px-4 overflow-hidden select-none" style="font-family: 'Kalam', 'Segoe UI', cursive;">
    {{-- Kalam adalah font Google yang mirip tulisan tangan. Jika tidak ada, fallback ke cursive --}}
    {{-- Muat font Kalam di head link: <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@400;700&display=swap" rel="stylesheet"> --}}

    {{-- Backdrop (lebih terang agar tema diary terasa soft) --}}
    <div id="modal-backdrop" class="absolute inset-0 bg-[#E5E4DF]/70 backdrop-blur-sm cursor-pointer" style="opacity: 0;"></div>

    {{-- Sticky Note Container --}}
    <div id="modal-box"
         class="relative w-full max-w-[360px] p-6 md:p-8 shadow-xl rounded-sm group {{ $randomRotation }}"
         style="background-color: {{ $colors[$type]['bg'] }};
                color: {{ $colors[$type]['text'] }};
                opacity: 0; transform: scale(0.9) translateY(30px);
                transition: all 0.3s ease-out;
                background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAQAAAAECAYAAACp8Z5+AAAAIklEQVQIW2NkQAKrVq36z8gAFkNnw4XAKpBF4IpgFTg5AK4WDREEYL5mAAAAAElFTkSuQmCC'); /* Tekstur kertas tipis */
               ">

        {{-- Efek Selotip (Tape) di atas --}}
        <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-24 h-7 opacity-80 shadow-inner -rotate-2 z-10"
             style="background-color: {{ $colors[$type]['tape'] }};
                    border: 1px solid rgba(0,0,0,0.05);
                    clip-path: polygon(0% 0%, 100% 0%, 98% 100%, 2% 100%); /* Bentuk selotip sedikit sobek */
                   ">
        </div>

        {{-- Tombol Tutup (Kanan Atas Note) --}}
        <button id="modal-close-btn"
                class="absolute top-2 right-2 transition-opacity opacity-40 hover:opacity-100 w-6 h-6 flex items-center justify-center rounded-full hover:bg-black/5"
                style="color: {{ $colors[$type]['text'] }};">
            <i class="fa-solid fa-xmark text-sm"></i>
        </button>

        {{-- Konten Note --}}
        <div class="flex flex-col items-center text-center gap-4 relative z-20">

            {{-- Icon ala Coretan Pena --}}
            <div id="modal-icon-box" class="shrink-0 text-3xl opacity-80 mt-2">
                 <i class="{{ $icons[$type] }}"></i>
            </div>

            <div class="flex-1 w-full">
                {{-- Judul ala Tulisan Tangan Bold --}}
                <h2 id="modal-title" class="text-xl md:text-2xl font-bold tracking-wide mb-2">
                    {{ $titles[$type] }}
                </h2>

                {{-- Pesan Utama (font-sans agar tetap terbaca jelas) --}}
                <p id="modal-message" class="text-sm leading-relaxed font-sans opacity-95">
                    {{ $message }}
                </p>

                {{-- Deskripsi Diary (Footer Note) --}}
                <div id="modal-desc" class="mt-5 pt-4 border-t border-black/10">
                    <p class="text-[11px] italic opacity-70 leading-relaxed relative">
                        {{-- Doodle bintang kecil di sudut deskripsi --}}
                        <i class="fa-solid fa-star text-[8px] absolute -left-3 top-0 animate-pulse"></i>
                        {{ $descriptions[$type] }}
                    </p>
                </div>
            </div>

        </div>

        {{-- Aksen Sudut Kertas Terlipat Kecil (Bottom Right) --}}
        <div class="absolute bottom-0 right-0 w-4 h-4 bg-black/5 rounded-tl-full pointer-events-none"></div>

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const modal = document.getElementById('global-modal');
        if (!modal) return;

        const backdrop = document.getElementById('modal-backdrop');
        const box = document.getElementById('modal-box');
        const closeBtn = document.getElementById('modal-close-btn');

        function showModal() {
            backdrop.style.opacity = '1';
            box.style.opacity = '1';
            box.style.transform = 'scale(1) translateY(0) rotate({{ $randomRotation == "rotate-1" ? "1deg" : ($randomRotation == "-rotate-2" ? "-2deg" : ($randomRotation == "-rotate-1" ? "-1deg" : "2deg")) }})';
        }

        function hideModal() {
            backdrop.style.opacity = '0';
            box.style.opacity = '0';
            box.style.transform = 'scale(0.9) translateY(30px)';
            setTimeout(() => modal.remove(), 300);
        }

        // Trigger animasi masuk
        setTimeout(showModal, 100);

        closeBtn.addEventListener('click', hideModal);
        backdrop.addEventListener('click', hideModal);

        // Auto close setelah 5 detik
        setTimeout(hideModal, 5000);
    });
</script>
@endif
