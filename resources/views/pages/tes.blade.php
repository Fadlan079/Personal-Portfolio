@extends('layouts.main')

@section('content')

<section class="relative h-screen bg-bg overflow-hidden">

    <!-- LEFT INFO PANEL -->
    <div id="skill-info"
         class="absolute left-16 top-1/2 -translate-y-1/2
                w-96 p-8 rounded-3xl border border-border
                bg-surface/80 backdrop-blur
                opacity-0 transition-all duration-300">

        <h3 id="skill-title"
            class="text-2xl font-semibold mb-4"></h3>

        <p id="skill-desc"
           class="text-muted leading-loose text-sm"></p>
    </div>

    <!-- TITLE -->
    <div class="absolute top-16 left-1/2 -translate-x-1/2 text-center z-10">
        <h2 class="text-5xl font-bold tracking-wide">
            SKILLS
        </h2>
        <p class="text-muted mt-2 text-sm">
            (hover a key)
        </p>
    </div>

    <!-- CANVAS -->
    <div id="skills-canvas" class="w-full h-full"></div>

</section>

@vite(['resources/js/skills-lab.js'])

@endsection
