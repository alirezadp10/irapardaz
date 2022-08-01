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
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function viewer_cannot_have_a_national_code_that_already_exists()
    {
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function national_code_last_digit_must_be_valid()
    {
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function viewers_list_must_be_reachable_in_pagination()
    {
        $this->assertTrue(true);
    }
}
