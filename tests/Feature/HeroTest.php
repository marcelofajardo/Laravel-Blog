<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

class HeroTest extends TestCase
{
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
}
