<?php

namespace Database\Factories;

use App\Models\TimeTable;
use App\Models\Viewer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'viewer_id'     => Viewer::factory(),
            'time_table_id' => TimeTable::factory(),
        ];
    }
}
