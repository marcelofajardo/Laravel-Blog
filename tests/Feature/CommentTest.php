<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function edit_comment()
    {
        $this->withoutExceptionHandling();
        $attr = $this->createComment();
        $response = $this->actingAs($attr['user'])
            ->get('/comment/'. $attr['comment']->id .'/edit');
        $response->assertSuccessful();
    }

    /** @test */
    public function update_Comment()
    {
        $attr = $this->createComment();

        $response = $this->actingAs($attr['user'])
            ->put('/comment/'. $attr['comment']->id, [
                'body' => 'Update comment'
            ]);
        $this->assertEquals('Update comment', $attr['comment']->fresh()->body);
        $response->assertRedirect('/post/'. $attr['post']->id);
    }

    /** @test */
    public function delete_comment()
    {
        $attr = $this->createComment();
        $response = $this->actingAs($attr['user'])
            ->delete('/comment/'. $attr['comment']->id);
        $this->assertDatabaseCount('comments', 0);
        $response->assertRedirect('/post/'. $attr['post']->id);
    }

    /** @test */
    public function hero_like_comment()
    {
        $attr = $this->createComment();
        $response = $this->actingAs($attr['user'])
            ->post('/comment/'. $attr['comment']->id. '/like');
        $this->assertDatabaseCount('likes', 1);
        // $response->assertRedirect('/post/'. $attr['post']->id);
        return $attr;
    }

    /** @test */
    public function hero_dislike_comment()
    {
        $attr = $this->createComment();
        $response = $this->actingAs($attr['user'])
        ->delete('/comment/'. $attr['comment']->id. '/dislike');
        // $response->assertRedirect('/post/'. $attr['post']->id);
        $response->assertStatus(302);
        return $attr;
    }

    /** @test */
    public function hero_unlike_comment()
    {
        $attr = $this->hero_like_comment();
        $response = $this->actingAs($attr['user'])
        ->post('/comment/'. $attr['comment']->id. '/like');
        $this->assertDatabaseCount('likes', 0);
    }

    /** @test */
    public function hero_undislike_comment()
    {
        $attr = $this->hero_dislike_comment();

        $response = $this->actingAs($attr['user'])
        ->delete('/comment/'. $attr['comment']->id. '/dislike');
        // $response->assertRedirect('/post/'. $attr['post']->id);
        $response->assertStatus(302);
    }

    public function createComment()
    {
        $user = User::factory()->create();
        $post = $user->hero->posts()->create([
          'body' => 'Lorem Ipsum'
          ]);
        $comment = $user->hero
            ->posts->first()
            ->comments()->create([
            'user_id' => $user->id,
            'body' => "Lorem Ipsum"
        ]);

        return [
          'user' => $user,
          'post' => $post,
          'comment' => $comment
         ];
    }
}
