@extends('layouts.dashboard')
@section('title', 'Trash Projects')

@section('content')

<section class="py-20 max-w-6xl mx-auto px-6 space-y-16">

    <header class="space-y-6 max-w-6xl">
        <p class="text-xs uppercase tracking-widest text-muted">
            dashboard / projects / trash
        </p>

        <h1 class="text-[clamp(2.5rem,6vw,4rem)] font-semibold leading-tight">
            Trash Projects
            <span class="block text-muted font-normal text-lg mt-2">
                Archived & soft deleted items
            </span>
        </h1>

        <div class="flex items-center justify-between w-full gap-4">

            <div class="relative w-full md:w-1/3">
                <form method="GET">
                    <input
                        type="text"
                        name="search"
                        placeholder="Search Trash..."
                        value="{{ request('search') }}"
                        class="w-full border border-border px-4 py-2 pl-10 text-sm placeholder:text-muted bg-surface focus:outline-none focus:ring-1 focus:ring-primary"
                    />
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-muted">
                        <i class="fas fa-search"></i>
                    </span>
                </form>
            </div>

            <div class="flex items-center gap-2 ml-auto">
                <form method="GET">
                    <select
                        name="sort"
                        onchange="this.form.submit()"
                        class="border border-border px-4 py-2 text-sm bg-surface focus:outline-none focus:ring-1 focus:ring-primary"
                    >
                        <option value="desc" {{ $sort == 'desc' ? 'selected' : '' }}>Newest Deleted</option>
                        <option value="asc" {{ $sort == 'asc' ? 'selected' : '' }}>Oldest Deleted</option>
                    </select>
                </form>

                <button
                    id="toggleSelectMode"
                    type="button"
                    class="px-4 py-2 border border-border text-sm hover:border-primary transition focus:outline-none focus:ring-1 focus:ring-primary"
                >
                    Select Multiple
                </button>
            </div>

        </div>
    </header>

    <div class="grid md:grid-cols-3 gap-6">

        <div class="border border-border bg-surface p-6">
            <p class="text-xs uppercase tracking-widest text-muted mb-2">
                Total Soft Deleted
            </p>
            <h3 class="text-3xl font-semibold">
                {{ $totalTrashed }}
            </h3>
        </div>

        <div class="border border-border bg-surface p-6">
            <p class="text-xs uppercase tracking-widest text-muted mb-2">
                Retention Policy
            </p>
            <h3 class="text-3xl font-semibold">
                {{ config('app.trash_retention_days') }} Days
            </h3>
        </div>

        <div class="border border-border bg-surface p-6">
            <p class="text-xs uppercase tracking-widest text-muted mb-2">
                Expiring Soon
            </p>
            <h3 class="text-3xl font-semibold text-red-400">
                {{ $expiringSoon ?? 0 }}
            </h3>
        </div>

    </div>

    <div class="space-y-16">
        @forelse ($groupedProjects as $month => $projects)

        <div class="space-y-6">
                <div class="flex items-center justify-between border-b border-border pb-3">

                    <h2 class="text-2xl font-semibold">
                        {{ $month }}
                    </h2>

                    <button type="button"
                        class="month-select hidden text-xs px-3 py-1 border border-border hover:border-primary"
                        data-month="{{ Str::slug($month) }}">
                        Select All
                    </button>

                </div>

                <div class="space-y-4">
                    @foreach ($projects as $project)
                        <div class="project-card border border-border bg-surface p-6 flex justify-between items-center gap-6 cursor-pointer"
                            data-month="{{ Str::slug($month) }}">

                            <div class="flex items-center gap-4">
                            <input type="checkbox"
                                name="projects[]"
                                value="{{ $project->id }}"
                                class="bulk-checkbox w-4 h-4 opacity-0 pointer-events-none transition">

                                <div>
                                    <h3 class="font-semibold">
                                        {{ $project->title }}
                                    </h3>
                                    <p class="text-sm text-muted">
                                        Deleted:
                                        {{ $project->deleted_at->format('d M Y - H:i') }}
                                    </p>

                                    @php
                                        $retention = config('app.trash_retention_days');

                                        $deleteAt = $project->deleted_at->copy()->addDays($retention);

                                        $daysLeft = now()->diffInDays($deleteAt, false);
                                    @endphp

                                    @if($daysLeft > 0)
                                        <p class="text-xs text-red-400 mt-1">
                                            Permanently deleted in {{ intval($daysLeft) }} day{{ $daysLeft != 1 ? 's' : '' }}
                                        </p>
                                    @else
                                        <p class="text-xs text-red-500 mt-1 font-semibold">
                                            Scheduled for permanent deletion
                                        </p>
                                    @endif

                                    @if($daysLeft <= 5 && $daysLeft > 0)
                                        <p class="text-xs text-yellow-400 mt-1">
                                            ⚠ Only {{ $daysLeft }} days remaining
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="flex items-center gap-3 normal-actions">

                                <form method="POST"
                                    action="{{ route('dashboard.projects.restore', $project->id) }}">
                                    @csrf
                                    <button class="text-xs px-3 py-1 border border-border hover:border-primary">
                                        Restore
                                    </button>
                                </form>

                                <form method="POST"
                                    action="{{ route('dashboard.projects.forceDelete', $project->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        onclick="return confirm('Delete permanently?')"
                                        class="text-xs px-3 py-1 border border-red-500 text-red-400 hover:bg-red-500/10">
                                        Delete
                                    </button>
                                </form>

                            </div>

                        </div>
                    @endforeach

@if(!$multipleSelect && $projects instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="pt-6">
        <div class="flex justify-center">
            <nav class="flex items-center gap-2 text-sm">
                @if ($projects->onFirstPage())
                    <span class="px-3 py-2 text-muted border border-border">Prev</span>
                @else
                    <a href="{{ $projects->previousPageUrl() }}" class="px-3 py-2 border border-border hover:border-primary">Prev</a>
                @endif

                <span class="px-4 py-2 border border-border">
                    {{ $projects->currentPage() }} / {{ $projects->lastPage() }}
                </span>

                @if ($projects->hasMorePages())
                    <a href="{{ $projects->nextPageUrl() }}" class="px-3 py-2 border border-border hover:border-primary">Next</a>
                @else
                    <span class="px-3 py-2 text-muted border border-border">Next</span>
                @endif
            </nav>
        </div>
    </div>
@endif
                </div>
            </div>
        @empty
            <div class="border border-border bg-surface py-20 px-6 text-center flex flex-col items-center justify-center gap-6">

                <div class="w-20 h-20 flex items-center justify-center border border-border/50 bg-background/40">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-10 h-10 text-muted"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 7h12M9 7V4h6v3m-7 4v6m4-6v6m5 0a2 2 0 002-2V7H4v10a2 2 0 002 2h12z" />
                    </svg>
                </div>

                <h2 class="text-2xl font-semibold tracking-wide">
                    No Deleted Projects
                </h2>

                <p class="text-muted text-sm max-w-md">
                    There are currently no soft-deleted records within the 30-day retention period.
                </p>

            </div>
        @endforelse

    </div>

    @if($totalTrashed > 0)
    <div id="bulkBar"
        class="fixed bottom-6 left-1/2 -translate-x-1/2
                bg-surface border border-border px-6 py-4
                flex gap-4 shadow-lg
                opacity-0 pointer-events-none translate-y-4
                transition-all duration-200">

        <span id="selectedCount"
            class="text-xs uppercase tracking-widest text-muted flex items-center">
            0 Selected
        </span>

        <button type="button"
            onclick="bulkAction('restore')"
            class="px-4 py-2 border border-border text-sm hover:border-primary">
            Restore Selected
        </button>

        <button type="button"
            onclick="bulkAction('delete')"
            class="px-4 py-2 border border-red-500 text-red-400 text-sm hover:bg-red-500/10">
            Delete Permanently
        </button>

    </div>
    @endif

    <form id="bulkForm" method="POST" class="hidden">
        @csrf
    </form>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const monthButtons = document.querySelectorAll('.month-select')
    const normalActions = document.querySelectorAll('.normal-actions')
    const toggleBtn = document.getElementById('toggleSelectMode')
    const bulkBar = document.getElementById('bulkBar')
    const checkboxes = document.querySelectorAll('.bulk-checkbox')
    const cards = document.querySelectorAll('.project-card')
    const selectedCountText = document.getElementById('selectedCount')

    let selectMode = false

    function updateBulkBar() {

        if (!selectMode) return

        const selected = document.querySelectorAll('.bulk-checkbox:checked').length

        if (selected > 0) {
            bulkBar.classList.remove('opacity-0','pointer-events-none','translate-y-4')
            selectedCountText.innerText = selected + ' Selected'
        } else {
            bulkBar.classList.add('opacity-0','pointer-events-none','translate-y-4')
        }
    }

toggleBtn.addEventListener('click', () => {
    selectMode = !selectMode;

    // Ambil URL sekarang
    const url = new URL(window.location.href);

    if (selectMode) {
        // Jika mode multiple select belum di URL, tambahkan query param
        if (!url.searchParams.has('multiple_select')) {
            url.searchParams.set('multiple_select', '1');
            window.location.href = url.toString();
            return; // reload page dulu, checkbox akan aktif setelah load
        }

        // Setelah page reload, aktifkan mode multiple select di frontend
        monthButtons.forEach(btn => btn.classList.remove('hidden'));
        checkboxes.forEach(cb => cb.classList.remove('opacity-0', 'pointer-events-none'));
        normalActions.forEach(el => el.classList.add('hidden'));
        toggleBtn.innerText = 'Cancel Selection';
        toggleBtn.classList.add('border-red-500', 'text-red-400');

    } else {
        // Nonaktifkan mode multiple select
        monthButtons.forEach(btn => btn.classList.add('hidden'));
        checkboxes.forEach(cb => {
            cb.checked = false;
            cb.classList.add('opacity-0', 'pointer-events-none');
        });
        cards.forEach(card => card.classList.remove('border-primary', 'bg-primary/5'));
        normalActions.forEach(el => el.classList.remove('hidden'));
        bulkBar.classList.add('opacity-0', 'pointer-events-none', 'translate-y-4');
        toggleBtn.innerText = 'Select Multiple';
        toggleBtn.classList.remove('border-red-500', 'text-red-400');

        // Hapus query param multiple_select dan reload page
        url.searchParams.delete('multiple_select');
        window.location.href = url.toString();
    }
});

    checkboxes.forEach(cb => {
        cb.addEventListener('change', updateBulkBar)
    })

    monthButtons.forEach(button => {

        button.addEventListener('click', () => {

            const month = button.dataset.month

            const monthCheckboxes = document.querySelectorAll(
                `[data-month="${month}"] .bulk-checkbox`
            )

            const allChecked = [...monthCheckboxes].every(cb => cb.checked)

            monthCheckboxes.forEach(cb => {
                cb.checked = !allChecked

                const card = cb.closest('.project-card')
                card.classList.toggle('border-primary', !allChecked)
                card.classList.toggle('bg-primary/5', !allChecked)
            })

            button.innerText = allChecked ? 'Select All' : 'Unselect All'

            updateBulkBar()
        })
    })

    cards.forEach(card => {

        card.addEventListener('click', function(e) {

            if (!selectMode) return

            if (e.target.closest('form') || e.target.tagName === 'BUTTON') return

            const checkbox = card.querySelector('.bulk-checkbox')
            checkbox.checked = !checkbox.checked

            card.classList.toggle('border-primary', checkbox.checked)
            card.classList.toggle('bg-primary/5', checkbox.checked)

            updateBulkBar()
        })
    })

})
</script>
<script>
function bulkAction(type) {

    const form = document.getElementById('bulkForm')
    const selected = document.querySelectorAll('.bulk-checkbox:checked')

    if (selected.length === 0) {
        alert('Please select at least one project.')
        return
    }

    if (type === 'restore') {
        form.action = "{{ route('dashboard.bulkRestore') }}"
    }

    if (type === 'delete') {

        if (!confirm('This action is permanent. Continue?')) return

        form.action = "{{ route('dashboard.bulkForceDelete') }}"
    }

    form.submit()
}
</script>
@endpush
