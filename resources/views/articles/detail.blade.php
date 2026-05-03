@extends("layouts.app")

@section("content")
    <div class="container" style="max-width: 700px">
        {{-- Article Card --}}
        <div class="card glass-card mb-4">
            <div class="card-body p-4">
                <h2 class="fw-bold mb-2">{{ $article->title }}</h2>
                <div class="small mb-3">
                    <b class="text-success">{{ $article->user->name }}</b> •
                    <span class="text-muted">Category: {{ $article->category->name }}</span> •
                    <span class="text-muted">{{ $article->created_at->diffForHumans() }}</span>
                </div>
                <p>{{ $article->body }}</p>
                @auth
                    @can("delete-article", $article)
                        <a href="{{ url("/articles/delete/$article->id") }}" class="btn btn-sm btn-outline-danger border-0">
                            <i class="bi bi-trash3 me-1"></i> Delete Article
                        </a>
                    @endcan
                @endauth
            </div>
        </div>

        {{-- Comments Section --}}
        <div class="mt-5">
            <h5 class="fw-bold mb-3 d-flex align-items-center">
                <i class="bi bi-chat-left-text-fill me-2 text-primary"></i>
                Comments <span class="badge rounded-pill ms-2" style="background: var(--input-bg); color: var(--text-main)">{{ count($article->comments) }}</span>
            </h5>

            <div class="list-group list-group-flush rounded-3 overflow-hidden">
                @foreach($article->comments as $comment)
                    <div class="list-group-item border-0 p-3 mb-2 rounded shadow-sm" style="background: var(--card-bg); border: 1px solid var(--border) !important;">
                        @auth
                            @can("delete-comment", $comment)
                                {{-- Updated Red Delete Button --}}
                                <a href="{{ url("/comments/delete/$comment->id") }}"
                                    class="float-end text-danger delete-btn"
                                    title="Delete Comment">
                                    <i class="bi bi-x-lg"></i>
                                </a>
                            @endcan
                        @endauth

                        <div class="d-flex align-items-center mb-1">
                            <b style="color: #23a559" class="me-2">{{ $comment->user->name }}</b>
                            <span class="small text-muted">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <div style="color: var(--text-main)">
                            {{ $comment->content }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Add Comment Form --}}
        @auth
            <div class="card glass-card mt-4">
                <div class="card-body p-3">
                    <form action="{{ url("/comments/create") }}" method="post">
                        @csrf
                        <input type="hidden" name="article_id" value="{{ $article->id }}">
                        <label class="small fw-bold text-uppercase opacity-75 mb-2">Leave a comment</label>
                        <textarea name="content" class="form-control mb-3" rows="3" placeholder="Type a comment..." required></textarea>
                        <button class="btn btn-primary px-4">Post Comment</button>
                    </form>
                </div>
            </div>
        @endauth
    </div>

    <style>
        .delete-btn {
            transition: transform 0.2s, color 0.2s;
            text-decoration: none;
            opacity: 0.7;
        }
        .delete-btn:hover {
            transform: scale(1.2);
            color: #ff4747 !important;
            opacity: 1;
        }
    </style>
@endsection
