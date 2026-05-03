<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Inter:400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

<style>
    :root {
        --primary: #5865F2;
        --bg-main: #f2f3f5;
        --bg-mesh: radial-gradient(at 0% 0%, #e0e7ff 0, transparent 50%),
                    radial-gradient(at 100% 100%, #fae8ff 0, transparent 50%);
        --nav-bg: rgba(255, 255, 255, 0.8);
        --card-bg: rgba(255, 255, 255, 0.9);
        --text-main: #060607;
        --text-muted: #4e5058;
        --input-bg: #ebedef;
        --border: rgba(0, 0, 0, 0.08);
        --dropdown-bg: #ffffff;
    }

    [data-theme='dark'] {
        --bg-main: #111214;
        --bg-mesh: radial-gradient(at 0% 0%, rgba(88, 101, 242, 0.15) 0, transparent 50%);
        --nav-bg: rgba(30, 31, 34, 0.95);
        --card-bg: #313338;
        --text-main: #f2f3f5;
        --text-muted: #b5bac1; /* This is the light grey we want for metadata */
        --input-bg: #1e1f22;
        --border: rgba(255, 255, 255, 0.05);
        --dropdown-bg: #2b2d31;
    }

    body {
        background-color: var(--bg-main) !important;
        background-image: var(--bg-mesh) !important;
        background-attachment: fixed;
        color: var(--text-main);
        font-family: 'Inter', sans-serif;
        min-height: 100vh;
        transition: background 0.3s ease;
    }

    .navbar {
        background-color: var(--nav-bg) !important;
        backdrop-filter: blur(10px);
        border-bottom: 1px solid var(--border) !important;
    }

    .navbar-brand, .nav-link { color: var(--text-main) !important; }
    .navbar-brand { gap: 0.75rem; }
    .navbar-logo {
        max-height: 32px;
        width: auto;
        display: inline-block;
    }

    .card, .glass-card {
        background: var(--card-bg) !important;
        border: 1px solid var(--border) !important;
        color: var(--text-main) !important;
    }

    /* --- FORCE DARK MODE VISIBILITY --- */

    /* This targets the "Category", "Comments", and "Time" text */
    [data-theme='dark'] .text-muted,
    [data-theme='dark'] .small,
    [data-theme='dark'] .card-subtitle {
        color: var(--text-muted) !important;
    }

    /* If you have inline styles or generic grey text in the cards */
    [data-theme='dark'] .card-body div,
    [data-theme='dark'] .card-body span {
        color: var(--text-muted) !important;
    }

    /* Ensure the username (Nero Hart, Bob, etc) stays bright green */
    .text-success {
        color: #23a559 !important;
    }

    /* Link color for "View Detail" */
    .card-body a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
    }

    .card-body a:hover {
        text-decoration: underline;
    }

    .theme-toggle {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--primary);
        color: white;
        border: none;
        z-index: 9999;
    }
</style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md sticky-top">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    @if (config('app.logo'))
                        <img src="{{ asset(config('app.logo')) }}" alt="{{ config('app.name', 'Blog') }} logo" class="navbar-logo">
                    @endif
                    <span>{{ config('app.name', 'Blog') }}</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" style="border-color: var(--border)">
                    <span class="bi bi-list" style="color: var(--text-main); font-size: 1.5rem;"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        @auth
                            <li class="nav-item">
                                <a href="{{ url("/articles/add") }}" class="nav-link" style="color: #23a559 !important;">
                                    <i class="bi bi-plus-circle-fill me-1"></i>New Article
                                </a>
                            </li>


                        @endauth
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end shadow border-0" style="background-color: var(--dropdown-bg);">
                                    <a class="dropdown-item" href="{{ route('logout') }}" style="color: var(--text-main);"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i>{{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <button class="theme-toggle" onclick="toggleTheme()" id="themeBtn">
            <i class="bi bi-moon-stars-fill"></i>
        </button>
    </div>

    <script>
        function applyTheme(theme) {
            document.documentElement.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);
            const btn = document.getElementById('themeBtn');
            if (btn) {
                btn.innerHTML = theme === 'dark'
                    ? '<i class="bi bi-sun-fill"></i>'
                    : '<i class="bi bi-moon-stars-fill"></i>';
            }
        }

        function toggleTheme() {
            const activeTheme = localStorage.getItem('theme') === 'dark' ? 'light' : 'dark';
            applyTheme(activeTheme);
        }

        window.addEventListener('DOMContentLoaded', () => {
            const saved = localStorage.getItem('theme') || 'dark';
            applyTheme(saved);
        });
    </script>
</body>
</html>
