<?php

namespace Database\Seeders;

use App\Models\Link;
use App\Models\Statistic;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // Админ
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);

        // Обычный пользователь
        $user = User::create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
            'email_verified_at' => now(),
        ]);

        // 5 ссылок на обычного пользователя
        $links = Link::factory()
            ->count(5)
            ->create(['user_id' => $user->id]);

        // По 5 переходов на каждую ссылку
        $links->each(function (Link $link) {
            Statistic::factory()
                ->count(5)
                ->create(['link_id' => $link->id]);
        });
    }
}
