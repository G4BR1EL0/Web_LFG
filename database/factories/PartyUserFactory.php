<?php

namespace Database\Factories;

use App\Models\PartyUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartyUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PartyUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'party_id' => $this->faker->numberBetween(2, 7),
            'user_id' => $this->faker->numberBetween(1, 31)
        ];
    }
}
