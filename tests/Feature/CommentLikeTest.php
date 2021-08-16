<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CommentLikeTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function can_like_comment()
    {

        $user = User::factory()->create();
        $post = Post::factory()->has(Comment::factory(['user_id' => $user->id]))->create();
        $comment = Comment::first();

        Livewire::actingAs($user);

        Livewire::test('comment.show', ['comment' => $comment])
            ->call('like');

        $this->assertDatabaseCount('likes', 1);
        $this->assertDatabaseHas('likes', ['liked' => true]);
    }

    /** @test */
    public function can_dislike_comment()
    {

        $user = User::factory()->create();
        $post = Post::factory()->has(Comment::factory(['user_id' => $user->id]))->create();
        $comment = Comment::first();

        Livewire::actingAs($user);

        Livewire::test('comment.show', ['comment' => $comment])
            ->call('dislike');

        $this->assertDatabaseCount('likes', 1);
        $this->assertDatabaseHas('likes', ['liked' => false]);
    }
    /** @test */
    public function can_undo_like_comment()
    {

        $user = User::factory()->create();
        $post = Post::factory()->has(Comment::factory(['user_id' => $user->id]))->create();
        $comment = Comment::first();

        Livewire::actingAs($user);

        $comment->like();
        $this->assertDatabaseCount('likes', 1);

        Livewire::test('comment.show', ['comment' => $comment])
            ->call('like');

        $this->assertDatabaseCount('likes', 0);
    }

    /** @test */
    public function can_undo_dislike_comment()
    {

        $user = User::factory()->create();
        $post = Post::factory()->has(Comment::factory(['user_id' => $user->id]))->create();
        $comment = Comment::first();

        Livewire::actingAs($user);

        $comment->dislike();
        $this->assertDatabaseCount('likes', 1);

        Livewire::test('comment.show', ['comment' => $comment])
            ->call('dislike');

        $this->assertDatabaseCount('likes', 0);
    }
}
