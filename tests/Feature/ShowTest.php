<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function show_can_be_created_by_user()
    {
        $this->postJson('/show', [
            'name'     => 'first show',
            'times'    => [
                [
                    'day'  => 'sat',
                    'time' => '15:00'
                ],
                [
                    'day'  => 'fri',
                    'time' => '13:30'
                ],
            ],
            'capacity' => 10
        ])->assertCreated();
    }

    /**
     * @test
     */
    public function multiple_shows_cannot_hold_at_the_same_time()
    {
        \App\Models\TimeTable::factory()->create([
            'day'  => 'sat',
            'time' => '13:00',
        ]);

        $response = $this->postJson('/show', [
            'name'     => 'second show',
            'times'    => [
                [
                    'day'  => 'sat',
                    'time' => '13:00'
                ],
                [
                    'day'  => 'fri',
                    'time' => '13:30'
                ],
            ],
            'capacity' => 10
        ]);

        $response->assertJsonValidationErrors([
            'times.0' => 'multiple shows cannot hold at the same time'
        ]);
    }

    /**
     * @test
     */
    public function shows_capacity_cannot_be_less_than_5_people()
    {
        $response = $this->postJson('/show', [
            'name'     => 'second show',
            'times'    => [
                [
                    'day'  => 'sat',
                    'time' => '13:00'
                ],
                [
                    'day'  => 'fri',
                    'time' => '13:30'
                ],
            ],
            'capacity' => 4
        ]);

        $response->assertJsonValidationErrors([
            'capacity' => 'shows capacity cannot be less than 5 people'
        ]);
    }

    /**
     * @test
     */
    public function shows_list_must_be_reachable_in_pagination_with_the_size_of_5()
    {
        \App\Models\Show::factory(17)->create();

        $response = $this->getJson('/show')->assertOk()->assertJsonStructure([
            'data' => [
                [
                    "id",
                    "name",
                    "times" => [
                        [
                            'day',
                            'time'
                        ]
                    ],
                    "capacity",
                    "updated_at",
                    "created_at",
                ],
            ],
        ])->assertJsonCount(5, 'data');

        $this->assertCount(17, $response->json('data.total'));
    }
}
