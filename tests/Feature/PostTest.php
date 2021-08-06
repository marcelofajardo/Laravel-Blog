<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\URL;
use Livewire\Livewire;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function preview_component_is_working()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        Livewire::actingAs($user);
        Livewire::test('post.preview', ['post' => $post])
            ->assertSet('post', $post)
            ->assertViewHas('post', $post)
            ->assertNoRedirect();
    }

    /** @test */
    public function can_create_a_post()
    {
        $user = User::factory()->create();
        Livewire::actingAs($user);
        Livewire::test('post.create', ['model' => $user->hero])
            ->assertViewHas('model', $user->hero)
            ->set('body', 'something')
            ->assertSet('body', 'something')
            ->call('save')
            ->assertHasNoErrors('body')
            ->assertEmitted('refresh-posts')
            ->assertNoRedirect();

        $this->assertDatabaseCount('posts', 1);
        $this->assertDatabaseHas('posts', ['body' => 'something']);
    }

    /** @test */
    public function body_is_required_on_creating_a_post()
    {
        $user = User::factory()->create();
        Livewire::actingAs($user);
        Livewire::test('post.create', ['model' => $user->hero])
            ->set('body', '')
            ->assertSet('body', '')
            ->call('save')
            ->assertHasErrors(['body' => 'required']);
    }

    /** @test */
    public function can_access_show_post_page()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        Livewire::actingAs($user);

        Livewire::test('post.show', ['post' => $post])
            ->assertViewHas('post', $post)
            ->assertSet('body', $post->body)
            ->assertSet('isEdit_able', false)
            ->assertNoRedirect();

        $response = $this->get("/posts/{$post->id}");
        $response->assertStatus(200);
    }

    /** @test */
    public function post_views_count_is_incremented_on_accessing_show_post_page()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'views_count' => 0
        ]);

        Livewire::actingAs($user);

        $response = $this->get("/posts/{$post->id}");
        $response->assertStatus(200);

        $this->assertEquals($post->fresh()->views_count, 1);
    }

    /** @test */
    public function can_update_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        Livewire::actingAs($user);

        Livewire::test('post.show', ['post' => $post])
            ->set('body', 'something')
            ->assertSet('body', 'something')
            ->call('update')
            ->assertHasNoErrors('body')
            ->assertEmitted('refresh-posts')
            ->assertNoRedirect();

        $this->assertDatabaseHas('posts', ['body' => 'something']);
        $this->assertDatabaseMissing('posts', ['body' => $post->body]);
    }

    /** @test */
    public function body_is_required_on_updating_a_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        Livewire::actingAs($user);

        Livewire::test('post.show', ['post' => $post])
            ->assertViewHas('post', $post)
            ->set('body', '')
            ->assertSet('body', '')
            ->call('update')
            ->assertHasErrors(['body' => 'required'])
            ->assertNoRedirect();

        $this->assertDatabaseHas('posts', ['body' => $post->body]);
    }

    /** @test */
    public function can_delete_a_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        Livewire::actingAs($user);

        Livewire::test('post.show', ['post' => $post])
            ->assertViewHas('post', $post)
            ->assertSet('previous', Url::previous())
            ->call('delete')
            ->assertRedirect(URL::previous());
        $this->assertDeleted($post);
    }
}
