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
        --input-bg: #ebedef;
        --nav-bg: #ffffff;
        --border: rgba(0, 0, 0, 0.08);
    }

    [data-theme='dark'] {
        --bg-main: #111214;
        --bg-mesh: radial-gradient(at 0% 0%, rgba(88, 101, 242, 0.15) 0, transparent 40%);
        --card-bg: #313338;
        --text-main: #f2f3f5;
        --text-muted: #b5bac1;
        --input-bg: #1e1f22;
        --nav-bg: #1e1f22;
        --border: rgba(0, 0, 0, 0.3);
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

    .auth-card {
        background-color: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.2);
        margin-top: 10vh;
        color: var(--text-main);
    }

    .form-label {
        font-size: 0.75rem;
        font-weight: 800;
        text-uppercase: uppercase;
        color: var(--text-muted);
        margin-bottom: 8px;
    }

    .form-control {
        background-color: var(--input-bg) !important;
        border: none !important;
        color: var(--text-main) !important;
        padding: 12px;
        border-radius: 6px;
    }

    .form-control:focus {
        box-shadow: 0 0 0 2px var(--primary);
    }

    .btn-primary {
        background-color: var(--primary) !important;
        border: none !important;
        padding: 12px;
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
        <div class="col-md-5 col-lg-4">
            <div class="card auth-card">
                <div class="card-body p-4">
                    <h4 class="text-center fw-bold mb-4">Create an account</h4>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-uppercase">Username</label>
                            <input type="text" name="name" class="form-control" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-uppercase">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-uppercase">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-uppercase">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Continue</button>
                    </form>
                    <div class="mt-3 text-center">
                        <a href="{{ route('login') }}" class="small text-decoration-none" style="color: var(--primary)">Already have an account?</a>
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
        btn.innerHTML = theme === 'dark' ? '<i class="bi bi-sun-fill"></i>' : '<i class="bi bi-moon-fill"></i>';
    }

    function toggleTheme() {
        const activeTheme = localStorage.getItem('theme') === 'dark' ? 'light' : 'dark';
        applyTheme(activeTheme);
    }

    applyTheme(localStorage.getItem('theme') || 'dark');
</script>
@endsection
