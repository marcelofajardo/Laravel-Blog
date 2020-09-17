<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\Post;
use App\Models\Comment;
use App\Policies\PostPolicy;
use App\Policies\PostCommentPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-comment', function ($user, $comment) {
            return $user->id === $comment->user_id;
        });
        Gate::define('delete-comment', function ($user, $comment) {
            return $user->id === $comment->user_id;
        });
    }
}
