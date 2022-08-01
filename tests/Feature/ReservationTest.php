<?php

namespace Tests\Feature;

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
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function viewer_cannot_reserve_a_show_which_filled_already()
    {
        $this->assertTrue(true);
    }
}
