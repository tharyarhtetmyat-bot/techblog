<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::define("delete-article", function($user, $article) {
            return $user->id == $article->user_id;
        });

        Gate::define("delete-comment", function ($user, $comment) {
            return $user->id == $comment->user_id
                or $user->id == $comment->article->user_id;
        });

        Paginator::useBootstrap();
    }
}
