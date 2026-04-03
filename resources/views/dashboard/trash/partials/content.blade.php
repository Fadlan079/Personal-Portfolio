@if(in_array($tab, ['all', 'projects']))
    @include('dashboard.trash.partials.projects')
@endif

@if(in_array($tab, ['all', 'skills']))
    @include('dashboard.trash.partials.skills')
@endif

@if(in_array($tab, ['all', 'achievements']))
    @include('dashboard.trash.partials.achievements')
@endif

@if(in_array($tab, ['all', 'contacts']))
    @include('dashboard.trash.partials.contacts')
@endif
