@extends('layouts.dashboard')
@section('title', 'System Settings')

@section('content')
    <div class="min-h-screen bg-background pt-24 pb-12 px-6">
        <form action="{{ route('dashboard.settings.update') }}" method="POST" class="space-y-12">
            @csrf
            @method('PUT')

            <div class="space-y-2 border-b border-border/50 pb-8">
                <div class="flex items-center gap-3 font-mono mb-4">
                    <span
                        class="px-2 py-1 bg-primary/10 text-primary border border-primary/20 text-[10px] uppercase tracking-widest">
                        SYS.CONFIG
                    </span>
                    <span class="text-xs text-muted">/preferences</span>
                </div>
                <h1 class="text-3xl md:text-4xl font-bold font-mono tracking-tighter uppercase text-text">
                    System Preferences
                </h1>
                <p class="text-sm text-muted">Configure your local environment parameters, interface themes, and regional
                    settings.</p>
            </div>

            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-sm font-bold font-mono uppercase tracking-widest text-text">
                        <i class="fa-solid fa-desktop mr-2 text-primary"></i> Interface Theme
                    </h2>
                    <span class="text-[10px] text-muted font-mono uppercase">Parameter_01</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <label class="relative cursor-pointer group">
                        <input type="radio" name="theme" value="light" class="peer sr-only"
                            {{ auth()->user()->theme === 'light' ? 'checked' : '' }}>
                        <div
                            class="h-32 rounded-xl border-2 border-border bg-surface/30 p-4 hover:bg-surface transition-colors peer-checked:border-primary peer-checked:bg-primary/5">
                            <div
                                class="w-full h-12 bg-white rounded border border-gray-200 mb-4 flex flex-col gap-1.5 p-2 shadow-sm">
                                <div class="w-1/3 h-2 bg-gray-200 rounded"></div>
                                <div class="w-2/3 h-2 bg-gray-100 rounded"></div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="font-mono text-xs font-bold text-text uppercase">Light</span>
                                <i class="fa-regular fa-sun text-muted group-hover:text-text peer-checked:text-primary"></i>
                            </div>
                        </div>
                        <div
                            class="absolute top-3 right-3 w-3 h-3 rounded-full bg-primary scale-0 transition-transform peer-checked:scale-100 shadow-[0_0_8px_var(--color-primary)]">
                        </div>
                    </label>

                    <label class="relative cursor-pointer group">
                        <input type="radio" name="theme" value="dark" class="peer sr-only"
                            {{ auth()->user()->theme === 'dark' ? 'checked' : '' }}>
                        <div
                            class="h-32 rounded-xl border-2 border-border bg-surface/30 p-4 hover:bg-surface transition-colors peer-checked:border-primary peer-checked:bg-primary/5">
                            <div
                                class="w-full h-12 bg-[#121212] rounded border border-[#333] mb-4 flex flex-col gap-1.5 p-2 shadow-inner">
                                <div class="w-1/3 h-2 bg-[#333] rounded"></div>
                                <div class="w-2/3 h-2 bg-[#222] rounded"></div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="font-mono text-xs font-bold text-text uppercase">Dark</span>
                                <i
                                    class="fa-regular fa-moon text-muted group-hover:text-text peer-checked:text-primary"></i>
                            </div>
                        </div>
                        <div
                            class="absolute top-3 right-3 w-3 h-3 rounded-full bg-primary scale-0 transition-transform peer-checked:scale-100 shadow-[0_0_8px_var(--color-primary)]">
                        </div>
                    </label>

                    <label class="relative cursor-pointer group">
                        <input type="radio" name="theme" value="system" class="peer sr-only"
                            {{ auth()->user()->theme === 'system' ? 'checked' : '' }}>
                        <div
                            class="h-32 rounded-xl border-2 border-border bg-surface/30 p-4 hover:bg-surface transition-colors peer-checked:border-primary peer-checked:bg-primary/5">
                            <div class="w-full h-12 rounded border border-border mb-4 flex overflow-hidden shadow-sm">
                                <div class="w-1/2 h-full bg-white flex flex-col gap-1.5 p-2">
                                    <div class="w-2/3 h-2 bg-gray-200 rounded"></div>
                                </div>
                                <div class="w-1/2 h-full bg-[#121212] border-l border-[#333] flex flex-col gap-1.5 p-2">
                                    <div class="w-2/3 h-2 bg-[#333] rounded"></div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="font-mono text-xs font-bold text-text uppercase">System</span>
                                <i
                                    class="fa-solid fa-laptop text-muted group-hover:text-text peer-checked:text-primary"></i>
                            </div>
                        </div>
                        <div
                            class="absolute top-3 right-3 w-3 h-3 rounded-full bg-primary scale-0 transition-transform peer-checked:scale-100 shadow-[0_0_8px_var(--color-primary)]">
                        </div>
                    </label>

                </div>
            </div>

            <div class="space-y-6 pt-6 border-t border-border/50">
                <div class="flex items-center justify-between">
                    <h2 class="text-sm font-bold font-mono uppercase tracking-widest text-text">
                        <i class="fa-solid fa-language mr-2 text-primary"></i> Localization
                    </h2>
                    <span class="text-[10px] text-muted font-mono uppercase">Parameter_02</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <label class="relative cursor-pointer group">
                        <input type="radio" name="language" value="en" class="peer sr-only"
                            {{ auth()->user()->locale === 'en' ? 'checked' : '' }}>
                        <div
                            class="flex items-center gap-4 p-5 rounded-xl border-2 border-border bg-surface/30 hover:bg-surface transition-colors peer-checked:border-primary peer-checked:bg-primary/5">
                            <div
                                class="w-10 h-10 rounded-lg bg-background border border-border flex items-center justify-center font-mono font-bold text-lg group-hover:text-primary peer-checked:text-primary peer-checked:border-primary/50 transition-colors">
                                EN
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-sm text-text">English</h4>
                                <p class="text-xs text-muted font-mono mt-1">locale: en-US</p>
                            </div>
                            <i
                                class="fa-solid fa-check text-primary scale-0 peer-checked:scale-100 transition-transform text-lg"></i>
                        </div>
                    </label>

                    <label class="relative cursor-pointer group">
                        <input type="radio" name="language" value="id" class="peer sr-only"
                            {{ auth()->user()->locale === 'id' ? 'checked' : '' }}>
                        <div
                            class="flex items-center gap-4 p-5 rounded-xl border-2 border-border bg-surface/30 hover:bg-surface transition-colors peer-checked:border-primary peer-checked:bg-primary/5">
                            <div
                                class="w-10 h-10 rounded-lg bg-background border border-border flex items-center justify-center font-mono font-bold text-lg group-hover:text-primary peer-checked:text-primary peer-checked:border-primary/50 transition-colors">
                                ID
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-sm text-text">Bahasa Indonesia</h4>
                                <p class="text-xs text-muted font-mono mt-1">locale: id-ID</p>
                            </div>
                            <i
                                class="fa-solid fa-check text-primary scale-0 peer-checked:scale-100 transition-transform text-lg"></i>
                        </div>
                    </label>

                </div>
            </div>

            <div class="pt-10 flex justify-end">
                <button type="submit"
                    class="group relative overflow-hidden px-8 py-3 bg-primary text-text font-bold uppercase tracking-widest text-xs rounded hover:bg-text hover:text-background transition-colors duration-300 flex items-center gap-3 shadow-[0_0_20px_rgba(var(--color-primary-rgb),0.2)]">
                    <span>Save Preferences</span>
                    <i class="fa-solid fa-floppy-disk group-hover:scale-110 transition-transform"></i>
                </button>
            </div>

        </form>
    </div>
    </div>
@endsection
