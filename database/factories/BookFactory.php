<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'author' => $this->faker->name(),
            'category' => $this->faker->randomElement(['Fiction', 'Non-Fiction', 'Mystery', 'Thriller']),
            'description' => $this->faker->paragraph(),
            'year_published' => $this->faker->year(),
            'image' => 'https://picsum.photos/200/300',
            'user_id' => User::factory(),
        ];
    }
}
