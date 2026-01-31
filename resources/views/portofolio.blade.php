@extends('layouts.main')
@section('title', __('title.portfolio'))
@section('content')
<x-navbar
brand="Fadlan"
:menus="[
    ['key' => 'nav.home', 'href' => '/'],
    ['key' => 'nav.about', 'href' => '#about'],
    ['key' => 'nav.projects', 'href' => '#projects'],
    ['key' => 'nav.contact', 'href' => '#contact'],
]"
/>

<main>
@include('sections.hero')

{{-- <section id="about" class="py-20 bg-surface ">@include('sections.about')</section> --}}

{{-- <section id="skills" class="py-20 bg-bg">@include('sections.skills')</section>

<section id="experience" class="py-20 bg-bg">@include('sections.experience')</section> --}}

{{-- <section id="projects" class="py-20 bg-bg">@include('sections.project')</section> --}}

{{-- <section id="education" class="py-24 bg-bg">@include('sections.education')</section> --}}

{{-- <section id="contact" class="py-24 bg-surface">@include('sections.contact')</section> --}}
</main>

<x-footer
brand="Fadlan"
:links="[
    ['key' => 'nav.home', 'href' => '#home'],
    ['key' => 'nav.about', 'href' => '#about'],
    ['key' => 'nav.projects', 'href' => '#projects'],
    ['key' => 'nav.contact', 'href' => '#contact'],
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
