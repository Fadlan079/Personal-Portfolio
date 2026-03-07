<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    @php
        // TANGKAP DATA YIELD KE VARIABEL AGAR AMAN (ANTI-BUG)
        $errCode = trim($__env->yieldContent('code', '500'));
        $errMsg = trim($__env->yieldContent('message', 'SYSTEM EXCEPTION'));
    @endphp

    <title>SYS_ERR // {{ $errCode }}</title>

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        background: '#0a0a0a',
                        surface: '#121212',
                        border: '#2a2a2a',
                        text: '#f4f4f5',
                        muted: '#71717a',
                        primary: '#a855f7',
                    }
                }
            }
        }
    </script>

    <style>
        body { background-color: #0a0a0a; color: #f4f4f5; }
        
        @keyframes glitch-1 {
            0% { clip-path: inset(20% 0 80% 0); transform: translate(-2px, 1px); }
            20% { clip-path: inset(60% 0 10% 0); transform: translate(2px, -1px); }
            40% { clip-path: inset(40% 0 50% 0); transform: translate(-2px, 2px); }
            60% { clip-path: inset(80% 0 5% 0); transform: translate(2px, -2px); }
            80% { clip-path: inset(10% 0 70% 0); transform: translate(-1px, 1px); }
            100% { clip-path: inset(30% 0 50% 0); transform: translate(1px, -1px); }
        }
        
        @keyframes glitch-2 {
            0% { clip-path: inset(10% 0 60% 0); transform: translate(2px, -1px); }
            20% { clip-path: inset(80% 0 5% 0); transform: translate(-2px, 1px); }
            40% { clip-path: inset(30% 0 20% 0); transform: translate(2px, -2px); }
            60% { clip-path: inset(70% 0 10% 0); transform: translate(-2px, 2px); }
            80% { clip-path: inset(20% 0 50% 0); transform: translate(1px, -1px); }
            100% { clip-path: inset(50% 0 30% 0); transform: translate(-1px, 1px); }
        }

        .glitch-wrapper:hover span:nth-child(1),
        .glitch-wrapper:hover span:nth-child(2) { animation-duration: 0.5s; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fadeIn 0.5s ease-out forwards; }
    </style>
</head>
<body class="antialiased selection:bg-primary/30 selection:text-primary">

    <div class="relative min-h-screen flex flex-col items-center justify-center p-6 overflow-hidden select-none">
        
        <div class="absolute inset-0 pointer-events-none opacity-5 z-0" style="background-image: linear-gradient(#f4f4f5 1px, transparent 1px), linear-gradient(90deg, #f4f4f5 1px, transparent 1px); background-size: 48px 48px;"></div>
        <div class="absolute inset-0 pointer-events-none z-50 opacity-10" style="background: linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.25) 50%), linear-gradient(90deg, rgba(255, 0, 0, 0.06), rgba(0, 255, 0, 0.02), rgba(0, 0, 255, 0.06)); background-size: 100% 4px, 3px 100%;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[60vw] h-[60vw] md:w-[40vw] md:h-[40vw] bg-red-600/5 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="relative z-10 w-full max-w-2xl border border-red-500/50 bg-[#050505]/90 backdrop-blur-sm p-8 md:p-12 shadow-[0_0_50px_rgba(239,68,68,0.15)] group animate-fade-in">
            
            <div class="absolute top-0 left-0 w-full h-1 bg-[repeating-linear-gradient(45deg,transparent,transparent_4px,rgba(239,68,68,0.5)_4px,rgba(239,68,68,0.5)_8px)]"></div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-[repeating-linear-gradient(45deg,transparent,transparent_4px,rgba(239,68,68,0.5)_4px,rgba(239,68,68,0.5)_8px)]"></div>
            <div class="absolute -top-1 -left-1 w-4 h-4 border-t-2 border-l-2 border-red-500"></div>
            <div class="absolute -top-1 -right-1 w-4 h-4 border-t-2 border-r-2 border-red-500"></div>
            <div class="absolute -bottom-1 -left-1 w-4 h-4 border-b-2 border-l-2 border-red-500"></div>
            <div class="absolute -bottom-1 -right-1 w-4 h-4 border-b-2 border-r-2 border-red-500"></div>

            <div class="flex items-center justify-between border-b border-red-500/30 pb-4 mb-8">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 flex items-center justify-center border border-red-500/50 bg-red-500/10 text-red-500">
                        <i class="fa-solid fa-triangle-exclamation animate-pulse"></i>
                    </div>
                    <span class="text-xs md:text-sm font-mono font-bold uppercase tracking-widest text-red-500">
                        SYSTEM_EXCEPTION_TRIGGERED
                    </span>
                </div>
                <span class="text-[10px] font-mono text-red-500/70 uppercase tracking-widest hidden sm:block">
                    ERR_CODE: HTTP_{{ $errCode }}
                </span>
            </div>

            <div class="text-center mb-10 relative">
                <h1 class="text-[clamp(5rem,15vw,10rem)] font-bold font-mono tracking-tighter leading-none text-transparent relative inline-block glitch-wrapper" data-text="{{ $errCode }}">
                    <span class="absolute inset-0 text-red-500 opacity-70 -translate-x-1 animate-[glitch-1_2.5s_infinite_linear_alternate-reverse]">{{ $errCode }}</span>
                    <span class="absolute inset-0 text-sky-500 opacity-70 translate-x-1 animate-[glitch-2_3s_infinite_linear_alternate-reverse]">{{ $errCode }}</span>
                    <span class="relative text-text">{{ $errCode }}</span>
                </h1>
                <p class="text-lg md:text-2xl font-mono font-bold uppercase tracking-[0.2em] text-text mt-2">
                    {{ $errMsg }}
                </p>
            </div>

            <div class="bg-black border border-border/50 p-5 font-mono text-xs md:text-sm leading-relaxed text-muted mb-10 space-y-2">
                <div class="flex gap-2"><span class="text-primary">></span> <span>VERIFYING_ACCESS_PROTOCOL...</span></div>
                <div class="flex gap-2"><span class="text-primary">></span> <span>ANALYZING_PACKET_DATA...</span></div>
                <div class="flex gap-2"><span class="text-red-500">></span> <span class="text-red-400">EXCEPTION_THROWN [HTTP_{{ $errCode }}]</span></div>
                <div class="flex gap-2"><span class="text-primary">></span> <span>DIAGNOSTIC: <span class="text-text uppercase">{{ $errMsg }}. USER OPERATION HALTED.</span></span></div>
                
                <div class="flex mt-4 items-center gap-2">
                    <span class="text-green-500">guest@sys:~$</span>
                    <div class="w-2 h-4 bg-primary animate-pulse"></div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <button onclick="window.history.back()" class="w-full sm:w-auto px-6 py-3 border border-border text-[11px] font-mono font-bold uppercase tracking-widest text-muted hover:border-primary hover:text-primary transition-colors flex items-center justify-center gap-3">
                    <i class="fa-solid fa-arrow-left"></i> [ TRACE_BACK ]
                </button>

                <a href="/" class="w-full sm:w-auto relative group px-6 py-3 bg-primary/10 border border-primary text-primary font-mono text-[11px] font-bold uppercase tracking-widest hover:bg-primary hover:text-background transition-colors flex items-center justify-center gap-3 shadow-[0_0_15px_rgba(168,85,247,0.15)]">
                    <span>[ REBOOT_TO_ROOT ]</span>
                    <i class="fa-solid fa-house group-hover:-translate-y-1 transition-transform"></i>
                </a>
            </div>

        </div>
    </div>
</body>
</html>