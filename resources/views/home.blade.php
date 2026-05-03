@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary: #5865F2;
        --bg-main: #f2f3f5;
        --bg-mesh: radial-gradient(at 0% 0%, #e0e7ff 0, transparent 50%), radial-gradient(at 100% 100%, #fae8ff 0, transparent 50%);
        --card-bg: #ffffff;
        --text-main: #060607;
        --text-muted: #4e5058;
        --nav-bg: #ffffff;
        --border: rgba(0, 0, 0, 0.08);
        --alert-bg: rgba(35, 165, 89, 0.15);
        --alert-text: #23a559;
    }

    [data-theme='dark'] {
        --bg-main: #111214;
        --bg-mesh: radial-gradient(at 0% 0%, rgba(88, 101, 242, 0.15) 0, transparent 40%);
        --card-bg: #313338;
        --text-main: #f2f3f5;
        --text-muted: #b5bac1;
        --nav-bg: #1e1f22;
        --border: rgba(0, 0, 0, 0.3);
        --alert-bg: rgba(35, 165, 89, 0.2);
        --alert-text: #43b581;
    }

    body {
        background-color: var(--bg-main) !important;
        background-image: var(--bg-mesh) !important;
        background-attachment: fixed;
        color: var(--text-main);
        font-family: 'Inter', sans-serif;
        min-height: 100vh;
        transition: all 0.25s ease;
    }

    .navbar {
        background-color: var(--nav-bg) !important;
        border-bottom: 1px solid var(--border) !important;
        backdrop-filter: blur(10px);
    }

    .navbar-brand, .nav-link { color: var(--text-main) !important; }

    .dash-card {
        background-color: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.2);
        margin-top: 5vh;
        color: var(--text-main);
    }

    .card-header {
        background-color: transparent !important;
        border-bottom: 1px solid var(--border) !important;
        font-weight: 800;
        text-uppercase: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        color: var(--text-muted);
        padding: 1.25rem;
    }

    .alert-success {
        background-color: var(--alert-bg) !important;
        border: 1px solid var(--alert-text) !important;
        color: var(--alert-text) !important;
        border-radius: 8px;
        font-weight: 600;
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
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        z-index: 9999;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card dash-card">
                <div class="card-header">{{ __('System Dashboard') }}</div>

                <div class="card-body p-4">
                    @if (session('status'))
                        <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px; background-color: var(--primary) !important;">
                            <i class="bi bi-person-fill text-white"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">{{ __('Welcome back!') }}</h5>
                            <p class="mb-0 small text-muted" style="color: var(--text-muted) !important;">{{ __('You are currently logged into the blog portal.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<button class="theme-toggle" onclick="toggleTheme()" id="themeBtn">
    <i class="bi bi-moon-fill"></i>
</button>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<script>
    function applyTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
        const btn = document.getElementById('themeBtn');
        if(btn) {
            btn.innerHTML = theme === 'dark' ? '<i class="bi bi-sun-fill"></i>' : '<i class="bi bi-moon-fill"></i>';
        }
    }

    function toggleTheme() {
        const activeTheme = localStorage.getItem('theme') === 'dark' ? 'light' : 'dark';
        applyTheme(activeTheme);
    }

    applyTheme(localStorage.getItem('theme') || 'dark');
</script>
@endsection
