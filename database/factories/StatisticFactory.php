<?php

namespace Database\Factories;

use App\Models\Link;
use App\Models\Statistic;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatisticFactory extends Factory
{
    protected $model = Statistic::class;

    public function definition(): array
    {
        return [
            'link_id' => Link::factory(),
            'client_ip' => $this->faker->ipv4(),
            'created_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'updated_at' => now(),
        ];
    }
}
