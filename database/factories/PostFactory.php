<?php

namespace Database\Factories;

use App\Enums\PostLayout;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $htmlContent = "<p>" . fake()->paragraph . "</p>";
        $htmlContent .= "<h1>" . fake()->sentence . "</h1>";

        $imgUrl = fake()->imageUrl();
        $htmlContent .= "<img src='$imgUrl'>";

        $index = 0;

        while (true) {
            $htmlContent .= "<p>" . fake()->paragraph . "</p>";

            if ($index > 30) {
                break;
            }
            $index++;
        }


        return [
            //
            'title' => fake()->sentence(),
            'thumbnail' => asset('static/default_thumbnail.png'),
            'body' => $htmlContent,
            'published_at' => now(),
            'status' => \App\Enums\PostStatus::PUBLISHED->value,
            'layout' => fake()->randomElement(PostLayout::cases())->value,
            'user_id' => fake()->randomElement(User::pluck('id')->toArray()),
        ];
    }
}
