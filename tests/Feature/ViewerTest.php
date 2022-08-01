<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function viewer_can_be_created_by_user()
    {
        $this->postJson('/viewer', [
            'first_name'    => 'john',
            'last_name'     => 'doe',
            'national_code' => '0018920111',
        ])->assertCreated();

        $this->assertDatabaseCount('viewers', 1);
    }

    /**
     * @test
     */
    public function viewer_cannot_have_a_national_code_that_already_exists()
    {
        \App\Models\Viewer::factory()->create([
            'national_code' => '0018920111',
        ]);

        $response = $this->postJson('/viewer', [
            'first_name'    => 'john',
            'last_name'     => 'doe',
            'national_code' => '0018920111',
        ]);

        $response->assertJsonValidationErrors([
            'national_code' => 'duplicate'
        ]);
    }

    /**
     * @test
     */
    public function national_code_last_digit_must_be_valid()
    {
        $response = $this->postJson('/viewer', [
            'first_name'    => 'john',
            'last_name'     => 'doe',
            'national_code' => '0018925201',
        ]);

        $response->assertJsonValidationErrors([
            'national_code' => 'invalid'
        ]);
    }

    /**
     * @test
     */
    public function viewers_list_must_be_reachable_in_pagination()
    {
        \App\Models\Viewer::factory(10)->create();

        $this->getJson('/viewer')->assertOk()->assertJsonStructure([
            'data' => [
                [
                    "id",
                    "first_name",
                    "last_name",
                    "national_code",
                    "created_at",
                ],
            ],
        ])->assertJsonCount(10, 'data');
    }
}
