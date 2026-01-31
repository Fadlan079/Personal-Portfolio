@extends('layouts.main')
@section('title', __('title.contact'))
@section('content')
<x-navbar
brand="Fadlan"
:menus="[
    ['key' => 'nav.home', 'href' => route('Home')],
    ['key' => 'nav.about', 'href' => route('About')],
    ['key' => 'nav.projects', 'href' => route('Project')],
    ['key' => 'nav.contact', 'href' => route('Contact')],
]"
/>

<x-footer
brand="Fadlan"
:links="[
    ['key' => 'nav.home', 'href' => route('Home')],
    ['key' => 'nav.about', 'href' => route('About')],
    ['key' => 'nav.projects', 'href' => route('Project')],
    ['key' => 'nav.contact', 'href' => route('Contact')],
]"
:socials="[
    ['icon' => 'fa-brands fa-github', 'href' => 'https://github.com/Fadlan079'],
    ['icon' => 'fa-brands fa-linkedin', 'href' => 'https://www.linkedin.com/in/fadlan-firdaus-148344386/'],
    ['icon' => 'fa-brands fa-instagram', 'href' => 'https://instagram.com/fdln007'],
    ['icon' => 'fa-solid fa-envelope', 'href' => 'mailto:fadlanfirdaus220@gmail.com'],
    ['icon' => 'fa-brands fa-whatsapp', 'href' => 'https://wa.me/6282210732928'],
]"
/>
@endsection
