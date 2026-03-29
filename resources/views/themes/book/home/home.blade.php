@extends('layouts.main')
@section('title', 'Portfolio')
@vite(['resources/css/hero.css', 'resources/css/dashboard_project.css'])

@section('content')
    <div class="md:px-5 md:py-5">
        @include('themes.book.home.partials.hero')
    </div>

    <div class="w-full flex flex-col items-center justify-center relative -mt-8 mb-24">
        <div class="w-px h-20 md:h-32"></div>
    </div>

    <div class="md:px-5 md:py-5 bg-surface/40">
        @include('themes.book.home.partials.about-preview')
    </div>

    <div class="w-full flex flex-col items-center justify-center relative my-24">
        <div class="w-px h-20 md:h-32"></div>
    </div>

    <div class="md:px-5 md:py-5">
        @include('themes.book.home.partials.featured-project')
    </div>

    <div class="w-full flex flex-col items-center justify-center relative my-24">
        <div class="w-px h-20 md:h-32"></div>
    </div>

    <div class="md:px-5 md:py-5 bg-surface/40">
        @include('themes.book.home.partials.skills')
    </div>

    <div class="w-full flex flex-col items-center justify-center relative mt-24 mb-0">
        <div class="w-px h-20 md:h-32"></div>
    </div>

    <div class="md:px-5 md:py-5">
        @include('themes.book.home.partials.cta')
    </div>


@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const clockElement = document.getElementById('hero-live-clock');
            const dateElement = document.getElementById('hero-live-date');

            if (clockElement) {
                const formatStr = clockElement.getAttribute('data-format') || '24';
                const showSecondsStr = clockElement.getAttribute('data-seconds') || '1';

                const use12Hour = (formatStr === '12');
                const showSeconds = (showSecondsStr === '1');

                let showDate = false;
                if (dateElement) {
                    showDate = (dateElement.getAttribute('data-date') === '1');
                    if (showDate) dateElement.classList.remove('hidden');
                }

                function updateClock() {
                    const now = new Date();

                    const timeOptions = {
                        hour12: use12Hour,
                        hour: '2-digit',
                        minute: '2-digit'
                    };

                    if (showSeconds) {
                        timeOptions.second = '2-digit';
                    }

                    const timeString = now.toLocaleTimeString('en-US', timeOptions);
                    clockElement.innerText = `${timeString} WITA`;

                    if (showDate && dateElement) {
                        const dateOptions = {
                            year: 'numeric',
                            month: 'short',
                            day: '2-digit'
                        };
                        dateElement.innerText = now.toLocaleDateString('en-US', dateOptions).toUpperCase();
                    }
                }

                updateClock();
                setInterval(updateClock, 1000);
            }
        });
    </script>

    <script>
        const buttons = document.querySelectorAll('.device-btn');
        const views = document.querySelectorAll('.device-view');

        buttons.forEach(btn => {
            btn.addEventListener('click', () => {

                const device = btn.dataset.device;

                buttons.forEach(b => {
                    b.classList.remove('bg-bg', 'text-text');
                    b.classList.add('text-muted');
                });

                btn.classList.add('bg-bg', 'text-text');
                btn.classList.remove('text-muted');

                views.forEach(view => {
                    view.classList.toggle(
                        'hidden',
                        view.dataset.view !== device
                    );
                });

            });
        });
    </script>
@endpush
