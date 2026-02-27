@if(in_array($tab, ['all', 'projects']))
    @include('dashboard.trash.partials.projects')
@endif

@if(in_array($tab, ['all', 'skills']))
    @include('dashboard.trash.partials.skills')
@endif
