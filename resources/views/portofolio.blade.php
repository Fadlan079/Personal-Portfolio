<!DOCTYPE html>
<html lang="id" class="theme-dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Portfolio | Fadlan</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
</head>

<body class="bg-bg text-text">
  <x-navbar 
    brand="Fadlan"
    :menus="[
        ['label' => 'Home', 'href' => '#home'],
        ['label' => 'About', 'href' => '#about'],
        ['label' => 'Experience', 'href' => '#experience'],
        ['label' => 'education', 'href' => '#education'],
        ['label' => 'Projects', 'href' => '#projects'],
        ['label' => 'Contact', 'href' => '#contact'],
        ['label' => 'Skills', 'href' => '#skills'],
    ]"
  />

  <main>
    <section id="home" class="relative min-h-screen flex items-center px-6 overflow-hidden">  @include('sections.hero')</section>
    
    <section id="about" class="py-20 bg-surface">@include('sections.about')</section>

    <section id="experience" class="py-20">@include('sections.experience')</section>

    <section id="education" class="py-24 bg-bg">@include('sections.education')</section>

    <section id="projects" class="py-20 bg-bg">@include('sections.project')</section>

    <section id="contact" class="py-24 bg-bg">@include('sections.contact')</section>

    <section id="skills" class="py-20 bg-surface">@include('sections.skills')</section>
  </main>

  <x-footer
    brand="Fadlan.dev"
    description="Full Stack Developer yang fokus pada pengembangan aplikasi web modern menggunakan Laravel, frontend responsif, dan backend yang scalable."
    :links="[
        ['label' => 'Home', 'href' => '#home'],
        ['label' => 'About', 'href' => '#about'],
        ['label' => 'Experience', 'href' => '#experience'],
        ['label' => 'education', 'href' => '#education'],
        ['label' => 'Projects', 'href' => '#projects'],
        ['label' => 'Contact', 'href' => '#contact'],
        ['label' => 'Skills', 'href' => '#skills'],
    ]"
    :socials="[
        ['icon' => 'fa-brands fa-github', 'href' => 'https://github.com/Fadlan079'],
        ['icon' => 'fa-brands fa-instagram', 'href' => 'https://instagram.com/fdln007'],
        ['icon' => 'fa-solid fa-envelope', 'href' => 'mailto:fadlanfirdaus220@gmail.com'],
    ]"
  />
</body>
</html>