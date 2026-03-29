@php
    $skillsByCategory = $skills->groupBy('category');

    $categories = [
        ['id' => 'backend', 'name' => 'Backend & Database', 'icon' => '<i class="fa-solid fa-server"></i>', 'color' => 'text-amber-700', 'bg' => 'bg-amber-50', 'border' => 'border-amber-200'],
        ['id' => 'frontend', 'name' => 'Frontend', 'icon' => '<i class="fa-solid fa-layer-group"></i>', 'color' => 'text-blue-700', 'bg' => 'bg-blue-50', 'border' => 'border-blue-200'],
        ['id' => 'tools', 'name' => 'Tools', 'icon' => '<i class="fa-solid fa-toolbox"></i>', 'color' => 'text-emerald-700', 'bg' => 'bg-emerald-50', 'border' => 'border-emerald-200'],
    ];

    $cardRotations = [
    'md:-rotate-2',
    'md:rotate-3',
    'md:-rotate-1',
    'md:rotate-2',
    'md:-rotate-3'
];
    $tapeRotations = ['rotate-3', '-rotate-2', 'rotate-1', '-rotate-4', 'rotate-2'];
@endphp

<section id="tech-stack" class="py-24 px-5 max-w-6xl mx-auto relative z-10 font-serif">

    <div class="mb-16 md:px-4 text-center md:text-left">
        <h3 class="text-xs font-black uppercase tracking-[0.3em] text-muted mb-4">
            Tech Stack
        </h3>

        <h2 class="text-4xl md:text-5xl font-bold tracking-tight mb-3 text-text leading-tight"
        data-i18n="home.skills.title">
            Kemampuan & Teknologi
        </h2>

        <p class="text-muted text-lg font-medium max-w-2xl mx-auto md:mx-0 italic"
        data-i18n="home.skills.description">
            Beberapa teknologi dan bahasa pemrograman yang saya gunakan dalam pengembangan web.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 md:gap-14 pt-6 mt-4">

        @php $index = 0; @endphp
        @foreach ($categories as $cat)
            @if($skillsByCategory->has($cat['id']) && $skillsByCategory->get($cat['id'])->count() > 0)

                @php

                    $cardRotation = $cardRotations[$index % count($cardRotations)];
                    $tapeRotation = $tapeRotations[$index % count($tapeRotations)];
                    $index++;
                @endphp

                <div class="relative bg-warning p-8 border border-yellow-500 shadow-[4px_4px_15px_rgba(0,0,0,0.05)] transition-all duration-300 transform {{ $cardRotation }} hover:rotate-0 hover:scale-105 hover:shadow-[8px_8px_25px_rgba(0,0,0,0.12)] hover:z-20 group">

                    <div class="absolute -top-5 left-1/2 -translate-x-1/2 w-28 h-8 bg-black/10 backdrop-blur-[2px] border border-black/5 shadow-sm z-20 transition-all duration-300 {{ $tapeRotation }}"
                         style="clip-path: polygon(2% 10%, 98% 0%, 100% 95%, 0% 100%);">
                    </div>

                    <div class="mt-2 mb-6 flex items-center gap-4 border-b border-dashed border-yellow-600/50 pb-4">
                        <div class="w-10 h-10 rounded-full {{ $cat['bg'] }} {{ $cat['color'] }} flex items-center justify-center shrink-0 border {{ $cat['border'] }}">
                            {!! $cat['icon'] !!}
                        </div>
                        <h3 class="text-xl font-bold text-yellow-900 leading-tight">{{ $cat['name'] }}</h3>
                    </div>

                    <div class="flex flex-wrap gap-2.5">
                        @foreach ($skillsByCategory->get($cat['id']) as $skill)
                            <div class="group/skill relative flex items-center gap-2 px-3 py-1.5 bg-yellow-500/10 border border-yellow-600/30 text-sm font-semibold text-yellow-900 hover:bg-yellow-500/20 hover:border-yellow-600/60 transition-all cursor-default shadow-sm" style="border-radius: 2px;">

                                <div class="flex items-center justify-center w-4 h-4 [&>i]:text-sm [&>i]:leading-none">
                                    {!! $skill->icon !!}
                                </div>

                                <span>{{ $skill->name }}</span>

                                @if($skill->description || $skill->projects_count > 0)
                                    <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-3 w-max max-w-[200px] p-3 bg-yellow-950 text-warning rounded shadow-xl opacity-0 invisible group-hover/skill:opacity-100 group-hover/skill:visible transition-all duration-200 z-50 pointer-events-none font-sans">

                                        <div class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-3 h-3 bg-yellow-950 transform rotate-45"></div>

                                        <div class="relative z-10 text-xs font-normal">
                                            @if($skill->description)
                                                <p class="leading-relaxed mb-2">{{ $skill->description }}</p>
                                            @endif
                                            @if($skill->projects_count > 0)
                                                <p class="font-bold border-t border-warning/20 pt-2 flex items-center gap-1.5">
                                                    <i class="fa-solid fa-folder-open"></i> {{ $skill->projects_count }} Proyek
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                            </div>
                        @endforeach
                    </div>

                    <div class="absolute bottom-0 right-0 w-5 h-5 bg-yellow-600 border-t border-l border-yellow-700 shadow-[-2px_-2px_4px_rgba(0,0,0,0.03)] z-10" style="clip-path: polygon(100% 0, 0 100%, 100% 100%);"></div>

                </div>

            @endif
        @endforeach

    </div>
</section>
