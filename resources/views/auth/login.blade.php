@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary: #5865F2;
        /* Light Mode */
        --bg-color: #f2f3f5;
        --bg-mesh: radial-gradient(at 0% 0%, #e0e7ff 0, transparent 50%),
                    radial-gradient(at 100% 100%, #fae8ff 0, transparent 50%);
        --nav-bg: rgba(255, 255, 255, 0.8);
        --card-bg: rgba(255, 255, 255, 0.9);
        --text-main: #060607;
        --text-muted: #4e5058;
        --input-bg: #ebedef;
        --border: rgba(0, 0, 0, 0.08);
    }

    /* THE FIX: Explicit Dark Mode overrides */
    [data-theme='dark'] {
        --bg-color: #111214; /* Pure Discord Dark */
        --bg-mesh: radial-gradient(at 0% 0%, rgba(88, 101, 242, 0.15) 0, transparent 50%),
                    radial-gradient(at 100% 100%, rgba(0, 0, 0, 0) 0, transparent 50%);
        --nav-bg: rgba(30, 31, 34, 0.95);
        --card-bg: #313338; /* Solid Discord Card Color */
        --text-main: #f2f3f5;
        --text-muted: #b5bac1;
        --input-bg: #1e1f22;
        --border: rgba(0, 0, 0, 0.2);
    }

    body {
        background: var(--bg-color); /* Fallback */
        background-image: var(--bg-mesh);
        background-attachment: fixed;
        color: var(--text-main);
        font-family: 'Inter', sans-serif;
        min-height: 100vh;
        transition: all 0.2s ease;
        margin: 0;
    }

    .navbar {
        background: var(--nav-bg) !important;
        backdrop-filter: blur(10px);
        border-bottom: 1px solid var(--border) !important;
    }

    .navbar-brand, .nav-link { color: var(--text-main) !important; }

    .glass-card {
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: 8px; /* Slightly squarer for Discord vibe */
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        margin-top: 15vh;
    }

    .form-control {
        background: var(--input-bg);
        border: none;
        color: var(--text-main);
        padding: 10px;
    }

    .form-control:focus {
        background: var(--input-bg);
        color: var(--text-main);
        box-shadow: none;
        border: 1px solid var(--primary);
    }

    .btn-primary {
        background: var(--primary);
        border: none;
        font-weight: 600;
        transition: background 0.2s;
    }

    .btn-primary:hover { background: #4752c4; }

    .theme-toggle {
        position: fixed;
        bottom: 25px;
        right: 25px;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: var(--primary);
        color: white;
        border: none;
        cursor: pointer;
        font-size: 1.2rem;
        z-index: 1000;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card glass-card">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h4 class="fw-bold">Welcome Back</h4>
                        <p class="small" style="color: var(--text-muted)">We're so excited to see you again!</p>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="small fw-bold text-uppercase opacity-75">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="small fw-bold text-uppercase opacity-75">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mb-2">Log In</button>
                        <p class="small mb-0" style="color: var(--text-muted)">Need an account? <a href="{{ route('register') }}" class="text-decoration-none" style="color: var(--primary)">Register</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<button class="theme-toggle" onclick="toggleTheme()" id="themeIcon">
    <i class="bi bi-moon-stars-fill"></i>
</button>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<script>
    const icon = document.getElementById('themeIcon');
    function setTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
        icon.innerHTML = theme === 'dark' ? '<i class="bi bi-sun-fill"></i>' : '<i class="bi bi-moon-stars-fill"></i>';
    }
    function toggleTheme() {
        const current = localStorage.getItem('theme') === 'dark' ? 'light' : 'dark';
        setTheme(current);
    }
    setTheme(localStorage.getItem('theme') || 'dark');
</script>
@endsection
