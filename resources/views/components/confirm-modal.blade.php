@php
    $theme = current_theme();

    // Map UI layout name → actual view folder name (consistent with theme_view helper)
    $folderMap = [
        'diary'  => 'book',
        'clean'  => 'clean',
        'system' => 'system_architecture',
    ];

    $folder = $folderMap[$theme] ?? 'book';
@endphp

{{-- Dynamically include the themed confirm modal partial --}}
@includeIf("themes.{$folder}.partials.confirm-modal")