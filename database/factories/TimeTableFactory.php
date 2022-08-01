<?php

namespace Database\Factories;

use App\Models\Show;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TimeTable>
 */
class TimeTableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'day'     => $this->faker->randomElement(['sat', 'sun', 'mon', 'tue', 'wed', 'thu', 'fri']),
            'time'    => now()->format('H:i'),
            'show_id' => Show::factory()
        ];
    }
}
