<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meal>
 */
class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

            $status = $this->faker->randomElement(['created', 'updated', 'deleted']);
            $categoryId = $this->faker->randomElement([Category::all()->random()->id, null]);

        return [
            'category_id' => $categoryId,
            'status' => $status,
            'updated_at' => $status == 'updated' ? $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+2years', $timezone = null): NULL,
            'deleted_at' => $status == 'deleted' ? $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+2years', $timezone = null): NULL
        ];

    }
}
