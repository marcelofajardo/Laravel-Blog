<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class HeroTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function hero_show_page_contains_post_index_livewire_component()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user);

        $response = $this->get("/users/heroes/{$user->id}")
            ->assertSeeLivewire('post.index');
        $response->assertStatus(200);
    }

    /** @test */
    public function can_redirect_to_show_hero_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get("/users/heroes/{$user->id}");
        $response->assertOk();
        $response->assertViewIs('hero.show');
        $response->assertViewHas('hero');
    }

    /** @test */
    public function not_auth_user_cannot_redirect_to_show_hero_page()
    {
        $user = User::factory()->create();
        $response = $this->get("/users/heroes/{$user->id}");
        $response->assertRedirect('/login');
    }

    /** @test */
    public function can_redirect_to_edit_hero_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get("/users/heroes/{$user->id}/edit");
        $response->assertOk();
        $response->assertViewIs('hero.edit');
        $response->assertViewHas('hero');
    }

    /** @test */
    public function not_auth_user_cannot_redirect_to_edit_hero_page()
    {
        $user = User::factory()->create();

        $response = $this->get("users/heroes/{$user->id}/edit");
        $response->assertRedirect('login');
    }

    /** @test */
    public function can_update_hero()
    {
        $user = User::factory()->create();
        $data = [
            'bio' => $this->faker()->sentence()
        ];

        $this->actingAs($user);

        $response = $this->put("/users/heroes/{$user->id}", $data);
        $response->assertRedirect("/users/heroes/{$user->id}");

        $this->assertEquals($data['bio'], $user->fresh()->hero->bio);
    }

    /** @test */
    public function unauthorize_hero_can_not_update_hero_info()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();
        $data = [
            'bio' => $this->faker()->sentence()
        ];

        $this->actingAs($user2);

        $response = $this->put("/users/heroes/{$user->id}", $data);
        $response->assertForbidden();
        $this->assertNotEquals($data['bio'], $user->fresh()->hero->bio);
    }
}
