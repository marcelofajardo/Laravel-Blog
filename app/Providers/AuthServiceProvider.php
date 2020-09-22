<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Policies\PostPolicy;
use App\Policies\PostCommentPolicy;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Hero::class => HeroPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // POST
        Gate::define('post-update', function (User $user, Post $post) {
            return $user->id === $post->user_id;
        });

        Gate::define('post-delete', function (User $user, Post $post) {
            return $user->id === $post->user_id;
        });

        // COMMENT
        Gate::define('comment-update', function (User $user, Comment $comment) {
            return $user->id === $comment->user_id;
        });

        Gate::define('comment-delete', function (User $user, Comment $comment) {
            return $user->id === $comment->user_id;
        });
    }
}
