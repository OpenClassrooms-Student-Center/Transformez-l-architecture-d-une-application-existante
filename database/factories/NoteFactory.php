<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Tag;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),  
            'tag_id' => Tag::factory(),
            'text' => $this->faker->paragraphs(2, true),
        ];
    }
}
