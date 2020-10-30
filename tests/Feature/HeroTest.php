<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\Post;
use Livewire;
use App\Http\Livewire\CreatePost;

class HeroTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function show_hero()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->get('/user/hero/'. $user->id);
        $response->assertSuccessful();
    }

    /** @test */
    public function edit_hero()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->get("/user/hero/{$user->id}/edit");
        $response->assertSuccessful();
    }

    /** @test */
    public function update_hero()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->put("/user/hero/{$user->id}", [
                'bio' => 'this is a string'
            ]);
        $this->assertEquals('this is a string', $user->fresh()->hero->bio);
        $response->assertRedirect("/user/hero/{$user->id}");
    }

    // TODO: test file/ test more
    /** @test */
    public function hero_store_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Livewire::test(CreatePost::class)
            ->set('model', $user->hero)
            ->set('body', 'foobar')
            ->call('save');

        $this->assertTrue(Post::whereBody('foobar')->exists());
    }
}
