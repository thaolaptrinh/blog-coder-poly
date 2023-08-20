<?php

namespace Database\Factories;

use App\Enums\CommentStatus;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->randomElement(User::pluck('id')->toArray()),
            'comment' => fake()->realText(20),
            // 'status' => fake()->randomElement(CommentStatus::getValues()),
            'status' => CommentStatus::APPROVED->value,
        ];
    }
}
