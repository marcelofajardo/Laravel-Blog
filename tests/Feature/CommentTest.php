<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Livewire\Livewire;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function can_create_a_comment_to_a_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user->hero)->create();
        $data = ['body' => $this->faker()->sentence()];

        Livewire::actingAs($user);

        Livewire::test('comment.create', ['post' => $post])
            ->set('body', $data['body'])
            ->assertSet('body', $data['body'])
            ->call('save')
            ->assertEmitted('refresh-comments')
            ->assertHasNoErrors(['body'])
            ->assertNoRedirect();

        $this->assertDatabaseCount('comments', 1);
        $this->assertDatabaseHas('comments', ['body' => $data['body']]);

        $comment = Comment::first();
        $this->assertEquals($user->id, $comment->user_id);
        $this->assertEquals($post->id, $comment->commentable_id);
    }

    /** @test */
    public function body_is_required_when_creating_a_comment()
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user->hero)->create();
        $data = ['body' => $this->faker()->sentence()];

        Livewire::actingAs($user);

        Livewire::test('comment.create', ['post' => $post])
            ->set('body', '')
            ->assertSet('body', '')
            ->call('save')
            ->assertHasErrors(['body' => 'required'])
            ->assertNoRedirect();

        $this->assertDatabaseCount('comments', 0);
    }

    /** @test */
    public function can_update_a_comment_from_a_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->has(Comment::factory(['user_id' => $user->id]))->create();
        $comment = Comment::first();
        $data = ['body' => $this->faker()->sentence()];

        Livewire::actingAs($user);

        Livewire::test('comment.show', ['comment' => $comment])
            ->assertSet('body', $comment->body)
            ->set('body', $data['body'])
            ->assertSet('body', $data['body'])
            ->call('update')
            ->assertEmitted('refresh-comments')
            ->assertSet('isEdit_able', false)
            ->assertHasNoErrors(['body'])
            ->assertNoRedirect();

        $this->assertDatabaseHas('comments', ['body' => $data['body']]);
        $this->assertDatabaseMissing('comments', ['body' => $comment->body]);
        $this->assertDatabaseCount('comments', 1);
    }

    /** @test */
    public function body_is_required_when_updating_a_comment()
    {
        $user = User::factory()->create();
        $post = Post::factory()->has(Comment::factory(['user_id' => $user->id]))->create();
        $comment = Comment::first();

        Livewire::actingAs($user);

        Livewire::test('comment.show', ['comment' => $comment])
            ->set('body', '')
            ->assertSet('body', '')
            ->call('update')
            ->assertHasErrors(['body' => 'required'])
            ->assertNoRedirect();

        $this->assertDatabaseHas('comments', ['body' => $comment->body]);
        $this->assertDatabaseMissing('comments', ['body' => '']);
        $this->assertDatabaseCount('comments', 1);
    }

    /** @test */
    public function not_authorized_user_cannot_update_a_comment_from_a_post()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();
        $post = Post::factory()->has(Comment::factory(['user_id' => $user->id]))->create();
        $comment = Comment::first();

        Livewire::actingAs($user2);

        Livewire::test('comment.show', ['comment' => $comment])
            ->call('update')
            ->assertForbidden();

        $this->assertDatabaseHas('comments', ['body' => $comment->body]);
        $this->assertDatabaseCount('comments', 1);
    }

    /** @test */
    public function can_delete_a_comment_from_a_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->has(Comment::factory(['user_id' => $user->id]))->create();
        $comment = Comment::first();

        Livewire::actingAs($user);

        Livewire::test('comment.show', ['comment' => $comment])
            ->call('delete')
            ->assertHasNoErrors()
            ->assertNoRedirect();

        $this->assertDeleted($comment);
        $this->assertDatabaseCount('comments', 0);
    }

    /** @test */
    public function not_authorized_user_cannot_delete_a_comment_from_a_post()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();
        $post = Post::factory()->has(Comment::factory(['user_id' => $user->id]))->create();
        $comment = Comment::first();

        Livewire::actingAs($user2);

        Livewire::test('comment.show', ['comment' => $comment])
            ->call('delete')
            ->assertForbidden();

        $this->assertDatabaseHas('comments', ['body' => $comment->body]);
        $this->assertDatabaseCount('comments', 1);
    }
}
