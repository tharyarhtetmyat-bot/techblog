@extends("layouts.app")

@section("content")
    <div class="container" style="max-width: 600px; margin-top: 5vh;">

        {{-- Themed Alert for Validation Errors --}}
        @if($errors->any())
            <div class="alert border-0 shadow-sm mb-4" style="background: rgba(242, 63, 66, 0.1); color: #f23f42;">
                <ul class="mb-0 list-unstyled">
                    @foreach ($errors->all() as $err)
                        <li><i class="bi bi-exclamation-circle-fill me-2"></i>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Glass Card Wrapper --}}
        <div class="card glass-card">
            <div class="card-body p-4">
                <h4 class="fw-bold mb-3">Create New Article</h4>

                <form action="{{ url("/articles/create") }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label class="small fw-bold text-uppercase opacity-75 mb-1">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter a catchy title..." required>
                    </div>

                    <div class="mb-3">
                        <label class="small fw-bold text-uppercase opacity-75 mb-1">Body</label>
                        <textarea class="form-control" name="body" rows="5" placeholder="What's on your mind?" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="small fw-bold text-uppercase opacity-75 mb-1">Category</label>
                        <select class="form-select" name="category_id">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button class="btn btn-primary w-100 py-2">
                        <i class="bi bi-send-fill me-2"></i>Publish Article
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .form-select {
            background-color: var(--input-bg) !important;
            border: none !important;
            color: var(--text-main) !important;
            padding: 10px;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23adb5bd' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
        }
        .form-select:focus {
            box-shadow: 0 0 0 2px var(--primary) !important;
        }
        .form-select option {
            background-color: var(--dropdown-bg);
            color: var(--text-main);
        }
    </style>
@endsection
