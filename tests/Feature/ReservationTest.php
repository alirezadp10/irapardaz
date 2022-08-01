<?php

namespace Tests\Feature;

use App\Models\Show;
use App\Models\Viewer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReservationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function viewer_can_reserve_a_show()
    {
        $viewer = Viewer::factory()->create();

        $show = Show::factory()
            ->hasTimes(['day' => 'fri', 'time' => '12:00'])
            ->hasReserve(2)
            ->create(['capacity' => 6]);

        $this->postJson('/reserve', [
            'viewer_id' => $viewer->id,
            'show_id'   => $show->id,
            'day'       => 'fri',
            'time'      => '12:00'
        ])->assertCreated();

        $this->assertDatabaseHas('reservations', [
            'viewer_id' => $viewer->id,
            'show_id'   => $show->id,
        ]);
    }

    /**
     * @test
     */
    public function viewer_cannot_reserve_a_show_which_filled_already()
    {
        $viewer = Viewer::factory()->create();

        $show = Show::factory()
            ->hasTimes(['day' => 'fri', 'time' => '12:00'])
            ->hasReserve(6)
            ->create(['capacity' => 6]);

        $this->postJson('/reserve', [
            'viewer_id' => $viewer->id,
            'show_id'   => $show->id,
            'day'       => 'fri',
            'time'      => '12:00'
        ])->assertJsonValidationErrors([
            'time' => 'The capacity of this time is full.'
        ]);
    }
}
