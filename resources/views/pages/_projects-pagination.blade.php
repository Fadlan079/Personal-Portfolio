{{--
    Partial: pagination controls
    Rendered server-side, injected via AJAX into #projects-pagination
--}}
@if ($projects->hasPages())
<nav class="flex items-center gap-2 text-sm">

    @if ($projects->onFirstPage())
        <span class="px-3 py-2 text-muted border border-border">Prev</span>
    @else
        <a href="javascript:void(0)"
           class="px-3 py-2 border border-border hover:border-primary ajax-page"
           data-page="{{ $projects->currentPage() - 1 }}">
            Prev
        </a>
    @endif

    <span class="px-4 py-2 border border-border">
        {{ $projects->currentPage() }} / {{ $projects->lastPage() }}
    </span>

    @if ($projects->hasMorePages())
        <a href="javascript:void(0)"
           class="px-3 py-2 border border-border hover:border-primary ajax-page"
           data-page="{{ $projects->currentPage() + 1 }}">
            Next
        </a>
    @else
        <span class="px-3 py-2 text-muted border border-border">Next</span>
    @endif

</nav>
@endif
