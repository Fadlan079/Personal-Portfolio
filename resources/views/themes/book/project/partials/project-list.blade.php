<div id="project-list-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse($projects as $index => $project)
            @php
                $rotation = $index % 2 === 0 ? 'md:rotate-1' : 'md:-rotate-1';
            @endphp

            <div class="group relative p-4 pt-12 shadow-inner bg-container rounded-xl {{ $rotation }} hover:rotate-0 transition-transform duration-500">

            <div class="absolute top-4 left-6 z-20">
                <span class="px-4 py-1.5 text-[10px] font-black tracking-widest bg-warning text-yellow-900 border-l-4 border-yellow-500 shadow-md rotate-[-3deg] inline-block uppercase">
                    {{ $project->status }}
                </span>
            </div>

            <div class="bg-surface p-4 shadow-[0_10px_30px_-10px_rgba(0,0,0,0.15)] border border-border h-full flex flex-col">

                <a href="javascript:void(0);"
                   class="project-open block flex-grow"
                   data-id="{{ $project->id }}"
                   data-title="{{ $project->title }}"
                   data-desc="{{ $project->desc }}"
                   data-type="{{ $project->type }}"
                   data-status="{{ $project->status }}"
                   data-created="{{ $project->created_at->format('d M Y') }}"
                   data-updated="{{ $project->updated_at->format('d M Y') }}"
                   data-repo="{{ $project->repo ?? '' }}"
                   data-role="{{ $project->role ?? '' }}"
                   data-team="{{ $project->team_size ?? '' }}"
                   data-responsibilities="{{ $project->responsibilities ?? '' }}"
                   data-live="{{ $project->live_url ?? '' }}"
                   data-screenshot='@json($project->screenshot ? collect($project->screenshot)->map(fn($img) => asset("storage/" . $img))->values() : [])'
                   data-tech='@json($project->tech)'
                   data-achievements='@json($project->achievements->map(fn($a) => ["id" => $a->id, "title" => $a->title, "image_url" => $a->image_url]))'>

                    <div class="aspect-video w-full bg-bg overflow-hidden mb-5 border border-border shadow-inner relative">
                        <div class="absolute inset-0 opacity-[0.03] pointer-events-none z-10" style="background-image: radial-gradient(var(--color-text) 0.5px, transparent 0.5px); background-size: 8px 8px;"></div>

                        <div class="relative w-full h-full overflow-hidden project-slider">

                            @if(!empty($project->screenshot) && count($project->screenshot) > 0)
                                @foreach($project->screenshot as $i => $shot)
                                    <img
                                        src="{{ asset('storage/' . $shot) }}"
                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                        class="slide absolute inset-0 w-full h-full object-cover transition-all duration-500 {{ $i === 0 ? 'opacity-100 grayscale-[0.3] group-hover:grayscale-0' : 'opacity-0 grayscale-0' }} group-hover:scale-105"
                                        alt="{{ $project->title }} screenshot {{ $i+1 }}"
                                    >
                                    <div style="display:none;" class="flex-col items-center justify-center w-full h-full text-muted p-4 text-center bg-surface">
                                        <i class="fa-regular fa-image text-3xl opacity-30 mb-2"></i>
                                        <span class="text-[9px] uppercase tracking-widest font-bold">Kliping Kosong</span>
                                    </div>
                                @endforeach
                            @else
                                <img
                                    src="https://via.placeholder.com/600x400/E5E4DF/52525B?text=Preview+Tidak+Tersedia"
                                    class="w-full h-full object-cover grayscale-[0.3] group-hover:grayscale-0 transition-all duration-500 group-hover:scale-105"
                                    alt="preview"
                                >
                            @endif

                        </div>
                    </div>

                    <div class="px-1 pb-1 flex flex-col flex-grow">
                        <div class="flex justify-between items-start mb-1">
                            <span class="text-[9px] font-bold text-muted uppercase tracking-widest">{{ $project->type }}</span>
                        </div>

                        <h3 class="text-xl font-bold text-text leading-tight mb-3 group-hover:text-primary transition-colors line-clamp-1">
                            {{ $project->title }}
                        </h3>

                        <p class="text-sm text-muted line-clamp-3 mb-4">
                            {{ $project->desc }}
                        </p>

                        <div class="pt-3 border-t border-border/50 flex flex-col gap-2 mt-auto">
                            @if($project->achievements && $project->achievements->count() > 0)
                                <div class="flex items-center gap-1.5 text-[9px] text-yellow-700 bg-warning/20 px-2 py-0.5 rounded-sm border border-warning/50 w-fit shadow-sm uppercase tracking-wider font-bold mb-1">
                                    <i class="fa-solid fa-trophy text-yellow-600"></i>
                                    <span>+{{ $project->achievements->count() }} Pencapaian</span>
                                </div>
                            @endif
                            <div class="flex justify-between items-center w-full">
                                <div class="flex flex-wrap items-center gap-x-3 gap-y-1">
                                    <span class="text-[10px] font-medium text-muted italic">
                                        Diarsipkan: {{ $project->created_at->format('d F Y') }}
                                    </span>
                                    <div class="flex items-center gap-2 text-[10px] text-muted font-bold border-l border-border/50 pl-3">
                                        <div class="flex items-center gap-1">
                                            <i class="fa-heart {{ ($project->likes_count ?? 0) > 0 ? 'fa-solid text-red-500/70' : 'fa-regular' }}"></i>
                                            <span>{{ $project->likes_count ?? 0 }}</span>
                                        </div>
                                        <div class="flex items-center gap-1 ml-1">
                                            <i class="fa-comment {{ ($project->comments_count ?? 0) > 0 ? 'fa-solid text-stone-500' : 'fa-regular' }}"></i>
                                            <span>{{ $project->comments_count ?? 0 }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    @empty
        <div class="col-span-full py-20 px-6 flex flex-col items-center justify-center text-center bg-[#fdfcf5] border border-[#e5e0d0] rounded-xl shadow-[4px_4px_0px_rgba(0,0,0,0.05)] relative font-sans overflow-hidden">

            <div class="absolute inset-0 z-0 opacity-30" style="background-image: repeating-linear-gradient(transparent, transparent 24px, #e5e0d0 24px, #e5e0d0 25px);"></div>

            <div class="absolute top-0 left-10 bottom-0 w-0.5 bg-red-300 z-10 opacity-60"></div>

            <div class="absolute bottom-4 right-6 text-3xl text-muted/50 rotate-12 z-10">
                <i class="fa-solid fa-pencil-alt relative -right-2 top-1"></i>
                <i class="fa-solid fa-pen-nib relative -rotate-12"></i>
            </div>

            <div class="relative z-20 space-y-3">
                <h3 class="text-3xl font-medium text-black font-handwriting tracking-wide">
                    Arsip Kosong
                </h3>

                <p class="text-sm text-muted max-w-sm mx-auto italic font-serif opacity-90">
                    Belum ada proyek yang disorot untuk saat ini.
                </p>
            </div>

        </div>
    @endforelse
</div>

<script>
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        gsap.utils.toArray('.gsap-project-card').forEach(card => {
            gsap.from(card, {
                scrollTrigger: {
                    trigger: card,
                    start: "top 85%",
                },
                y: 50,
                opacity: 0,
                duration: 0.6,
                ease: "power2.out"
            });
        });
    }
</script>
