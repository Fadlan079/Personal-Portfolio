@extends('layouts.main')
@section('title', 'Contact')
@push('head')
    @vite('resources/css/contact.css')
@endpush
@section('content')

{{-- HERO --}}
<section id="contact-hero" class="py-34 max-w-7xl mx-auto px-6 space-y-10 overflow-hidden">
    <p class="contact-breadcrumb text-xs uppercase tracking-widest text-muted" data-i18n="contact.hero.breadcrumb">
        index / contact
    </p>

    <h1 class="contact-title text-[clamp(3.5rem,9vw,7rem)] font-semibold leading-[1.1]">
        <span data-i18n="contact.hero.title">Contact</span>
        <span class="block text-muted font-normal" data-i18n="contact.hero.subtitle">Drop a line.</span>
    </h1>

    <p class="contact-desc text-muted max-w-xl leading-relaxed" data-i18n="contact.hero.description">
        Whether you have a project in mind, a question, or just want to say hi,
        feel free to reach out. I'm always open to new conversations.
    </p>
</section>

{{-- REQUEST FOLDER --}}
<section id="request-section" class="max-w-6xl mx-auto px-6 py-32 space-y-16 overflow-hidden">

    <header id="request-header" class="space-y-4 max-w-xl">
        <p class="text-xs uppercase tracking-widest text-muted" data-i18n="contact.folder.breadcrumb">index / request</p>
        <h2 class="text-[clamp(2rem,4vw,3rem)] font-semibold leading-tight" data-i18n="contact.folder.title">Request folder</h2>
        <p class="text-muted leading-relaxed" data-i18n="contact.folder.description">Each message is stored as a request file and reviewed individually.</p>
    </header>

    <div class="grid md:grid-cols-[1fr_260px] gap-8 items-start">

        {{-- ══ FOLDER ══ --}}
        <div id="contact-folder" class="folder-wrap">

            {{-- Folder body --}}
            <div class="folder-body">

                {{-- Folder tab --}}
                <div class="folder-tab">
                    <span class="folder-tab-label">
                        <svg class="w-3 h-3 opacity-60" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 6a2 2 0 012-2h4l2 2h6a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                        </svg>
                        <span data-i18n="contact.folder.tab">Requests</span>
                    </span>
                    <span class="folder-tab-badge" data-i18n="contact.folder.badge">New</span>
                </div>

                {{-- Stacked file sheets (decorative) --}}
                <div class="folder-stack" aria-hidden="true">
                    <div class="folder-sheet folder-sheet-3"></div>
                    <div class="folder-sheet folder-sheet-2"></div>
                    <div class="folder-sheet folder-sheet-1"></div>
                </div>

                {{-- ── OPEN DOCUMENT (the form) ── --}}
                <div class="folder-doc">

                    <div class="folder-doc-header flex justify-between items-center bg-bg/50 px-4 py-3 border-b border-border">
                        <div class="flex items-center gap-2">
                            <div class="folder-doc-icon text-muted">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5l5 5v12a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <span class="folder-doc-title text-sm font-medium">request_new.txt</span>
                        </div>
                        
                        {{-- Method Tabs --}}
                        <div class="flex items-center gap-1 bg-muted/5 p-1 rounded-full border border-border/40" id="contact-method-tabs">
                            <button type="button" data-method="email" class="method-tab active px-4 py-1.5 text-[10px] uppercase tracking-[0.15em] font-medium rounded-full transition-all duration-300 bg-surface text-text shadow-sm border border-border/50">
                                Email
                            </button>
                            <button type="button" data-method="wa" class="method-tab px-4 py-1.5 text-[10px] uppercase tracking-[0.15em] font-medium rounded-full transition-all duration-300 text-muted hover:text-text border border-transparent">
                                WhatsApp
                            </button>
                        </div>
                    </div>

                    {{-- Doc fields --}}
                    <form action="{{ route('portofolio.contact.send') }}" method="POST">
                    @csrf
                    <div class="folder-doc-body">

                        <input type="hidden" name="method" id="input-method" value="{{ old('method', 'email') }}">

                        {{-- Metadata: type --}}
                        <div class="folder-doc-field">
                            <span class="folder-field-key" data-i18n="contact.folder.field_type">Type</span>
                            <div class="folder-field-val">
                                <label class="folder-chip-label">
                                    <input type="radio" name="type" value="project" class="sr-only" {{ old('type', 'project') === 'project' ? 'checked' : '' }}>
                                    <span data-i18n="contact.folder.chip_project">New project</span>
                                </label>
                                <label class="folder-chip-label">
                                    <input type="radio" name="type" value="collab" class="sr-only" {{ old('type') === 'collab' ? 'checked' : '' }}>
                                    <span data-i18n="contact.folder.chip_collab">Collaboration</span>
                                </label>
                                <label class="folder-chip-label">
                                    <input type="radio" name="type" value="inquiry" class="sr-only" {{ old('type') === 'inquiry' ? 'checked' : '' }}>
                                    <span data-i18n="contact.folder.chip_inquiry">Inquiry</span>
                                </label>
                            </div>
                        </div>

                        {{-- Metadata: sender --}}
                        <div class="folder-doc-field">
                            <span class="folder-field-key" id="label-sender" data-i18n="contact.folder.field_from">From</span>
                            <div class="folder-field-val">
                                <input type="text" name="sender" id="input-sender" class="folder-field-input {{ $errors->has('sender') ? 'border-red-500' : '' }}"
                                       placeholder="your@email.com"
                                       value="{{ old('sender') }}"
                                       data-i18n-placeholder="contact.folder.field_from_placeholder">
                                @error('sender')<span class="text-[10px] text-red-400 mt-1 block">{{ $message }}</span>@enderror
                                <p id="helper-sender" class="text-[10px] text-muted mt-1 hidden">Enter your WhatsApp number (e.g., 0812... or +62812...)</p>
                            </div>
                        </div>

                        {{-- Metadata: subject --}}
                        <div class="folder-doc-field">
                            <span class="folder-field-key" data-i18n="contact.folder.field_subject">Subject</span>
                            <div class="folder-field-val">
                                <input type="text" name="subject" class="folder-field-input {{ $errors->has('subject') ? 'border-red-500' : '' }}"
                                       placeholder="Brief title of your request"
                                       value="{{ old('subject') }}"
                                       data-i18n-placeholder="contact.folder.field_subject_placeholder">
                                @error('subject')<span class="text-[10px] text-red-400 mt-1 block">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        {{-- Divider --}}
                        <div class="folder-doc-divider"></div>

                        {{-- Body --}}
                        <div class="folder-doc-body-field">
                            <textarea rows="5" name="message" class="folder-field-area"
                                      placeholder="Write your message here…"
                                      data-i18n-placeholder="contact.folder.field_message_placeholder">{{ old('message') }}</textarea>
                            @error('message')<span class="text-[10px] text-red-400 mt-1 block">{{ $message }}</span>@enderror
                        </div>

                        {{-- Footer --}}
                        <div class="folder-doc-footer">
                            <span class="folder-footer-meta">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ now()->format('d M Y') }}
                            </span>
                            <button type="submit" class="folder-send-btn">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M3 10l9-7 9 7v8a2 2 0 01-2 2H5a2 2 0 01-2-2v-8z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M9 21V12h6v9"/>
                                </svg>
                                <span data-i18n="contact.folder.submit">Drop in folder</span>
                            </button>
                        </div>

                    </div>
                    </form>
                </div>
                {{-- end open doc --}}

            </div>
        </div>

        {{-- ══ SIDEBAR: filed items ══ --}}
        <div id="system-note" class="hidden md:flex flex-col gap-4 pt-14">

            <p class="text-[10px] uppercase tracking-widest text-muted" data-i18n="contact.folder.filed">Filed</p>

            {{-- mini file card --}}
            <div class="folder-mini-card">
                <div class="folder-mini-dot bg-[var(--color-success)]"></div>
                <div>
                    <p class="text-xs font-medium">request_01.txt</p>
                    <p class="text-[10px] text-muted mt-0.5" data-i18n="contact.folder.req_01_status">Reviewed · Jan 2025</p>
                </div>
            </div>

            <div class="folder-mini-card">
                <div class="folder-mini-dot bg-[var(--color-warning)]"></div>
                <div>
                    <p class="text-xs font-medium">request_02.txt</p>
                    <p class="text-[10px] text-muted mt-0.5" data-i18n="contact.folder.req_02_status">Pending · Feb 2025</p>
                </div>
            </div>

            <div class="folder-mini-card opacity-40">
                <div class="folder-mini-dot bg-[var(--color-border)]"></div>
                <div>
                    <p class="text-xs font-medium">request_new.txt</p>
                    <p class="text-[10px] text-muted mt-0.5" data-i18n="contact.folder.req_new_status">Draft · now</p>
                </div>
            </div>

            <p class="text-xs text-muted leading-relaxed border-t border-border pt-5 mt-2" data-i18n="contact.folder.sidebar_note">
                This folder accepts limited requests. Responses may take 2–5 days.
            </p>
        </div>

    </div>
</section>


{{-- SOCIAL LINKS --}}
<section id="social-section" class="max-w-6xl mx-auto px-6 pb-40 space-y-14">

    <header id="social-header" class="space-y-4 max-w-xl">
        <p class="text-xs uppercase tracking-widest text-muted" data-i18n="contact.social.breadcrumb">
            index / social
        </p>
        <h2 class="text-[clamp(2rem,4vw,3rem)] font-semibold leading-tight" data-i18n="contact.social.title">
            Find me elsewhere
        </h2>
        <p class="text-muted leading-relaxed" data-i18n="contact.social.description">
            Other places where I share work, thoughts, and ongoing experiments.
        </p>
    </header>

    <div id="social-cards-grid" class="grid md:grid-cols-3 gap-px bg-border">

        {{-- Instagram --}}
        <a href="https://instagram.com/fdln007"
           target="_blank"
           rel="noopener"
           class="social-card group relative bg-surface p-8 flex flex-col justify-between min-h-[260px] overflow-hidden">

            {{-- Glyph watermark --}}
            <span class="social-glyph absolute bottom-4 right-4 text-[7rem] font-black leading-none text-muted/[0.05] select-none pointer-events-none transition-transform duration-700 group-hover:scale-110 group-hover:text-muted/[0.09]">IG</span>

            <div class="space-y-3">
                <div class="flex items-center justify-between">
                <span class="text-[10px] uppercase tracking-widest text-muted" data-i18n="contact.social.platform">Platform</span>
                    <span class="social-arrow text-muted group-hover:text-primary transition-colors duration-300">
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1 group-hover:-translate-y-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 17L17 7M17 7H7M17 7v10"/>
                        </svg>
                    </span>
                </div>
                <p class="text-xs uppercase tracking-widest font-semibold">Instagram</p>
            </div>

            <div class="mt-auto pt-8 space-y-2">
                <div class="social-card-line h-px bg-border w-full origin-left"></div>
                <p class="text-xl font-semibold tracking-tight group-hover:text-primary transition-colors duration-300">
                    @fdln007
                </p>
            </div>
        </a>

        {{-- GitHub --}}
        <a href="https://github.com/Fadlan079"
           target="_blank"
           rel="noopener"
           class="social-card group relative bg-surface p-8 flex flex-col justify-between min-h-[260px] overflow-hidden">

            <span class="social-glyph absolute bottom-4 right-4 text-[7rem] font-black leading-none text-muted/[0.05] select-none pointer-events-none transition-transform duration-700 group-hover:scale-110 group-hover:text-muted/[0.09]">GH</span>

            <div class="space-y-3">
                <div class="flex items-center justify-between">
                <span class="text-[10px] uppercase tracking-widest text-muted" data-i18n="contact.social.platform">Platform</span>
                    <span class="social-arrow text-muted group-hover:text-primary transition-colors duration-300">
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1 group-hover:-translate-y-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 17L17 7M17 7H7M17 7v10"/>
                        </svg>
                    </span>
                </div>
                <p class="text-xs uppercase tracking-widest font-semibold">GitHub</p>
            </div>

            <div class="mt-auto pt-8 space-y-2">
                <div class="social-card-line h-px bg-border w-full origin-left"></div>
                <p class="text-xl font-semibold tracking-tight group-hover:text-primary transition-colors duration-300">
                    Fadlan079
                </p>
            </div>
        </a>

        {{-- LinkedIn --}}
        <a href="https://www.linkedin.com/in/fadlan-firdaus-148344386 "
           target="_blank"
           rel="noopener"
           class="social-card group relative bg-surface p-8 flex flex-col justify-between min-h-[260px] overflow-hidden">

            <span class="social-glyph absolute bottom-4 right-4 text-[7rem] font-black leading-none text-muted/[0.05] select-none pointer-events-none transition-transform duration-700 group-hover:scale-110 group-hover:text-muted/[0.09]">LI</span>

            <div class="space-y-3">
                <div class="flex items-center justify-between">
                <span class="text-[10px] uppercase tracking-widest text-muted" data-i18n="contact.social.platform">Platform</span>
                    <span class="social-arrow text-muted group-hover:text-primary transition-colors duration-300">
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1 group-hover:-translate-y-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 17L17 7M17 7H7M17 7v10"/>
                        </svg>
                    </span>
                </div>
                <p class="text-xs uppercase tracking-widest font-semibold">LinkedIn</p>
            </div>

            <div class="mt-auto pt-8 space-y-2">
                <div class="social-card-line h-px bg-border w-full origin-left"></div>
                <p class="text-xl font-semibold tracking-tight group-hover:text-primary transition-colors duration-300">
                    fadlanfirdaus
                </p>
            </div>
        </a>

    </div>
</section>


<section id="contact-end" class="relative py-32 border-t border-border overflow-hidden">
    <div class="relative z-10 max-w-6xl mx-auto px-6 grid md:grid-cols-[1fr_auto] gap-10 items-end">
        
        <div class="space-y-8">
            <p class="end-breadcrumb text-xs uppercase tracking-widest text-muted">
                index / end
            </p>
            <h3 class="end-title text-[clamp(2rem,5vw,3rem)] font-semibold leading-tight max-w-2xl" data-i18n="contact.end.title">
                Good conversations start with a simple message.
            </h3>
            <p class="end-desc text-muted max-w-xl leading-relaxed" data-i18n="contact.end.description">
                Clear intent, honest communication, and mutual respect are the
                foundation of any meaningful collaboration.
            </p>
        </div>

        <div class="hidden md:flex items-center justify-center w-32 h-32 border border-muted/30 rounded-full rotate-12 opacity-60 pointer-events-none select-none">
            <div class="text-[10px] uppercase tracking-[0.2em] text-muted text-center leading-relaxed">
                <span class="block border-b border-muted/30 pb-1 mb-1">Status</span>
                Open for<br>Collabs
            </div>
        </div>

    </div>
</section>

@endsection

@push('head')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.method-tab');
    const inputMethod = document.getElementById('input-method');
    const inputSender = document.getElementById('input-sender');
    const labelSender = document.getElementById('label-sender');
    const helperSender = document.getElementById('helper-sender');
    
    // Translations logic if available via i18n
    const transFromEmail = "From"; // default fallback
    const transFromWa = "WhatsApp"; // default fallback
    
    // Check session for wa url
    @if(session('wa_url'))
        window.open('{{ session('wa_url') }}', '_blank');
    @endif

    // Initialization using old input if validation failed
    setMethod(inputMethod.value || 'email');

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            setMethod(this.dataset.method);
        });
    });

    function setMethod(method) {
        // Update styling
        tabs.forEach(t => {
            if (t.dataset.method === method) {
                // Active styles
                t.classList.remove('text-muted', 'hover:text-text', 'border-transparent');
                t.classList.add('bg-surface', 'text-text', 'shadow-sm', 'border-border/50');
            } else {
                // Inactive styles
                t.classList.add('text-muted', 'hover:text-text', 'border-transparent');
                t.classList.remove('bg-surface', 'text-text', 'shadow-sm', 'border-border/50');
            }
        });

        // Update hidden input
        inputMethod.value = method;

        // Update fields based on method
        if (method === 'wa') {
            labelSender.textContent = transFromWa;
            labelSender.removeAttribute('data-i18n'); // disable generic translation for this
            inputSender.type = 'tel';
            inputSender.placeholder = '0812...';
            inputSender.removeAttribute('data-i18n-placeholder');
            helperSender.classList.remove('hidden');
        } else {
            labelSender.textContent = transFromEmail;
            labelSender.setAttribute('data-i18n', 'contact.folder.field_from');
            inputSender.type = 'email';
            inputSender.placeholder = 'your@email.com';
            inputSender.setAttribute('data-i18n-placeholder', 'contact.folder.field_from_placeholder');
            helperSender.classList.add('hidden');
        }
    }
});
</script>
@endpush
