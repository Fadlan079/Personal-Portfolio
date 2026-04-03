 @php
    // Rotasi dinamis untuk memberikan kesan natural pada susunan kartu (seperti section tech stack)
    $cardRotations = [
        'md:-rotate-2',
        'md:rotate-3',
        'md:-rotate-1',
        'md:rotate-2',
        'md:-rotate-3'
    ];
@endphp

<style>
    /* Mengimpor font jika belum ada di layout utama */
    @import url('https://fonts.googleapis.com/css2?family=Caveat:wght@400;600;700&family=Merriweather:ital,wght@0,300;0,700;1,300&display=swap');

    .font-diary-body { font-family: 'Merriweather', serif; }
    .font-diary-accent { font-family: 'Caveat', cursive; }
</style>

<section id="achievements" class="py-24 px-5 max-w-6xl mx-auto relative z-10 font-sans">

    <div class="mb-16 md:px-4 text-center md:text-left">
        <h3 class="text-xs font-black uppercase tracking-[0.3em] text-stone-500 mb-4">
            Milestones
        </h3>

        <h2 class="text-4xl md:text-5xl font-bold tracking-tight mb-3 text-stone-900 leading-tight">
            Sertifikat & Penghargaan
        </h2>

        <p class="text-stone-600 text-lg font-medium max-w-2xl mx-auto md:mx-0 italic font-diary-body">
            Rekam jejak, pencapaian, dan validasi dari perjalanan karir serta pembelajaran saya.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 md:gap-14 pt-6 mt-4">

        @forelse($achievements as $index => $ach)
            @php
                $rotation = $cardRotations[$index % count($cardRotations)];
            @endphp

            <div class="bg-[#FCFAEF] border border-stone-300 rounded-sm shadow-sm p-5 relative group hover:-translate-y-2 hover:shadow-[8px_8px_25px_rgba(0,0,0,0.12)] hover:z-20 transition-all duration-300 transform {{ $rotation }} hover:rotate-0 flex flex-col h-full">

                <div class="absolute -top-3 left-6 w-8 h-10 border-2 border-stone-400/60 rounded-full z-10 rotate-12 pointer-events-none sticky-note-tape" style="clip-path: inset(0 0 50% 0);"></div>
                <div class="absolute -top-3 left-6 w-8 h-10 border-2 border-stone-400/60 rounded-full z-0 rotate-12 pointer-events-none sticky-note-tape"></div>

                <div class="flex gap-4 h-full flex-col mt-2">
                    @if($ach->image_url)
                        <div class="w-full h-48 bg-stone-200 border border-stone-300 rounded overflow-hidden">
                            <img src="{{ asset('storage/'.$ach->image_url) }}" alt="{{ $ach->title }}" class="w-full h-full object-cover filter contrast-[0.95] sepia-[0.1] group-hover:scale-105 transition-transform duration-500">
                        </div>
                    @else
                        <div class="w-full h-48 bg-[#f5f5dc] border border-stone-300 rounded flex items-center justify-center flex-col gap-2 text-stone-400">
                            <i class="fa-solid fa-certificate text-5xl opacity-50 mb-2"></i>
                            <span class="text-xs font-bold uppercase tracking-widest opacity-50">No Certificate</span>
                        </div>
                    @endif

                    <div class="grow flex flex-col pt-3">
                        <h3 class="text-xl font-diary-body font-bold text-stone-800 line-clamp-2 mb-2" title="{{ $ach->title }}">
                            {{ $ach->title }}
                        </h3>

                        <div class="mt-auto space-y-3">
                            <div class="flex justify-between items-center text-sm font-diary-body text-stone-600">
                                <span class="truncate pr-2"><i class="fa-solid fa-building mr-1.5 opacity-60"></i>{{ $ach->issuer ?? 'Anonim' }}</span>
                                <span class="whitespace-nowrap"><i class="fa-regular fa-calendar mr-1.5 opacity-60"></i>{{ $ach->date ? \Carbon\Carbon::parse($ach->date)->format('M Y') : 'Unknown' }}</span>
                            </div>

                            @if(isset($ach->projects_count) && $ach->projects_count > 0)
                                <div class="pt-3 border-t border-dashed border-stone-300">
                                    <span class="inline-block text-[10px] font-bold uppercase tracking-widest text-stone-600 bg-stone-200/50 px-2 py-1.5 rounded-sm">
                                        <i class="fa-solid fa-folder-open mr-1"></i> {{ $ach->projects_count }} Proyek Terkait
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="absolute bottom-0 right-0 w-6 h-6 bg-stone-200 border-t border-l border-stone-300 shadow-[-2px_-2px_4px_rgba(0,0,0,0.03)] z-10 transition-colors group-hover:bg-stone-300" style="clip-path: polygon(100% 0, 0 100%, 100% 100%);"></div>

            </div>
        @empty
            <div class="col-span-full py-16 px-6 flex flex-col items-center justify-center text-center bg-[#fdfcf5] border-2 border-dashed border-[#e5e0d0] rounded-xl shadow-[4px_4px_0px_rgba(0,0,0,0.05)] relative overflow-hidden">
                <div class="absolute inset-0 z-0 opacity-30" style="background-image: repeating-linear-gradient(transparent, transparent 24px, #e5e0d0 24px, #e5e0d0 25px);"></div>
                <div class="relative z-20 space-y-3">
                    <i class="fa-solid fa-medal text-5xl text-stone-400/30 mb-2"></i>
                    <h3 class="text-3xl font-medium text-stone-900 font-diary-accent tracking-wide">Belum Ada Pencapaian</h3>
                    <p class="text-sm text-stone-500 max-w-sm mx-auto italic font-diary-body opacity-90">Daftar sertifikat atau penghargaan akan ditampilkan di sini setelah ditambahkan.</p>
                </div>
            </div>
        @endforelse

    </div>
</section>
