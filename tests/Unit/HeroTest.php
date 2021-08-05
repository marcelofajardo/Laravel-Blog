<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\User;

class HeroTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function hero_is_created_after_user_registration()
    {
        User::factory()->create();
        $this->assertDatabaseCount('heroes', 1);
    }
}
