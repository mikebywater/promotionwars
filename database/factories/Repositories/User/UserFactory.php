<?php

namespace Database\Factories\Repositories\User;

use App\Repositories\User\User as Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'           => $this->faker->name,
            'email'          => $this->faker->unique()->safeEmail,
            'password'       => bcrypt('secret'),
            'remember_token' => str_random(10),
        ];
    }
}
