<?php

use App\Repositories\Promotion\Promotion;
use App\Repositories\Wrestler\Wrestler;
use Illuminate\Database\Seeder;

class WrestlersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Wrestler::create([
            'name' => 'Sabu',
            'draw' => 70,
            'ability' => 80,
            'charisma' => 82,
            'mic_skills' => 40,
            'condition' => 100,
            'hardcore' => 90,
            'disposition' => 'Face',
            'promotion_id' => 1,
            'game_id' => 1,
            'age' => 41,
            'bio' => 'If Tommy Dreamer was the heart and soul of ECW, then Sabu was its raw nerve. The extreme maniac who was winkingly billed as hailing from “Bombay, Mich.,” spread the gospel of a hardcore high-flying style across several continents. Whether he was tearing himself with barbed wire or flipping off the ropes through tables and chairs, each one of Sabu’s matches belonged on a “best of” DVD. The man who would come to be known as The Human Highlight Reel was as game-changing as they come. Though his persona was that of a Saudi madman, Sabu’s origins were far from hectic Arabian bazaars — he was from Michigan. Descending from a famed wrestling bloodline, Sabu was the nephew of The Sheik and was trained alongside future rival and partner Rob Van Dam by his barbaric, WWE Hall of Fame uncle.',
            'style' => 'Technical',
            'weight' => 'Light',
            'role' => 'Midcard'
        ]);

        Promotion::create([
            'name' => 'ECW',
            'size' => 10,
            'rating' => 90,
        ]);
    }
}
