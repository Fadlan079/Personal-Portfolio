<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public array $menuGroups = [],
        public ?string $brand = null
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $theme = current_theme();

        // Map UI layout name → sidebar view file name
        $folderMap = [
            'diary'  => 'book',
            'clean'  => 'clean',
            'system' => 'system',
        ];

        $sidebarName = $folderMap[$theme] ?? 'system';
        $themeView   = "components.sidebar.$sidebarName";

        if (view()->exists($themeView)) {
            return view($themeView, [
                'menuGroups' => $this->menuGroups,
                'brand'      => $this->brand,
            ]);
        }

        return view('components.sidebar.system', [
            'menuGroups' => $this->menuGroups,
            'brand'      => $this->brand,
        ]);
    }
}
