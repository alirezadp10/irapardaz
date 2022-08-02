<?php

namespace Tests\Feature;

use App\Models\Show;
use App\Models\TimeTable;
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

        $timeTable = TimeTable::factory()->create(['day' => 'fri', 'time' => '12:00']);

        $show = Show::factory()->create(['capacity' => 6]);

        $show->schedules()->save($timeTable);

        $this->postJson('/reserves', [
            'viewer_id'     => $viewer->id,
            'time_table_id' => $timeTable->id,
        ])->assertCreated();

        $this->assertDatabaseHas('reservations', [
            'viewer_id'     => $viewer->id,
            'time_table_id' => $timeTable->id,
        ]);
    }

    /**
     * @test
     */
    public function viewer_cannot_reserve_a_show_which_filled_already()
    {
        $show = Show::factory()->create(['capacity' => 6]);

        $timeTable = TimeTable::factory()->hasReserves(6)->create([
            'day'     => 'fri',
            'time'    => '12:00',
            'show_id' => $show->id
        ]);

        $viewer = Viewer::factory()->create();

        $this->postJson('/reserves', [
            'viewer_id'     => $viewer->id,
            'time_table_id' => $timeTable->id,
        ])->assertJsonValidationErrors([
            'time_table_id' => 'The capacity of this time is full.'
        ]);
    }
}
