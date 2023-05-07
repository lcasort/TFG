<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $comp = [];
        
        $temp = [];
        do {
            $userId = $this->faker->randomElement(User::pluck('id')->toArray());
            $contentId = $this->faker->randomNumber(6, false);
            $temp = [$userId, $contentId];
        } while(in_array($temp, $comp));

        $comp[] = [$userId, $contentId];

        return [
            'user_id' => $temp[0],
            'content_id' => $temp[1],
            'rating' => $this->faker->numberBetween(0, 5),
        ];
    }
}
