<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class HeroFollowTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_follow_a_hero()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();

        Livewire::actingAs($user);

        Livewire::test('follow-button', ['hero' => $user2->hero])
            ->call('follow');
        $this->assertDatabaseCount('hero_user', 1);
    }

    /** @test */
    public function user_can_unfollow_a_hero()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();

        Livewire::actingAs($user);

        $user->following()->attach($user2->hero);
        $this->assertDatabaseCount('hero_user', 1);

        Livewire::test('follow-button', ['hero' => $user2->hero])
            ->call('follow');
        $this->assertDatabaseCount('hero_user', 0);
    }
}
