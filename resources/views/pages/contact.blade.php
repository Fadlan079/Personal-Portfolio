@extends('layouts.main')
@section('title', 'Contact')
@push('head')
    @vite('resources/css/contact.css')
@endpush
@section('content')

{{-- HERO --}}
<section id="contact-hero" class="py-34 max-w-7xl mx-auto px-6 space-y-10 overflow-hidden">
    <p class="contact-breadcrumb text-xs uppercase tracking-widest text-muted">
        index / contact
    </p>

    <h1 class="contact-title text-[clamp(3.5rem,9vw,7rem)] font-semibold leading-[1.1]">
        <span>Contact</span>
        <span class="block text-muted font-normal">Let's talk.</span>
    </h1>

    <p class="contact-desc text-muted max-w-xl leading-relaxed">
        Whether you have a project in mind, a question, or just want to say hi,
        feel free to reach out. I'm always open to new conversations.
    </p>
</section>

{{-- REQUEST FOLDER --}}
<section id="request-section" class="max-w-6xl mx-auto px-6 py-32 space-y-16">

    <header id="request-header" class="space-y-4 max-w-xl">
        <p class="text-xs uppercase tracking-widest text-muted">index / request</p>
        <h2 class="text-[clamp(2rem,4vw,3rem)] font-semibold leading-tight">Request folder</h2>
        <p class="text-muted leading-relaxed">Each message is stored as a request file and reviewed individually.</p>
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
                        Requests
                    </span>
                    <span class="folder-tab-badge">New</span>
                </div>

                {{-- Stacked file sheets (decorative) --}}
                <div class="folder-stack" aria-hidden="true">
                    <div class="folder-sheet folder-sheet-3"></div>
                    <div class="folder-sheet folder-sheet-2"></div>
                    <div class="folder-sheet folder-sheet-1"></div>
                </div>

                {{-- ── OPEN DOCUMENT (the form) ── --}}
                <div class="folder-doc">

                    {{-- Doc top bar --}}
                    <div class="folder-doc-header">
                        <div class="folder-doc-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5l5 5v12a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <span class="folder-doc-title">request_new.txt</span>
                        <span class="folder-doc-status">● Draft</span>
                    </div>

                    {{-- Doc fields --}}
                    <div class="folder-doc-body">

                        {{-- Metadata: type --}}
                        <div class="folder-doc-field">
                            <span class="folder-field-key">Type</span>
                            <div class="folder-field-val">
                                <label class="folder-chip-label">
                                    <input type="radio" name="req_type" value="project" class="sr-only" checked>
                                    <span>New project</span>
                                </label>
                                <label class="folder-chip-label">
                                    <input type="radio" name="req_type" value="collab" class="sr-only">
                                    <span>Collaboration</span>
                                </label>
                                <label class="folder-chip-label">
                                    <input type="radio" name="req_type" value="inquiry" class="sr-only">
                                    <span>Inquiry</span>
                                </label>
                            </div>
                        </div>

                        {{-- Metadata: sender --}}
                        <div class="folder-doc-field">
                            <span class="folder-field-key">From</span>
                            <div class="folder-field-val">
                                <input type="email" class="folder-field-input"
                                       placeholder="your@email.com">
                            </div>
                        </div>

                        {{-- Metadata: subject --}}
                        <div class="folder-doc-field">
                            <span class="folder-field-key">Subject</span>
                            <div class="folder-field-val">
                                <input type="text" class="folder-field-input"
                                       placeholder="Brief title of your request">
                            </div>
                        </div>

                        {{-- Divider --}}
                        <div class="folder-doc-divider"></div>

                        {{-- Body --}}
                        <div class="folder-doc-body-field">
                            <textarea rows="5" class="folder-field-area"
                                      placeholder="Write your message here…"></textarea>
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
                            <button class="folder-send-btn">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M3 10l9-7 9 7v8a2 2 0 01-2 2H5a2 2 0 01-2-2v-8z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M9 21V12h6v9"/>
                                </svg>
                                Drop in folder
                            </button>
                        </div>

                    </div>
                </div>
                {{-- end open doc --}}

            </div>
        </div>

        {{-- ══ SIDEBAR: filed items ══ --}}
        <div id="system-note" class="hidden md:flex flex-col gap-4 pt-14">

            <p class="text-[10px] uppercase tracking-widest text-muted">Filed</p>

            {{-- mini file card --}}
            <div class="folder-mini-card">
                <div class="folder-mini-dot bg-[var(--color-success)]"></div>
                <div>
                    <p class="text-xs font-medium">request_01.txt</p>
                    <p class="text-[10px] text-muted mt-0.5">Reviewed · Jan 2025</p>
                </div>
            </div>

            <div class="folder-mini-card">
                <div class="folder-mini-dot bg-[var(--color-warning)]"></div>
                <div>
                    <p class="text-xs font-medium">request_02.txt</p>
                    <p class="text-[10px] text-muted mt-0.5">Pending · Feb 2025</p>
                </div>
            </div>

            <div class="folder-mini-card opacity-40">
                <div class="folder-mini-dot bg-[var(--color-border)]"></div>
                <div>
                    <p class="text-xs font-medium">request_new.txt</p>
                    <p class="text-[10px] text-muted mt-0.5">Draft · now</p>
                </div>
            </div>

            <p class="text-xs text-muted leading-relaxed border-t border-border pt-5 mt-2">
                This folder accepts limited requests. Responses may take 2–5 days.
            </p>
        </div>

    </div>
</section>


{{-- SOCIAL LINKS --}}
<section id="social-section" class="max-w-6xl mx-auto px-6 pb-40 space-y-14">

    <header id="social-header" class="space-y-4 max-w-xl">
        <p class="text-xs uppercase tracking-widest text-muted">
            index / social
        </p>
        <h2 class="text-[clamp(2rem,4vw,3rem)] font-semibold leading-tight">
            Find me elsewhere
        </h2>
        <p class="text-muted leading-relaxed">
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
                    <span class="text-[10px] uppercase tracking-widest text-muted">Platform</span>
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
                    <span class="text-[10px] uppercase tracking-widest text-muted">Platform</span>
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
        <a href="https://linkedin.com/in/fadlanfirdaus"
           target="_blank"
           rel="noopener"
           class="social-card group relative bg-surface p-8 flex flex-col justify-between min-h-[260px] overflow-hidden">

            <span class="social-glyph absolute bottom-4 right-4 text-[7rem] font-black leading-none text-muted/[0.05] select-none pointer-events-none transition-transform duration-700 group-hover:scale-110 group-hover:text-muted/[0.09]">LI</span>

            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] uppercase tracking-widest text-muted">Platform</span>
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


{{-- END --}}
<section id="contact-end" class="py-32 border-t border-border overflow-hidden">
    <div class="end-line h-0 border-t border-border origin-left"></div>
    <div class="max-w-6xl mx-auto px-6 space-y-10">

        <p class="end-breadcrumb text-xs uppercase tracking-widest text-muted">
            index / end
        </p>

        <h3 class="end-title text-[clamp(2rem,5vw,3rem)] font-semibold leading-tight max-w-2xl">
            Good conversations start with a simple message.
        </h3>

        <p class="end-desc text-muted max-w-xl leading-relaxed">
            Clear intent, honest communication, and mutual respect are the
            foundation of any meaningful collaboration.
        </p>

    </div>
</section>

@endsection
