<?php

namespace Database\Factories;

use App\Models\Link;
use Illuminate\Database\Eloquent\Factories\Factory;

class LinkFactory extends Factory
{
    protected $model = Link::class;

    public function definition(): array
    {
        $urls = [
            'https://www.google.com',
            'https://www.youtube.com',
            'https://github.com',
            'https://www.wikipedia.org',
            'https://laravel.com',
        ];

        static $index = 0;

        return [
            'origin_url' => $urls[$index++ % count($urls)],
        ];
    }
}
