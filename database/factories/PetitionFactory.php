<?php

namespace Database\Factories;

use App\Models\Petition;
use Illuminate\Database\Eloquent\Factories\Factory;

class PetitionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Petition::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'description'  => $this->faker->text,
            'user_id' => random_int(3,12),
        ];
    }
}
