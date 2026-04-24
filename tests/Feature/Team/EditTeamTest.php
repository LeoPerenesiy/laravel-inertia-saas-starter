<?php

namespace Tests\Feature\Team;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\RedirectResponse;
use Tests\TestCase;

class EditTeamTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_update_team_name(): void
    {
        $owner = User::factory()->create();

        $team = Team::factory()->create([
            'owner_id' => $owner->id,
            'name' => 'Old Name',
        ]);

        $this->actingAs($owner);

        $response = $this->patch("/team/{$team->id}", [
            'name' => 'New Name',
        ]);

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('teams', [
            'id' => $team->id,
            'name' => 'New Name',
        ]);
    }
}
