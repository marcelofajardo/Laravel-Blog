<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    // create
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

    // update
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

    // delete

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



    // /** @test */
    // public function edit_comment()
    // {
    //     $this->withoutExceptionHandling();
    //     $attr = $this->createComment();
    //     $response = $this->actingAs($attr['user'])
    //         ->get('/comment/'. $attr['comment']->id .'/edit');
    //     $response->assertSuccessful();
    // }

    // /** @test */
    // public function update_Comment()
    // {
    //     $attr = $this->createComment();

    //     $response = $this->actingAs($attr['user'])
    //         ->put('/comment/'. $attr['comment']->id, [
    //             'body' => 'Update comment'
    //         ]);
    //     $this->assertEquals('Update comment', $attr['comment']->fresh()->body);
    //     $response->assertRedirect('/post/'. $attr['post']->id);
    // }

    // /** @test */
    // public function delete_comment()
    // {
    //     $attr = $this->createComment();
    //     $response = $this->actingAs($attr['user'])
    //         ->delete('/comment/'. $attr['comment']->id);
    //     $this->assertDatabaseCount('comments', 0);
    //     $response->assertRedirect('/post/'. $attr['post']->id);
    // }

    // /** @test */
    // public function hero_like_comment()
    // {
    //     $attr = $this->createComment();
    //     $response = $this->actingAs($attr['user'])
    //         ->post('/comment/'. $attr['comment']->id. '/like');
    //     $this->assertDatabaseCount('likes', 1);
    //     // $response->assertRedirect('/post/'. $attr['post']->id);
    //     return $attr;
    // }

    // /** @test */
    // public function hero_dislike_comment()
    // {
    //     $attr = $this->createComment();
    //     $response = $this->actingAs($attr['user'])
    //     ->delete('/comment/'. $attr['comment']->id. '/dislike');
    //     // $response->assertRedirect('/post/'. $attr['post']->id);
    //     $response->assertStatus(302);
    //     return $attr;
    // }

    // /** @test */
    // public function hero_unlike_comment()
    // {
    //     $attr = $this->hero_like_comment();
    //     $response = $this->actingAs($attr['user'])
    //     ->post('/comment/'. $attr['comment']->id. '/like');
    //     $this->assertDatabaseCount('likes', 0);
    // }

    // /** @test */
    // public function hero_undislike_comment()
    // {
    //     $attr = $this->hero_dislike_comment();

    //     $response = $this->actingAs($attr['user'])
    //     ->delete('/comment/'. $attr['comment']->id. '/dislike');
    //     // $response->assertRedirect('/post/'. $attr['post']->id);
    //     $response->assertStatus(302);
    // }

    // public function createComment()
    // {
    //     $user = User::factory()->create();
    //     $post = $user->hero->posts()->create([
    //       'body' => 'Lorem Ipsum'
    //       ]);
    //     $comment = $user->hero
    //         ->posts->first()
    //         ->comments()->create([
    //         'user_id' => $user->id,
    //         'body' => "Lorem Ipsum"
    //     ]);

    //     return [
    //       'user' => $user,
    //       'post' => $post,
    //       'comment' => $comment
    //      ];
    // }
}
