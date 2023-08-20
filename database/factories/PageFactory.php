<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
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
        $htmlContent .= "<p>" . fake()->paragraph . "</p>";

        return [
            //
            'title' => fake()->text(10),
            'body' => $htmlContent,
            'user_id' => fake()->randomElement(\App\Models\User::pluck('id')->toArray())

        ];
    }
}
