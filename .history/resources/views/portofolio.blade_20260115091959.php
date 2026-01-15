<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Portfolio | Fadlan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            bg: 'var(--color-bg)',
            surface: 'var(--color-surface)',
            border: 'var(--color-border)',
            text: 'var(--color-text)',
            muted: 'var(--color-muted)',
            primary: 'var(--color-primary)',
            success: 'var(--color-success)',
            danger: 'var(--color-danger)',
            warning: 'var(--color-warning)',
          }
        }
      }
    }
  </script>
  <style>
    :root {
      --color-bg: #1c1c1e;
      --color-surface: #262629;
      --color-border: #3a3a3d;
      --color-text: #f4f4f5;
      --color-muted: #a1a1aa;
      --color-primary: #b91c1c;
      --color-success: #6fbf8f;
      --color-danger:  #ef4444;
      --color-warning: #eab308;
    }

    html {
      scroll-behavior: smooth;
    }

* {
  scrollbar-width: thin;
  scrollbar-color: #ef4444 transparent;
}

::-webkit-scrollbar {
  width: 10px;
}

::-webkit-scrollbar-track {
  background: transparent;
}

::-webkit-scrollbar-thumb {
  background: linear-gradient(
    180deg,
    #ef4444,
    #dc2626
  );
  border-radius: 999px;
  border: 2px solid transparent;
  background-clip: content-box;
}

::-webkit-scrollbar-thumb:hover {
  background: linear-gradient(
    180deg,
    #f87171,
    #ef4444
  );
}

  </style>
</head>

<body class="bg-bg text-text">
  <header> @include('components.header') </header>
  
  <main>
    <section id="home" class="relative min-h-screen flex items-center px-6 overflow-hidden">  @include('sections.hero')</section>
    <section id="about" class="py-20 bg-surface">@include('sections.about')</section>
    <section id="experience" class="py-20">@include('sections.experience')</section>
    <section id="education" class="py-24 bg-bg">@include('sections.education')</section>
    <section id="projects" class="py-20 bg-bg">@include('sections.project')</section>
    <section id="contact" class="py-24 bg-bg">@include('sections.contact')</section>
    <section id="skills" class="py-20 bg-surface"></section>
  </main>

  <footer class="relative border-t border-border bg-bg">@include('components.footer')</footer>
</body>
</html>