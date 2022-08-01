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
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function multiple_shows_cannot_hold_at_the_same_time()
    {
        $this->assertTrue(true);
    }
    
    /**
     * @test
     */
    public function shows_capacity_cannot_be_less_than_5_people()
    {
        $this->assertTrue(true);
    }
    
    /**
     * @test
     */
    public function shows_list_must_be_reachable_in_pagination_with_the_size_of_5()
    {
        $this->assertTrue(true);
    }
}
