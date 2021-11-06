<?php
namespace Modules\Movie\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MovieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Movie\Entities\Movie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'movie_id' =>  $this->faker->randomNumber(),
            'overview' => $this->faker->realText(),
            'backdrop_path' => $this->faker->url(),
            'genre_ids' => $this->faker->randomNumber(),
            'release_date' => now(),
            'original_language' => $this->faker->languageCode(),
            'original_title' => $this->faker->sentence(),
            'popularity' => $this->faker->randomFloat(1, 0, 1000),
            'poster_path' => $this->faker->url(),
            'title' => $this->faker->name(),
            'video' => $this->faker->boolean(),
            'adult' => $this->faker->boolean(),
            'vote_average' => $this->faker->randomFloat(1, 0, 10),
            'vote_count' =>$this->faker->randomNumber(),
            'type_of_movie' => $this->faker->randomElement(['top_rated', 'popular']),
        ];
    }
}

