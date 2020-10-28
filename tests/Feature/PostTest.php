<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function show_post()
    {
        $attr = $this->createPost();
        $response = $this->actingAs($attr['user'])
            ->get('/post/'. $attr['post']->id);
        $response->assertSuccessful();
    }

    /** @test */
    public function edit_post()
    {
        $attr = $this->createPost();
        $response = $this->actingAs($attr['user'])
            ->get('/post/'. $attr['post']->id .'/edit');
        $response->assertSuccessful();
    }

    /** @test */
    public function update_post()
    {
        $attr = $this->createPost();

        $response = $this->actingAs($attr['user'])
            ->put('/post/'. $attr['post']->id, [
                'body' => 'Update post'
            ]);
        $this->assertEquals('Update post', $attr['post']->fresh()->body);
        $response->assertRedirect('/post/'. $attr['post']->id);
    }

    /** @test */
    public function delete_post()
    {
        $attr = $this->createPost();
        $response = $this->actingAs($attr['user'])
            ->delete('/post/'. $attr['post']->id);
        $this->assertDatabaseCount('posts', 0);
        $response->assertRedirect('/user/hero/'. $attr['user']->hero->id);
    }

    /** @test */
    public function post_store_comment()
    {
        $attr = $this->createPost();
        $response = $this->actingAs($attr['user'])
            ->post('/post/'. $attr['post']->id .'/comment', [
                'body' => 'Lorem Ipsum'
            ]);
        $this->assertDatabaseCount('comments', 1);
        // $response->assertRedirect('/posts/'. $attr['post']->id);

    }
    public function createPost()
    {
        $user = User::factory()->create();
        $user->hero->posts()->create([
          'body' => 'Lorem Ipsum'
          ]);
        $post = $user->hero->posts()->first();

        return [
          'user' => $user,
          'post' => $post
         ];
    }
}
