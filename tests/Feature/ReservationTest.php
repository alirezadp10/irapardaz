<?php

namespace Tests\Feature;

use App\Models\Show;
use App\Models\TimeTable;
use App\Models\Viewer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Recca0120\LaravelParallel\ParallelRequest;
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

    /**
     * @test
     * @group race-condition
     */
    public function if_multiple_viewers_attempt_to_reserve_the_last_capacity_of_the_show_there_will_only_one_of_them_can_achieve_this()
    {
        $this->switchToMysql();

        for ($i = 0; $i < 10; $i++) {

            $timeTable = TimeTable::factory()->hasReserves(5)->create([
                'day'     => 'fri',
                'time'    => '12:00',
                'show_id' => Show::factory()->create(['capacity' => 6])->id
            ]);

            $viewer = Viewer::factory()->create();

            $request = $this->app->make(ParallelRequest::class);

            $promises = collect($request->times(3)->post('reserves/', [
                'viewer_id'     => $viewer->id,
                'time_table_id' => $timeTable->id,
            ], [
                'Accept' => 'application/json'
            ]));

            $statuses = collect();

            $promises->map->wait()->each(function ($response) use ($statuses) {
                $statuses->add($response->status());
            });

            $this->assertCount(2, $statuses->filter(fn($status) => $status == 422));

            $this->assertCount(1, $statuses->filter(fn($status) => $status == 201));

            $this->assertEquals(6, $timeTable->reserves()->count());
        }

        $this->switchToSqlite();
    }
}
