<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-950">
<div class="relative min-h-screen">
    <div class="relative flex min-h-screen flex-col">
        <!-- Header -->
        <header class="container mx-auto px-6 py-8">
            <div class="flex items-center justify-between">
                <div class="text-white">
                    <svg class="h-12 w-auto" viewBox="0 0 62 65" fill="none">
                        <!-- ... existing Laravel SVG ... -->
                    </svg>
                </div>

                @if (Route::has('login'))
                    <nav class="flex gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="nav-link">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="nav-link">Register</a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </header>

        <!-- Hero Section -->
        <section class="container mx-auto flex flex-1 flex-col items-center justify-center px-6 py-16 select-auto">
            <h1 class="mb-8 text-center text-5xl font-bold tracking-tight text-white">
                Welcome to <span class="heading-gradient">Laravel</span>
            </h1>
            <p class="mb-12 max-w-2xl text-center text-lg text-white/70">
                Laravel is a web application framework with expressive, elegant syntax. We've already laid the foundation — freeing you to
                create without sweating the small things.
            </p>

            <div class="grid w-full max-w-6xl gap-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- Documentation Card -->
                <x-card
                    title="Documentation"
                    content="Laravel has wonderful documentation covering every aspect of the framework."
                    link="https://laravel.com/docs"
                    link_title="Learn more"
                    icon='<svg class="h-6 w-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>'
                />
                <x-card
                    title="Ecosystem"
                    content="Discover the robust ecosystem of Laravel tools and services."
                    link="#"
                    link_title="Explore"
                    icon='<svg class="h-6 w-6 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>'
                />
                <x-card
                    title="News"
                    content="Stay up to date with the latest Laravel news and updates."
                    link="https://laravel-news.com"
                    link_title="Read news"
                    icon='<svg class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" /></svg>'
                />

            </div>
        </section>

        <!-- Footer -->
        <footer class="container mx-auto px-6 py-8 text-center text-white/50">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </footer>
    </div>
</div>
</body>
</html>
