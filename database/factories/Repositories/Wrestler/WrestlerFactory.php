<?php

namespace Database\Factories\Repositories\Wrestler;

use App\Repositories\Wrestler\Wrestler as Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class WrestlerFactory extends Factory
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
            'name'         => $this->faker->name,
            'draw'         => 70,
            'ability'      => 80,
            'charisma'     => 82,
            'mic_skills'   => 40,
            'condition'    => 100,
            'hardcore'     => 90,
            'disposition'  => 'Face',
            'promotion_id' => 1,
            'game_id'      => 1,
            'age'          => 41,
            'bio'          => 'If Tommy Dreamer was the heart and soul of ECW, then Sabu was its raw nerve. The extreme maniac who was winkingly billed as hailing from “Bombay, Mich.,” spread the gospel of a hardcore high-flying style across several continents. Whether he was tearing himself with barbed wire or flipping off the ropes through tables and chairs, each one of Sabu’s matches belonged on a “best of” DVD. The man who would come to be known as The Human Highlight Reel was as game-changing as they come. Though his persona was that of a Saudi madman, Sabu’s origins were far from hectic Arabian bazaars — he was from Michigan. Descending from a famed wrestling bloodline, Sabu was the nephew of The Sheik and was trained alongside future rival and partner Rob Van Dam by his barbaric, WWE Hall of Fame uncle.',
            'style'        => 'Technical',
            'weight'       => 'Light',
            'role'         => 'Midcard',
        ];
    }
}
