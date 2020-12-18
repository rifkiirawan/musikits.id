<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CanvasVisitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Canvas\Models\Visit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_id' => \Canvas\Models\Post::all()->pluck('id')->random(),
            'ip' => $this->faker->ipv4,
            'agent' => $this->faker->userAgent,
            'referer' => $this->faker->url,
            'created_at' => today()->subDays(rand(0, 60))->toDateTimeString(),
            'updated_at' => today()->subDays(rand(0, 60))->toDateTimeString(),
        ];
    }
}
