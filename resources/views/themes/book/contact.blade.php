@extends('layouts.main')
@section('title', 'Contact')

@push('head')
<style>
    .bg-journal {
        background-color: var(--color-bg);
        position: relative;
    }

    .bg-journal::before {
        content: "";
        position: absolute;
        inset: 0;
        pointer-events: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.15'/%3E%3C/svg%3E");
    }

    .bg-journal {
        background-color: var(--color-bg);
        box-shadow: inset 0 0 80px rgba(0,0,0,0.05);
    }

    .letter-paper {
        background-color: var(--color-surface);
        border: 1px solid var(--color-border);
        box-shadow: 0 10px 30px -10px rgba(0,0,0,0.05);
        border-radius: 0.5rem;
        position: relative;
    }

    .journal-input {
        width: 100%;
        background-color: transparent;
        border: none;
        border-bottom: 2px dashed var(--color-border);
        padding: 0.75rem 0;
        font-family: var(--font-sans);
        font-size: 1rem;
        color: var(--color-text);
        transition: border-color 0.3s;
    }

    .journal-input:focus {
        outline: none;
        border-bottom-style: solid;
        border-bottom-color: var(--color-primary);
    }

    .journal-input::placeholder {
        color: color-mix(in srgb, var(--color-muted) 50%, transparent);
        font-style: italic;
    }

    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    .scroll-fade {
        mask-image: none;
    }

    @media (max-width: 640px) {
        .scroll-fade {
            mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
        }
    }
</style>
@endpush

@section('content')
<div class="bg-journal min-h-screen font-sans text-text pb-20 selection:bg-muted/30">

    <section id="contact-hero" class="relative z-10 pt-32 pb-10 max-w-5xl mx-auto px-5 md:px-8 text-center">

        <div class="relative inline-flex items-center gap-2.5 py-2 pl-9 pr-7 mb-6 transition-all duration-300 w-max group hover:-translate-y-0.5 hover:rotate-1"
            style="filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.06));">

            <div class="absolute inset-0 bg-warning border border-yellow-500 rounded-l-md z-0 transition-colors"
                style="clip-path: polygon(0 0, 100% 0, 93% 50%, 100% 100%, 0 100%);">
            </div>

            <div class="absolute top-1/2 -left-5 w-7 h-[1.5px] bg-[#8B0000]/80 -translate-y-[calc(50%+1px)] origin-right -rotate-12 group-hover:-rotate-6 transition-transform duration-300 rounded-l-full z-0"></div>
            <div class="absolute top-1/2 -left-4 w-6 h-[1.5px] bg-[#B22222]/80 -translate-y-[calc(50%-1px)] origin-right rotate-12 group-hover:rotate-6 transition-transform duration-300 rounded-l-full z-0"></div>

            <div class="absolute left-3 top-1/2 -translate-y-1/2 w-3 h-3 rounded-full bg-surface shadow-[inset_1px_1px_3px_rgba(0,0,0,0.3)] border border-yellow-700/30 z-10"></div>

            <i class="fa-regular fa-paper-plane relative z-10 text-yellow-800 text-xs mt-px group-hover:translate-x-0.5 transition-transform duration-300"></i>

            <span class="relative z-10 text-[10px] sm:text-[11px] font-black tracking-[0.15em] uppercase text-yellow-900 mt-px"
            data-i18n="contact.header.label">
                Saluran Komunikasi Terbuka
            </span>
        </div>

        <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold tracking-tighter leading-[1.1] text-text mb-4"
        data-i18n="contact.header.main_title">
            Mari Berdiskusi.
        </h1>

        <p class="text-lg text-muted max-w-2xl mx-auto leading-relaxed font-medium"
        data-i18n="contact.header.description">
            Punya proyek, pertanyaan, atau kritik dan saran? Silakan kirim pesan Anda di bawah.
        </p>

    </section>

    <section id="request-section" class="relative z-10 max-w-6xl mx-auto px-5 md:px-8 py-10">

        <div class="grid lg:grid-cols-[1fr_350px] gap-8 items-start">

            <div class="letter-paper p-6 md:p-12 overflow-hidden sm:overflow-visible">

                <div class="absolute -top-3 -left-4 w-20 h-8 bg-surface/80 backdrop-blur-sm border border-border/50 shadow-sm rotate-[-5deg] z-20"></div>

                <div class="absolute top-8 right-8 w-20 h-20 rounded-full border-[3px] border-primary/30 flex items-center justify-center opacity-40 rotate-[15deg] pointer-events-none select-none hidden sm:flex">
                    <span class="text-[9px] font-black uppercase tracking-[0.2em] text-primary text-center leading-tight border-y border-primary/30 py-1 px-2">
                        POST<br>2026
                    </span>
                </div>

                <div class="mb-10">
                    <h2 class="text-3xl font-bold text-text mb-2" data-i18n="contact.form.title">Tulis Pesan</h2>
                    <p class="text-sm text-muted" data-i18n="contact.form.description">Isi form di bawah dan pesan Anda akan dikirim via Email.</p>
                </div>

                <form action="{{ route('portofolio.contact.send') }}" method="POST" class="space-y-8 relative z-10">
                    @csrf

                    <div class="space-y-3 w-full">
                        <label class="text-[11px] font-bold uppercase tracking-widest text-muted"
                        data-i18n="contact.form.type_label">
                            Jenis Pesan:
                        </label>

                        <div class="flex flex-nowrap gap-4 overflow-x-auto w-full no-scrollbar pb-4 pt-1 px-2 -mx-2 scroll-smooth">

                            <label class="cursor-pointer shrink-0">
                                <input type="radio" name="type" value="project" class="peer sr-only" {{ old('type', 'project') === 'project' ? 'checked' : '' }}>
                                <div class="px-6 py-2.5 rounded-full text-[10px] font-bold uppercase tracking-widest transition-all bg-container border-2 border-border text-muted shadow-[1px_2px_0px_var(--color-border)] hover:shadow-[3px_4px_0px_var(--color-border)] hover:-translate-y-1 hover:-rotate-1 peer-checked:bg-warning peer-checked:text-yellow-900 peer-checked:border-yellow-500 peer-checked:shadow-[2px_3px_0px_var(--color-border)] peer-checked:-translate-y-1 peer-checked:rotate-1"
                                data-i18n="contact.form.types.project">
                                    Inisiasi Proyek
                                </div>
                            </label>

                            <label class="cursor-pointer shrink-0">
                                <input type="radio" name="type" value="collab" class="peer sr-only" {{ old('type') === 'collab' ? 'checked' : '' }}>
                                <div class="px-6 py-2.5 rounded-full text-[10px] font-bold uppercase tracking-widest transition-all bg-container border-2 border-border text-muted shadow-[1px_2px_0px_var(--color-border)] hover:shadow-[3px_4px_0px_var(--color-border)] hover:-translate-y-1 hover:rotate-1 peer-checked:bg-warning peer-checked:text-yellow-900 peer-checked:border-yellow-500 peer-checked:shadow-[2px_3px_0px_var(--color-border)] peer-checked:-translate-y-1 peer-checked:-rotate-1"
                                data-i18n="contact.form.types.collab">
                                    Kolaborasi
                                </div>
                            </label>

                            <label class="cursor-pointer shrink-0">
                                <input type="radio" name="type" value="inquiry" class="peer sr-only" {{ old('type') === 'inquiry' ? 'checked' : '' }}>
                                <div class="px-6 py-2.5 rounded-full text-[10px] font-bold uppercase tracking-widest transition-all bg-container border-2 border-border text-muted shadow-[1px_2px_0px_var(--color-border)] hover:shadow-[3px_4px_0px_var(--color-border)] hover:-translate-y-1 hover:-rotate-1 peer-checked:bg-warning peer-checked:text-yellow-900 peer-checked:border-yellow-500 peer-checked:shadow-[2px_3px_0px_var(--color-border)] peer-checked:-translate-y-1 peer-checked:rotate-1"
                                data-i18n="contact.form.types.inquiry">
                                    Pertanyaan Umum
                                </div>
                            </label>

                            <label class="cursor-pointer shrink-0">
                                <input type="radio" name="type" value="feedback" class="peer sr-only" {{ old('type') === 'feedback' ? 'checked' : '' }}>
                                <div class="px-6 py-2.5 rounded-full text-[10px] font-bold uppercase tracking-widest transition-all bg-container border-2 border-border text-muted shadow-[1px_2px_0px_var(--color-border)] hover:shadow-[3px_4px_0px_var(--color-border)] hover:-translate-y-1 hover:rotate-1 peer-checked:bg-warning peer-checked:text-yellow-900 peer-checked:border-yellow-500 peer-checked:shadow-[2px_3px_0px_var(--color-border)] peer-checked:-translate-y-1 peer-checked:-rotate-1"
                                data-i18n="contact.form.types.feedback">
                                    Kritik & Saran
                                </div>
                            </label>

                        </div>
                    </div>

                    <div class="space-y-1 mt-6">
                        <label for="input-sender" class="text-[11px] font-bold uppercase tracking-widest text-muted"
                        data-i18n="contact.form.sender_label">
                            Dikirim Dari (Email):
                        </label>
                        <input type="email" name="sender" id="input-sender" class="journal-input {{ $errors->has('sender') ? 'border-red-500 text-red-500' : '' }}"
                        placeholder="email.anda@domain.com" value="{{ old('sender') }}">
                        @error('sender')
                            <p class="text-xs text-red-500 mt-1 font-medium"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="input-subject" class="text-[11px] font-bold uppercase tracking-widest text-muted"
                        data-i18n="contact.form.subject_label">
                            Judul Pesan:
                        </label>
                        <input type="text" name="subject" id="input-subject" class="journal-input {{ $errors->has('subject') ? 'border-red-500 text-red-500' : '' }}"
                        placeholder="Tulis judul pesan di sini..." value="{{ old('subject') }}">
                        @error('subject')
                            <p class="text-xs text-red-500 mt-1 font-medium"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="input-message" class="text-[11px] font-bold uppercase tracking-widest text-muted"
                        data-i18n="contact.form.message_label">
                            Isi Pesan:
                        </label>
                        <textarea rows="4" name="message" id="input-message" class="journal-input resize-y {{ $errors->has('message') ? 'border-red-500 text-red-500' : '' }}"
                            placeholder="Ceritakan detail kebutuhan atau pertanyaan Anda...">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-xs text-red-500 mt-1 font-medium"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-6 border-t border-border/50">
                        <p class="text-xs font-bold text-muted flex items-center gap-2">
                            <i class="fa-regular fa-calendar text-primary"></i>
                            <span data-i18n="contact.date_label">Tanggal:</span> {{ now()->translatedFormat('d F Y') }}
                        </p>

                        <button type="submit" class="w-full sm:w-auto px-8 py-4 bg-text text-bg rounded-xl font-bold uppercase tracking-widest hover:-translate-y-1 transition-transform shadow-md flex items-center justify-center gap-3">
                            <span data-i18n="contact.submit_button">Kirim Surat</span>
                            <i class="fa-regular fa-paper-plane"></i>
                        </button>
                    </div>

                </form>
            </div>

            <div class="space-y-6">

                @php
                    $siteUser = \App\Models\User::first();
                    $igRaw = $siteUser?->instagram ?? '@fdln007';
                    $igLink = str_starts_with($igRaw, 'http') ? $igRaw : 'https://instagram.com/' . ltrim($igRaw, '@');
                    $ghRaw = $siteUser?->github ?? 'Fadlan079';
                    $ghLink = str_starts_with($ghRaw, 'http') ? $ghRaw : 'https://github.com/' . ltrim($ghRaw, '@');
                    $liRaw = $siteUser?->linkedin ?? 'fadlanfirdaus';
                    $liLink = str_starts_with($liRaw, 'http') ? $liRaw : 'https://linkedin.com/in/' . ltrim($liRaw, '@');
                @endphp

                <div class="pb-2 border-b border-border/50">
                    <p class="text-xs font-bold uppercase tracking-widest text-muted"
                    data-i18n="contact.alternative_networks">Jaringan Alternatif</p>
                </div>

                <a href="{{ $ghLink }}" target="_blank" class="block bg-surface p-5 rounded-xl border border-border shadow-sm hover:border-primary hover:-translate-y-1 transition-all group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-container flex items-center justify-center text-muted group-hover:text-primary group-hover:bg-primary/10 transition-colors">
                            <i class="fa-brands fa-github text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-text">GitHub</h3>
                            <p class="text-sm text-muted" data-i18n="contact.social.github.description">Lihat Repositori</p>
                        </div>
                        <i class="fa-solid fa-arrow-right ml-auto text-muted group-hover:text-primary transition-colors"></i>
                    </div>
                </a>

                <a href="{{ $liLink }}" target="_blank" class="block bg-surface p-5 rounded-xl border border-border shadow-sm hover:border-primary hover:-translate-y-1 transition-all group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-container flex items-center justify-center text-muted group-hover:text-primary group-hover:bg-primary/10 transition-colors">
                            <i class="fa-brands fa-linkedin text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-text">LinkedIn</h3>
                            <p class="text-sm text-muted" data-i18n="contact.social.linkedin.description">Koneksi Profesional</p>
                        </div>
                        <i class="fa-solid fa-arrow-right ml-auto text-muted group-hover:text-primary transition-colors"></i>
                    </div>
                </a>

                <a href="{{ $igLink }}" target="_blank" class="block bg-surface p-5 rounded-xl border border-border shadow-sm hover:border-primary hover:-translate-y-1 transition-all group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-container flex items-center justify-center text-muted group-hover:text-primary group-hover:bg-primary/10 transition-colors">
                            <i class="fa-brands fa-instagram text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-text">Instagram</h3>
                            <p class="text-sm text-muted" data-i18n="contact.social.instagram.description">Log Personal</p>
                        </div>
                        <i class="fa-solid fa-arrow-right ml-auto text-muted group-hover:text-primary transition-colors"></i>
                    </div>
                </a>

                <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode('Selamat siang! Saya tertarik berdiskusi tentang [topik/proyek] Anda.') }}"
                target="_blank"
                class="block bg-surface p-5 rounded-xl border border-border shadow-sm hover:border-primary hover:-translate-y-1 transition-all group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-container flex items-center justify-center text-muted group-hover:text-primary group-hover:bg-primary/10 transition-colors">
                            <i class="fa-brands fa-whatsapp text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-text">WhatsApp</h3>
                            <p class="text-sm text-muted" data-i18n="contact.social.whatsapp.description">Chat Langsung</p>
                        </div>
                        <i class="fa-solid fa-arrow-right ml-auto text-muted group-hover:text-primary transition-colors"></i>
                    </div>
                </a>

                <div class="mt-8 bg-warning text-yellow-900 p-5 shadow-md md:rotate-[2deg] border-l-4 border-yellow-500 rounded-r-md">
                    <p class="text-[10px] font-black uppercase tracking-widest mb-2 opacity-80 border-b border-yellow-900/20 pb-2" data-i18n="contact.notes.label">
                        Catatan
                    </p>
                    <p class="text-sm font-semibold leading-relaxed" data-i18n="contact.notes.description">
                        Pesan Anda akan dibaca sesegera mungkin. Waktu respons rata-rata adalah 1 hingga 2 hari kerja.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <section id="contact-end" class="relative py-16 mt-10 border-t border-border/50 text-center">
        <div class="max-w-4xl mx-auto px-6">
            <h3 class="text-xl font-bold text-muted mb-2 font-serif italic" data-i18n="contact.footer.text">Menunggu pesan Anda...</h3>
            <div class="w-16 h-1 bg-border mx-auto rounded-full mt-6"></div>
        </div>
    </section>

</div>
@endsection
