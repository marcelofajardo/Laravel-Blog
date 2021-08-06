<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class PostLikeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function preview_component_can_like_a_post()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();
        $post = Post::factory()->Create(['postable_id' => $user2->id]);

        Livewire::actingAs($user);
        Livewire::test('post.preview', ['post' => $post])
            ->assertSet('post', $post)
            ->call('like');

        $this->assertDatabaseHas('likes', ['liked' => true]);
    }

    /** @test */
    public function preview_component_cannot_like_own_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->Create(['postable_id' => $user->id]);

        Livewire::actingAs($user);
        Livewire::test('post.preview', ['post' => $post])
            ->assertSet('post', $post)
            ->call('like');

        $this->assertDatabaseMissing('likes', ['liked' => true]);
    }

    /** @test */
    public function post_show_component_can_like_a_post()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();
        $post = Post::factory()->Create(['postable_id' => $user2->id]);

        Livewire::actingAs($user);
        Livewire::test('post.show', ['post' => $post])
            ->assertSet('post', $post)
            ->call('like')
            ->assertNoRedirect();

        $this->assertDatabaseHas('likes', ['liked' => true]);
    }

    /** @test */
    public function post_show_component_cannot_like_own_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->Create(['postable_id' => $user->id]);
        Livewire::actingAs($user);
        Livewire::test('post.show', ['post' => $post])
            ->assertSet('post', $post)
            ->call('like');

        $this->assertDatabaseMissing('likes', ['liked' => true]);
    }
}
