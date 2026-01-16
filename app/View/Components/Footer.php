<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Footer extends Component
{
    public function __construct(
        public string $brand = 'App',
        public string $description = '',
        public array $links = [],
        public array $socials = [],
        public ?int $year = null,
    )
    {
    }

    public function render(): View|Closure|string
    {
        return view('components.footer');
    }
}